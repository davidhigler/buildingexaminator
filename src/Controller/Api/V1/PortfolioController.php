<?php

namespace App\Controller\Api\V1;

use App\Bag\Application\Arcgis\ArcgisException;
use App\Bag\Application\SQLite\CbsException;
use App\Entity\Authorization\Owner;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\Building;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\City;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\Municipality;
use App\Entity\Portfolio\Neighbourhood;
use App\Entity\Portfolio\PublicSpace;
use App\Entity\Portfolio\Residence;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use App\Bag\Infrastructure\Arcgis\Repository as arcgisRepository;
use App\Bag\Infrastructure\SQLite\Repository as cbsRepository;
use App\Helpers\ErrorExtractor;
use App\Helpers\ApiRenderEngine;
use App\Security\Voters\AddressVoter;
use App\Security\Voters\BlockVoter;
use App\Security\Voters\BuildingTypeVoter;
use App\Security\Voters\HousingStockVoter;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use OpenApi\Annotations as OA;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Info(
 *     title="Building Examinator",
 *     version="0.0.1"
 * )
 * @OA\ExternalDocumentation(
 *     url="/api/v1/documentation"
 * )
 * @OA\Server(
 *     url="https://www.buildingexaminator.nl/api/v1",
 *     description="Development"
 * )
 * @OA\Schema(
 *     schema="ids",
 *     type="array",
 *     @OA\Items(
 *         type="object",
 *         @OA\Property(
 *             property="id",
 *             type="integer"
 *         )
 *     )
 * )
 * @OA\Schema(
 *     schema="housingStocks",
 *     title="Housing stocks",
 *     description="An array of housing stocks",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/HousingStock")
 *     )
 * )
 * @OA\Schema(
 *     schema="municipalities",
 *     title="Municipalities",
 *     description="An array of municipalities",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Municipality")
 *     )
 * )
 * @OA\Schema(
 *     schema="residentialAreas",
 *     title="Residential areas",
 *     description="An array of residential areas",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ResidentialArea")
 *     )
 * )
 * @OA\Schema(
 *     schema="neighbourhoods",
 *     title="Neighbourhoods",
 *     description="An array of neighbourhoods",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Neighbourhood")
 *     )
 * )
 * @OA\Schema(
 *     schema="cities",
 *     title="Cities",
 *     description="An array of cities",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/City")
 *     )
 * )
 * @OA\Schema(
 *     schema="publicspaces",
 *     title="Publicspaces",
 *     description="An array of public spaces",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/PublicSpace")
 *     )
 * )
 * @OA\Schema(
 *     schema="buildings",
 *     title="Buildings",
 *     description="An array of buildings",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Building")
 *     )
 * )
 * @OA\Schema(
 *     schema="residences",
 *     title="Residences",
 *     description="An array of residences",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Residence")
 *     )
 * )
 * @OA\Schema(
 *     schema="blocks",
 *     title="Blocks",
 *     description="An array of blocks",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Block")
 *     )
 * )
 * @OA\Schema(
 *     schema="buildingTypes",
 *     title="Building types",
 *     description="An array of building types",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/BuildingType")
 *     )
 * )
 * @OA\Schema(
 *     schema="addresses",
 *     title="Addresses",
 *     description="An array of addresses",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Address")
 *     )
 * )
 * @OA\Schema(
 *     schema="vtws",
 *     title="Vtws",
 *     description="An array of vtws",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Vtw")
 *     )
 * )
 */
class PortfolioController extends AbstractController implements LoggerAwareInterface
{
    private const HOUSING_STOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'numberOfBlocks',
        'numberOfAddresses',
    ];

    private const HOUSING_STOCK_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'owner' => [
            'id',
            'name',
        ],
        'blocks' => [
            'id',
            'code',
            'name',
        ],
        'buildingTypes' => [
            'id',
            'code',
            'name',
        ],
        'livingTypes' => [
            'id',
            'code',
            'name',
        ],
        'addresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
        'creationTime' => [
            'timestamp',
        ],
        'lastChangeTime' => [
            'timestamp',
        ],
        'numberOfBlocks',
        'numberOfAddresses',
    ];

    private const MUNICIPALITY_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'numberOfAddresses',
    ];

    private const MUNICIPALITY_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
    ];

    private const RESIDENTIALAREA_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const RESIDENTIALAREA_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const NEIGHBOURHOOD_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'residentialArea' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const NEIGHBOURHOOD_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'residentialArea' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const VTW_LIST_FIELDS = [
        'id',
        'code',
        'typeDescription',
        'constructionYearDescription',
        'roofTypeDescription',
        'numberOfAddresses',
    ];

    private const VTW_DETAIL_FIELDS = [
        'id',
        'code',
        'typeDescription',
        'buildingTypeDescription',
        'constructionYearDescription',
        'roofTypeDescription',
    ];

    private const CITY_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'name',
        'numberOfAddresses',
    ];

    private const CITY_DETAIL_FIELDS =[
        'id',
        'objectId',
        'identification',
        'name',
        'addresses' => [
            'id',
        ],
    ];

    private const PUBLICSPACE_LIST_FIELDS = [
        'id',
        'objectId',
        'identification',
        'name',
        'type',
        'numberOfAddresses',
    ];

    private const PUBLICSPACE_DETAIL_FIELDS = [
        'id',
        'objectId',
        'identification',
        'name',
        'type',
        'addresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
        'numberOfAddresses',
    ];

    private const BUILDING_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'constructionYear',
        'status',
        'residenceCount',
        'surfaceArea',
        'numberOfAddresses',
    ];

    private const BUILDING_DETAIL_FIELDS =[
        'id',
        'objectId',
        'identification',
        'constructionYear',
        'status',
        'residenceCount',
        'surfaceArea',
        'addresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
    ];

    private const RESIDENCE_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'surfaceArea',
        'status',
        'intendedUse',
        'intendedUseBasic',
        'numberOfAddresses',
    ];

    private const RESIDENCE_DETAIL_FIELDS =[
        'id',
        'identification',
        'surfaceArea',
        'status',
        'intendedUse',
        'intendedUseBasic',
        'addresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
    ];

    private const BLOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'financialNumber',
        'numberOfAddresses',
    ];

    private const BLOCK_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'addresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
        'numberOfAddresses',
        'financialNumber',
    ];

    private const BUILDINGTYPE_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'numberOfAddresses',
    ];

    private const BUILDINGTYPE_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'addresses' => [
            'id',
            'houseNumber',
            'addition',
            'zipcode',
        ],
    ];

    private const ADDRESS_LIST_FIELDS = [
        'id',
        'rentalUnitNumber',
        'publicSpace' => [
            'name'
        ],
        'houseNumber',
        'addition',
        'zipcode',
        'city' => [
            'name'
        ],
    ];

    private const ADDRESS_DETAIL_FIELDS = [
        'id',
        'objectId',
        'identification',
        'housingStock' => self::HOUSING_STOCK_LIST_FIELDS,
        'municipality' => self::MUNICIPALITY_LIST_FIELDS,
        'residentialArea' => self::RESIDENTIALAREA_LIST_FIELDS,
        'neighbourhood' => self::NEIGHBOURHOOD_LIST_FIELDS,
        'vtw' => self::VTW_LIST_FIELDS,
        'city' => self::CITY_LIST_FIELDS,
        'publicSpace' => self::PUBLICSPACE_LIST_FIELDS,
        'building' => self::BUILDING_LIST_FIELDS,
        'residence' => self::RESIDENCE_LIST_FIELDS,
        'block' => self::BLOCK_LIST_FIELDS,
        'buildingType' => self::BUILDINGTYPE_LIST_FIELDS,
        'rentalUnitNumber',
        'houseNumber',
        'addition',
        'zipcode',
        'orientation',
        'daeb',
    ];

    private LoggerInterface $logger;

    /**
     * HOUSINGSTOCKS
     */

    #[Route('/housingstocks', name: 'listhousingstocks', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks",
     *     summary="Returns details about multiple housing stocks",
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple housing stocks",
     *         @OA\JsonContent(ref="#/components/schemas/housingStocks")
     *     )
     * )
     */
    public function getHousingStocks(Request $request, PaginatorInterface $paginator): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $adapter = $housingStockRepository->createQueryBuilder('o');

        $searchTerm = $request->query->get('searchterm');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }

        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(HousingStockVoter::VIEW, $item);
            } catch (AccessDeniedException $exception) {
                unset($data[$index]);
            }
        }

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::HOUSING_STOCK_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks', name: 'addhousingstock', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks",
     *     summary="Add new housing stock",
     *     @OA\RequestBody(
     *         description="Details about new housing stock",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="owner",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created housing stock",
     *         @OA\JsonContent(ref="#/components/schemas/HousingStock")
     *     )
     * )
     */
    public function addHousingStock(Request $request, ValidatorInterface $validator): Response
    {
        $newHousingStock = json_decode($request->getContent(), true);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $newHousingStock['owner']);

        $housingStock = new HousingStock();
        if (!empty($owner)) {
            $housingStock->setOwner($owner);
        }
        if (!empty($newHousingStock['name'])) {
            $housingStock->setName($newHousingStock['name']);
        }
        if (!empty($newHousingStock['code'])) {
            $housingStock->setCode($newHousingStock['code']);
        }
        if (!empty($newHousingStock['description'])) {
            $housingStock->setDescription($newHousingStock['description']);
        }
        $housingStock->setCreationTime();
        $housingStock->setLastChangeTime();

        $this->denyAccessUnlessGranted(HousingStockVoter::CREATE, $housingStock);

        $violations = $validator->validate($housingStock);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($housingStock);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $housingStock,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}', name: 'changehousingstock', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}",
     *     summary="Change housing stock",
     *     @OA\RequestBody(
     *         description="Details for changing housing stock",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="owner",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed housing stock",
     *         @OA\JsonContent(ref="#/components/schemas/HousingStock")
     *     )
     * )
     */
    public function changeHousingStock(string $housingStockId, Request $request, ValidatorInterface $validator): Response
    {
        $changeHousingStock = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $changeHousingStock['owner']);

        if (!empty($owner)) {
            $housingStock->setOwner($owner);
        }
        if (!empty($changeHousingStock['name'])) {
            $housingStock->setName($changeHousingStock['name']);
        }
        if (!empty($changeHousingStock['code'])) {
            $housingStock->setCode($changeHousingStock['code']);
        }
        if (!empty($changeHousingStock['description'])) {
            $housingStock->setDescription($changeHousingStock['description']);
        }
        $housingStock->setLastChangeTime();

        $violations = $validator->validate($housingStock);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $this->denyAccessUnlessGranted(HousingStockVoter::EDIT, $housingStock);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($housingStock);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $housingStock,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}', name: 'deletehousingstock', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}",
     *     summary="Delete housing stock",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a housing stock"
     *     )
     * )
     */
    public function deleteHousingStock(string $housingStockId): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $this->denyAccessUnlessGranted(HousingStockVoter::DELETE, $housingStock);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($housingStock);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}', name: 'gethousingstock', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}",
     *     summary="Returns details about a housing stock",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a housing stock",
     *         @OA\JsonContent(ref="#/components/schemas/HousingStock")
     *     )
     * )
     */
    public function getHousingStock(string $housingStockId): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);

        $housingStock = $housingStockRepository->find((int)$housingStockId);

        $this->denyAccessUnlessGranted(HousingStockVoter::VIEW, $housingStock);

        return $this->json(
            ApiRenderEngine::renderData(
                $housingStock,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    /**
     * MUNICIPALITIES
     */

    #[Route('/municipalities', name: 'listmunicipalities', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/municipalities",
     *     summary="Returns details about multiple municipalities",
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple municipalities",
     *         @OA\JsonContent(ref="#/components/schemas/municipalities")
     *     )
     * )
     */
    public function getMunicipalities(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $municipalityRepository = $this->getDoctrine()->getRepository(Municipality::class);
        $adapter = $municipalityRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::MUNICIPALITY_LIST_FIELDS
            )
        );
    }

    #[Route('/municipalities/{municipalityId}', name: 'getmunicipality', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/municipalities/{municipalityId}",
     *     summary="Returns details about a municipality",
     *     @OA\Parameter(
     *         name="municipalityId",
     *         description="The id of a municipality",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a municipality",
     *         @OA\JsonContent(ref="#/components/schemas/Municipality")
     *     )
     * )
     */
    public function getMunicipality(string $municipalityId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $residentialAreaRepository->find((int)$municipalityId),
                self::MUNICIPALITY_DETAIL_FIELDS
            )
        );
    }

    /**
     * RESIDENTIALAREAS
     */

    #[Route('/residentialareas', name: 'listresidentialareas', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/residentialareas",
     *     summary="Returns details about multiple residential areas",
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple residential areas",
     *         @OA\JsonContent(ref="#/components/schemas/residentialAreas")
     *     )
     * )
     */
    public function getResidentialAreas(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        $adapter = $residentialAreaRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::RESIDENTIALAREA_LIST_FIELDS
            )
        );
    }

    #[Route('/residentialareas/{residentialAreaId}', name: 'getresidentialarea', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/residentialareas/{residentialAreaId}",
     *     summary="Returns details about a residential area",
     *     @OA\Parameter(
     *         name="residentialAreaId",
     *         description="The id of a residential area",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a residential area",
     *         @OA\JsonContent(ref="#/components/schemas/ResidentialArea")
     *     )
     * )
     */
    public function getResidentialArea(string $residentialAreaId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $residentialAreaRepository->find((int)$residentialAreaId),
                self::RESIDENTIALAREA_DETAIL_FIELDS
            )
        );
    }

    /**
     * NEIGHBOURHOODS
     */

    #[Route('/neighbourhoods', name: 'listneighbourhoods', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/neighbourhoods",
     *     summary="Returns details about multiple neighbourhoods",
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple neighbourhoods",
     *         @OA\JsonContent(ref="#/components/schemas/neighbourhoods")
     *     )
     * )
     */
    public function getNeighbourhoods(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $neighbourhoodRepository = $this->getDoctrine()->getRepository(Neighbourhood::class);
        $adapter = $neighbourhoodRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::NEIGHBOURHOOD_LIST_FIELDS
            )
        );
    }

    #[Route('/neighbourhoods/{neighbourhoodId}', name: 'getneighbourhood', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/neighbourhoods/{neighbourhoodId}",
     *     summary="Returns details about a neighbourhood",
     *     @OA\Parameter(
     *         name="neighbourhoodId",
     *         description="The id of a neighbourhood",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a neighbourhood",
     *         @OA\JsonContent(ref="#/components/schemas/Neighbourhood")
     *     )
     * )
     */
    public function getNeighbourhood(string $neighbourhoodId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $neighbourhoodRepository = $this->getDoctrine()->getRepository(Neighbourhood::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $neighbourhoodRepository->find((int)$neighbourhoodId),
                self::NEIGHBOURHOOD_DETAIL_FIELDS
            )
        );
    }

    /**
     * VTWS
     */

    #[Route('/vtws', name: 'listvtws', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/vtws",
     *     summary="Returns details about multiple vtws",
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple vtws",
     *         @OA\JsonContent(ref="#/components/schemas/vtws")
     *     )
     * )
     */
    public function getVtws(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        $adapter = $vtwRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.typeDescription', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.id', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::VTW_LIST_FIELDS
            )
        );
    }

    #[Route('/vtws/{vtwId}', name: 'getvtw', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/vtws/{vtwId}",
     *     summary="Returns details about a vtw",
     *     @OA\Parameter(
     *         name="neighbourhoodId",
     *         description="The id of a vtw",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a vtw",
     *         @OA\JsonContent(ref="#/components/schemas/Vtw")
     *     )
     * )
     */
    public function getVtw(string $vtwId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $vtwRepository->find((int)$vtwId),
                self::VTW_DETAIL_FIELDS
            )
        );
    }

    /**
     * CITIES
     */

    #[Route('/housingstocks/{housingStockId}/cities', name: 'listcities', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/cities",
     *     summary="Returns details about multiple cities",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple cities",
     *         @OA\JsonContent(ref="#/components/schemas/cities")
     *     )
     * )
     */
    public function getCities(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        $adapter = $cityRepository->createQueryBuilder('o');
        $adapter->join('o.addresses', 'a');
        $adapter->andWhere($adapter->expr()->eq('a.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->groupBy('o.id');
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::CITY_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/cities/{cityId}', name: 'getcity', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/cities/{cityId}",
     *     summary="Returns details about a city",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="cityId",
     *         description="The id of a city",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a city",
     *         @OA\JsonContent(ref="#/components/schemas/City")
     *     )
     * )
     */
    public function getCity(string $cityId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $cityRepository->find((int)$cityId),
                self::CITY_DETAIL_FIELDS
            )
        );
    }

    /**
     * PUBLICSPACES
     */

    #[Route('/housingstocks/{housingStockId}/publicspaces', name: 'listpublicspaces', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/publicspaces",
     *     summary="Returns details about multiple publicspaces",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple publicspaces",
     *         @OA\JsonContent(ref="#/components/schemas/publicspaces")
     *     )
     * )
     */
    public function getPublicSpaces(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $publicSpaceRepository = $this->getDoctrine()->getRepository(PublicSpace::class);
        $adapter = $publicSpaceRepository->createQueryBuilder('o');
        $adapter->join('o.addresses', 'a');
        $adapter->andWhere($adapter->expr()->eq('a.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->groupBy('o.id');
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::PUBLICSPACE_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/publicspaces/{publicSpaceId}', name: 'getpublicspace', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/publicspaces/{publicSpaceId}",
     *     summary="Returns details about a public space",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="publicSpaceId",
     *         description="The id of a public space",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a public space",
     *         @OA\JsonContent(ref="#/components/schemas/PublicSpace")
     *     )
     * )
     */
    public function getPublicSpace(string $publicSpaceId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $publicSpaceRepository = $this->getDoctrine()->getRepository(PublicSpace::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $publicSpaceRepository->find((int)$publicSpaceId),
                self::PUBLICSPACE_DETAIL_FIELDS
            )
        );
    }

    /**
     * BUILDINGS
     */

    #[Route('/housingstocks/{housingStockId}/buildings', name: 'listbuildings', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildings",
     *     summary="Returns details about multiple buildings",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple buildings",
     *         @OA\JsonContent(ref="#/components/schemas/buildings")
     *     )
     * )
     */
    public function getBuildings(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingRepository = $this->getDoctrine()->getRepository(Building::class);
        $adapter = $buildingRepository->createQueryBuilder('o');
        $adapter->join('o.addresses', 'a');
        $adapter->andWhere($adapter->expr()->eq('a.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.identification', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->groupBy('o.id');
        $adapter->orderBy('o.identification', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::BUILDING_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildings/{buildingId}', name: 'getbuilding', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildings/{buildingId}",
     *     summary="Returns details about a building",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="publicSpaceId",
     *         description="The id of a building",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a building",
     *         @OA\JsonContent(ref="#/components/schemas/Building")
     *     )
     * )
     */
    public function getBuilding(string $buildingId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $buildingRepository = $this->getDoctrine()->getRepository(Building::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $buildingRepository->find((int)$buildingId),
                self::BUILDING_DETAIL_FIELDS
            )
        );
    }

    /**
     * RESIDENCES
     */

    #[Route('/housingstocks/{housingStockId}/residences', name: 'listresidences', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/residences",
     *     summary="Returns details about multiple residences",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple residences",
     *         @OA\JsonContent(ref="#/components/schemas/residences")
     *     )
     * )
     */
    public function getResidences(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residenceRepository = $this->getDoctrine()->getRepository(Residence::class);
        $adapter = $residenceRepository->createQueryBuilder('o');
        $adapter->join('o.addresses', 'a');
        $adapter->andWhere($adapter->expr()->eq('a.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.identification', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->groupBy('o.id');
        $adapter->orderBy('o.identification', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::RESIDENCE_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/residences/{residenceId}', name: 'getresidence', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/residences/{residenceId}",
     *     summary="Returns details about a residence",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housingstock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="publicSpaceId",
     *         description="The id of a residence",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a residence",
     *         @OA\JsonContent(ref="#/components/schemas/Residence")
     *     )
     * )
     */
    public function getResidence(string $residenceId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $residenceRepository = $this->getDoctrine()->getRepository(Residence::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $residenceRepository->find((int)$residenceId),
                self::RESIDENCE_DETAIL_FIELDS
            )
        );
    }

    /**
     * BLOCKS
     */

    #[Route('/housingstocks/{housingStockId}/blocks', name: 'listblocks', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/blocks",
     *     summary="Returns details about multiple blocks",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple blocks",
     *         @OA\JsonContent(ref="#/components/schemas/blocks")
     *     )
     * )
     */
    public function getBlocks(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        $adapter = $blockRepository->createQueryBuilder('b');
        $adapter->andWhere($adapter->expr()->eq('b.housingStock', $adapter->expr()->literal($housingStock->getId())));

        $searchTerm = $request->query->get('searchterm');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('b.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('b.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('b.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('b.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(BlockVoter::VIEW, $item);
            } catch (AccessDeniedException $exception) {
                unset($data[$index]);
            }
        }

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::BLOCK_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/blocks', name: 'addblock', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/blocks",
     *     summary="Add new block",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\RequestBody(
     *         description="Details about new block",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="financialnumber",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created block",
     *         @OA\JsonContent(ref="#/components/schemas/Block")
     *     )
     * )
     */
    public function addBlock(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newBlock = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $block = new Block();
        if (!empty($housingStock)) {
            $block->setHousingStock($housingStock);
        }
        if (!empty($newBlock['name'])) {
            $block->setName($newBlock['name']);
        }
        if (!empty($newBlock['code'])) {
            $block->setCode($newBlock['code']);
        }
        if (!empty($newBlock['description'])) {
            $block->setDescription($newBlock['description']);
        }
        if (!empty($newBlock['financialnumber'])) {
            $block->setFinancialNumber($newBlock['financialnumber']);
        }
        $block->setCreationTime();
        $block->setLastChangeTime();

        $this->denyAccessUnlessGranted(BlockVoter::CREATE, $block);

        $violations = $validator->validate($block);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($block);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $block,
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'changeblock', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/blocks/{blockId}",
     *     summary="Change block",
     *     @OA\RequestBody(
     *         description="Details for changing block",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of a housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed block",
     *         @OA\JsonContent(ref="#/components/schemas/Block")
     *     )
     * )
     */
    public function changeBlock(string $housingStockId, string $blockId, Request $request, ValidatorInterface $validator): Response
    {
        $changeBlock = json_decode($request->getContent(), true);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $blockId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        if (!empty($housingStock)) {
            $block->setHousingStock($housingStock);
        }
        if (!empty($changeBlock['name'])) {
            $block->setName($changeBlock['name']);
        }
        if (!empty($changeBlock['code'])) {
            $block->setCode($changeBlock['code']);
        }
        if (!empty($changeBlock['financialNumber'])) {
            $block->setFinancialNumber($changeBlock['financialNumber']);
        }
        if (!empty($changeBlock['description'])) {
            $block->setDescription($changeBlock['description']);
        }
        $block->setLastChangeTime();

        $this->denyAccessUnlessGranted(BlockVoter::EDIT, $block);

        $violations = $validator->validate($block);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($block);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $block,
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'deleteblock', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/blocks/{blockId}",
     *     summary="Delete block",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a block"
     *     )
     * )
     */
    public function deleteBlock(string $housingStockId, string $blockId): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]);

        $this->denyAccessUnlessGranted(BlockVoter::DELETE, $block);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($block);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'getblock', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/blocks/{blockId}",
     *     summary="Returns details about a block",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a block",
     *         @OA\JsonContent(ref="#/components/schemas/Block")
     *     )
     * )
     */
    public function getBlock(string $housingStockId, string $blockId): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);

        $block = $blockRepository->findOneBy(
            [
                'housingStock' => (int)$housingStockId,
                'id' => (int)$blockId
            ]
        );

        $this->denyAccessUnlessGranted(BlockVoter::VIEW, $block);

        return $this->json(
            ApiRenderEngine::renderData(
                $block,
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    /**
     * BUILDINGTYPES
     */

    #[Route('/housingstocks/{housingStockId}/buildingtypes', name: 'listbuildingtypes', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildingtypes",
     *     summary="Returns details about multiple building types",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple buildingtypes",
     *         @OA\JsonContent(ref="#/components/schemas/buildingTypes")
     *     )
     * )
     */
    public function getBuildingTypes(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $adapter = $buildingTypeRepository->createQueryBuilder('o');
        $adapter->andWhere($adapter->expr()->eq('o.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(BuildingTypeVoter::VIEW, $item);
            } catch (AccessDeniedException $exception) {
                unset($data[$index]);
            }
        }

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::BUILDINGTYPE_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes', name: 'addbuildingtype', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/buildingtypes",
     *     summary="Add new building type",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\RequestBody(
     *         description="Details about new building type",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created building type",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingType")
     *     )
     * )
     */
    public function addBuildingType(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newBuildingType = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingType = new BuildingType();
        if (!empty($housingStock)) {
            $buildingType->setHousingStock($housingStock);
        }
        if (!empty($newBuildingType['name'])) {
            $buildingType->setName($newBuildingType['name']);
        }
        if (!empty($newBuildingType['code'])) {
            $buildingType->setCode($newBuildingType['code']);
        }
        if (!empty($newBuildingType['description'])) {
            $buildingType->setDescription($newBuildingType['description']);
        }
        $buildingType->setCreationTime();
        $buildingType->setLastChangeTime();

        $this->denyAccessUnlessGranted(BuildingTypeVoter::CREATE, $buildingType);

        $violations = $validator->validate($buildingType);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingType);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingType,
                self::BUILDINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}', name: 'changebuildingtype', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}",
     *     summary="Change building type",
     *     @OA\RequestBody(
     *         description="Details for changing building type",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of a housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="buildingTypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed building type",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingType")
     *     )
     * )
     */
    public function changeBuildingType(string $housingStockId, string $buildingTypeId, Request $request, ValidatorInterface $validator): Response
    {
        $changeBuildingType = json_decode($request->getContent(), true);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $buildingTypeId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        if (!empty($housingStock)) {
            $buildingType->setHousingStock($housingStock);
        }
        if (!empty($changeBuildingType['name'])) {
            $buildingType->setName($changeBuildingType['name']);
        }
        if (!empty($changeBuildingType['code'])) {
            $buildingType->setCode($changeBuildingType['code']);
        }
        if (!empty($changeBuildingType['description'])) {
            $buildingType->setDescription($changeBuildingType['description']);
        }
        $buildingType->setLastChangeTime();

        $this->denyAccessUnlessGranted(BuildingTypeVoter::EDIT, $buildingType);

        $violations = $validator->validate($buildingType);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingType);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingType,
                self::BUILDINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}', name: 'deletebuildingtype', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}",
     *     summary="Delete building type",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="buildingTypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a building type"
     *     )
     * )
     */
    public function deleteBuildingType(string $housingStockId, string $buildingTypeId): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingTypeId]);

        $this->denyAccessUnlessGranted(BuildingTypeVoter::DELETE, $buildingType);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($buildingType);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}', name: 'getbuildingtype', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}",
     *     summary="Returns details about an address",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="buildingtypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a building type",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingType")
     *     )
     * )
     */
    public function getBuildingType(string $housingStockId, string $buildingtypeId): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $buildingType = $buildingTypeRepository->findOneBy(
            [
                'housingStock' => (int)$housingStockId,
                'id' => (int)$buildingtypeId
            ]
        );

        $this->denyAccessUnlessGranted(BuildingTypeVoter::VIEW, $buildingType);

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingType,
                self::BUILDINGTYPE_DETAIL_FIELDS
            )
        );
    }

    /**
     * ADDRESSES
     */

    #[Route('/housingstocks/{housingStockId}/addresses', name: 'listaddresses', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/addresses",
     *     summary="Returns details about multiple addresses",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple addresses",
     *         @OA\JsonContent(ref="#/components/schemas/addresses")
     *     )
     * )
     */
    public function getAddresses(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $addressRepository = $this->getDoctrine()->getRepository(Address::class);
        $adapter = $addressRepository->createQueryBuilder('o');
        $adapter->join('o.city', 'c');
        $adapter->join('o.publicSpace', 'p');
        $adapter->andWhere($adapter->expr()->eq('o.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.rentalUnitNumber', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('c.name', 'ASC')->addOrderBy('p.name', 'ASC')->addOrderBy('o.houseNumber', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(AddressVoter::VIEW, $item);
            } catch (AccessDeniedException $exception) {
                unset($data[$index]);
            }
        }

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::ADDRESS_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/addresses', name: 'addaddress', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/addresses",
     *     summary="Add new address",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\RequestBody(
     *         description="Details about new address",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="residentialarea",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="block",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="buildingtype",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="livingtype",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="rentalunitnumber",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="streetname",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="housenumber",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="addition",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="zipcode",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="city",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="bagid",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="constructionyear",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="renovationyear",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="orientation",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="deab",
     *                 type="boolean"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created address",
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     )
     * )
     */
    public function addAddress(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newAddress = json_decode($request->getContent(), true);

        $arcgisRepository = new arcgisRepository();

        try {
            $arcgisAddress = $arcgisRepository->getAddressByZipcodeAndHousenumber($newAddress['zipcode'], $newAddress['housenumber'], !empty($newAddress['addition']) ? $newAddress['addition'] : null);
        } catch (ArcgisException $arcgisException) {
            $this->logger->debug(
                $arcgisException->getMessage(),
                array_merge(
                    $arcgisException->getContext(),
                    [
                        'subject' => 'error with request to arcgis api',
                        'class' => __CLASS__,
                        'function' => __FUNCTION__,
                        'line' => __LINE__,
                    ]
                )
            );
            throw $arcgisException;
        }

        $cbsRepository = new cbsRepository();

        try {
            $cbsResults = $cbsRepository->getNeighbourhoodResidentialareaMunicipalityByZipcodeHousenumber($newAddress['zipcode'] . $newAddress['housenumber']);
        } catch (CbsException $cbsException) {
            $this->logger->debug(
                $cbsException->getMessage(),
                array_merge(
                    $cbsException->getContext(),
                    [
                        'subject' => 'missing data from sqlite cbs database',
                        'class' => __CLASS__,
                        'function' => __FUNCTION__,
                        'line' => __LINE__,
                    ]
                )
            );
            throw $cbsException;
        }

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $newAddress['block']);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $newAddress['buildingtype']);

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $newAddress['vtw']);

        $municipalityRepository = $this->getDoctrine()->getRepository(Municipality::class);
        /** @var Municipality $municipality */
        $municipality = $municipalityRepository->findOneBy(['code' => $cbsResults['municipality']]);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->findOneBy(['code' => $cbsResults['residentialarea']]);

        $neighbourhoodRepository = $this->getDoctrine()->getRepository(Neighbourhood::class);
        /** @var Neighbourhood $neighbourhood */
        $neighbourhood = $neighbourhoodRepository->findOneBy(['code' => $cbsResults['neighbourhood']]);

        $cityRepository = $this->getDoctrine()->getRepository(City::class);
        /** @var City $city */
        $city = $cityRepository->findOneBy(['identification' => $arcgisAddress['city']['identification']]);
        if ($city === null) {
            $city = new City();
            $city->setObjectId($arcgisAddress['city']['objectid']);
            $city->setIdentification($arcgisAddress['city']['identification']);
            $city->setName($arcgisAddress['city']['name']);
            $cityManager = $this->getDoctrine()->getManager(City::class);
            $cityManager->persist($city);
        }

        $buildingRepository = $this->getDoctrine()->getRepository(Building::class);
        /** @var Building $building */
        $building = $buildingRepository->findOneBy(['identification' => $arcgisAddress['building']['identification']]);
        if ($building === null) {
            $building = new Building();
            $building->setObjectId($arcgisAddress['building']['objectid']);
            $building->setIdentification($arcgisAddress['building']['identification']);
            $building->setConstructionYear($arcgisAddress['building']['constructionyear']);
            $building->setStatus($arcgisAddress['building']['status']);
            $building->setResidenceCount($arcgisAddress['building']['residencecount']);
            $building->setSurfaceArea($arcgisAddress['building']['surfacearea']);
            $buildingManager = $this->getDoctrine()->getManager(Building::class);
            $buildingManager->persist($building);
        }

        $residenceRepository = $this->getDoctrine()->getRepository(Residence::class);
        /** @var Residence $residence */
        $residence = $residenceRepository->findOneBy(['identification' => $arcgisAddress['residence']['identification']]);
        if ($residence === null) {
            $residence = new Residence();
            $residence->setObjectId($arcgisAddress['residence']['objectid']);
            $residence->setIdentification($arcgisAddress['residence']['identification']);
            $residence->setSurfaceArea($arcgisAddress['residence']['surfacearea']);
            $residence->setStatus($arcgisAddress['residence']['status']);
            $residence->setIntendedUse($arcgisAddress['residence']['intendeduse']);
            $residence->setIntendedUseBasic($arcgisAddress['residence']['intendedusebasic']);
            $residenceManager = $this->getDoctrine()->getManager(Residence::class);
            $residenceManager->persist($residence);
        }

        $publicSpaceRepository = $this->getDoctrine()->getRepository(PublicSpace::class);
        /** @var PublicSpace $publicSpace */
        $publicSpace = $publicSpaceRepository->findOneBy(['identification' => $arcgisAddress['publicspace']['identification']]);
        if ($publicSpace === null) {
            $publicSpace = new PublicSpace();
            $publicSpace->setObjectId($arcgisAddress['publicspace']['objectid']);
            $publicSpace->setIdentification($arcgisAddress['publicspace']['identification']);
            $publicSpace->setName($arcgisAddress['publicspace']['name']);
            $publicSpace->setType($arcgisAddress['publicspace']['type']);
            $publicSpaceManager = $this->getDoctrine()->getManager(PublicSpace::class);
            $publicSpaceManager->persist($publicSpace);
        }

        $address = new Address();
        if (!empty($housingStock)) {
            $address->setHousingStock($housingStock);
        }
        if (!empty($block)) {
            $address->setBlock($block);
        }
        if (!empty($buildingType)) {
            $address->setBuildingType($buildingType);
        }
        if (!empty($vtw)) {
            $address->setVtw($vtw);
        }
        if (!empty($newAddress['rentalunitnumber'])) {
            $address->setRentalUnitNumber($newAddress['rentalunitnumber']);
        }
        if (!empty($newAddress['orientation'])) {
            $address->setOrientation($newAddress['orientation']);
        }
        if (is_bool($newAddress['daeb'])) {
            $address->setDaeb($newAddress['daeb']);
        }

        $address->setHouseNumber($arcgisAddress['housenumber']);
        $address->setAddition($arcgisAddress['addition']);
        $address->setZipcode($arcgisAddress['zipcode']);

        $address->setMunicipality($municipality);
        $address->setResidentialArea($residentialArea);
        $address->setNeighbourhood($neighbourhood);

        $address->setCity($city);
        $address->setBuilding($building);
        $address->setResidence($residence);
        $address->setPublicSpace($publicSpace);

        $address->setObjectId($arcgisAddress['objectid']);
        $address->setIdentification($arcgisAddress['identification']);

        $address->setCreationTime();
        $address->setLastChangeTime();

        $this->denyAccessUnlessGranted(AddressVoter::VIEW, $address);

        $violations = $validator->validate($address);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($address);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $address,
                self::ADDRESS_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'changeaddress', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/addresses/{addressId}",
     *     summary="Change address",
     *     @OA\RequestBody(
     *         description="Details for changing address",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="streetName",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="houseNumber",
     *                 type="integer"
     *             ),
     *             @OA\Property(
     *                 property="addition",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="zipcode",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="city",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="daeb",
     *                 type="bool"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of a housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed address",
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     )
     * )
     */
    public function changeAddress(string $housingStockId, string $addressId, Request $request, ValidatorInterface $validator): Response
    {
        $changeAddress = json_decode($request->getContent(), true);

        $addressRepository = $this->getDoctrine()->getRepository(Address::class);
        /** @var Address $address */
        $address = $addressRepository->find((int) $addressId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $changeAddress['block']);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $changeAddress['buildingtype']);

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $changeAddress['vtw']);

        if (!empty($housingStock)) {
            $address->setHousingStock($housingStock);
        }
        if (!empty($block)) {
            $address->setBlock($block);
        }
        if (!empty($buildingType)) {
            $address->setBuildingType($buildingType);
        }
        if (!empty($vtw)) {
            $address->setVtw($vtw);
        }
        if (!empty($changeAddress['rentalunitnumber'])) {
            $address->setRentalUnitNumber($changeAddress['rentalunitnumber']);
        }
        if (!empty($changeAddress['orientation'])) {
            $address->setOrientation($changeAddress['orientation']);
        }
        if (is_bool($changeAddress['daeb'])) {
            $address->setDaeb($changeAddress['daeb']);
        }
        $address->setLastChangeTime();

        $this->denyAccessUnlessGranted(AddressVoter::EDIT, $address);

        $violations = $validator->validate($address);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($address);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $address,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'deleteaddress', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/addresses/{addressId}",
     *     summary="Delete address",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an address"
     *     )
     * )
     */
    public function deleteAddress(string $housingStockId, string $addressId): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(Address::class);
        /** @var Address $address */
        $address = (object)$addressRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $addressId], null, 1);

        $this->denyAccessUnlessGranted(AddressVoter::DELETE, $address);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($address);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'getaddress', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/addresses/{addressId}",
     *     summary="Returns details about an address",
     *     @OA\Parameter(
     *         name="housingStockId",
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true,
     *         example=1
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about an address",
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     )
     * )
     */
    public function getAddress(string $housingStockId, string $addressId): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(Address::class);
        $address = $addressRepository->findBy(
            [
                'housingStock' => (int)$housingStockId,
                'id' => (int)$addressId
            ]
        );

        $this->denyAccessUnlessGranted(AddressVoter::VIEW, $address);

        return $this->json(
            ApiRenderEngine::renderData(
                $address,
                self::ADDRESS_DETAIL_FIELDS
            )
        );
    }

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }
}

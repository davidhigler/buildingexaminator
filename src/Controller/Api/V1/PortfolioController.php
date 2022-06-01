<?php

namespace App\Controller\Api\V1;

use App\Entity\Authorization\Owner;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\Municipality;
use App\Entity\Portfolio\Neighbourhood;
use App\Entity\Portfolio\PublicSpace;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use App\Helpers\ErrorExtractor;
use App\Helpers\ApiRenderEngine;
use Doctrine\ORM\QueryBuilder;
use Exception;
use OpenApi\Annotations as OA;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
 *     schema="owners",
 *     title="Owners",
 *     description="An array of owners",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Owner")
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
class PortfolioController extends AbstractController
{
    private const DEFAULT_PAGE_LIMIT = 10;

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
    ];

    private const RESIDENTIALAREA_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
    ];

    private const NEIGHBOURHOOD_LIST_FIELDS = [
        'id',
        'code',
        'name',
    ];

    private const NEIGHBOURHOOD_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
    ];

    private const PUBLICSPACE_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'addresses' => [
            'id',
        ],
        'numberOfAddresses',
        'financialNumber',
    ];

    private const PUBLICSPACE_DETAIL_FIELDS = [
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

    private const BLOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'addresses' => [
            'id',
        ],
        'numberOfAddresses',
        'financialNumber',
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
        'addresses' => [
            'id',
        ],
    ];

    private const BUILDINGTYPE_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'addresses' => [
            'id',
            'streetName',
            'houseNumber',
            'addition',
            'zipcode',
            'city',
        ],
    ];

    private const ADDRESS_LIST_FIELDS = [
        'id',
        'residentialArea' => [
            'id',
            'name',
        ],
        'block' => [
            'id',
            'name',
        ],
        'buildingType' => [
            'id',
            'name',
        ],
        'vtw' => [
            'id',
            'code',
        ],
        'rentalUnitNumber',
        'streetName',
        'houseNumber',
        'addition',
        'zipcode',
        'city',
    ];

    private const ADDRESS_DETAIL_FIELDS = [
        'id',
        'residentialArea' => [
            'id',
            'code',
            'name',
        ],
        'block' => [
            'id',
            'code',
            'name',
        ],
        'buildingType' => [
            'id',
            'code',
            'name',
        ],
        'vtw' => [
            'id',
            'code',
            'typeDescription',
            'buildingTypeDescription',
            'constructionYearDescription',
            'roofTypeDescription',
        ],
        'rentalUnitNumber',
        'houseNumber',
        'addition',
        'zipcode',
        'city',
        'orientation',
        'daeb',
    ];

    private const VTW_LIST_FIELDS = [
        'id',
        'code',
        'typeDescription',
        'buildingTypeDescription',
        'constructionYearDescription',
        'roofTypeDescription',
    ];

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
    public function getHousingStocks(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $adapter = $housingStockRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
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

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
        } else {
            $housingStock->setOwner(null);
        }
        if (!empty($changeHousingStock['name'])) {
            $housingStock->setName($changeHousingStock['name']);
        } else {
            $housingStock->setName(null);
        }
        if (!empty($changeHousingStock['code'])) {
            $housingStock->setCode($changeHousingStock['code']);
        } else {
            $housingStock->setCode(null);
        }
        if (!empty($changeHousingStock['description'])) {
            $housingStock->setDescription($changeHousingStock['description']);
        } else {
            $housingStock->setDescription(null);
        }
        $housingStock->setLastChangeTime();

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
        return $this->json(
            ApiRenderEngine::renderData(
                $housingStockRepository->find(
                    (int)$housingStockId
                ),
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
    public function getMunicipalities(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $municipalityRepository = $this->getDoctrine()->getRepository(Municipality::class);
        /** @var QueryBuilder $adapter */
        $adapter = $municipalityRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
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

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
     *         required=true
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
    public function getResidentialAreas(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var QueryBuilder $adapter */
        $adapter = $residentialAreaRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
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

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
    public function getNeighbourhoods(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $neighbourhoodRepository = $this->getDoctrine()->getRepository(Neighbourhood::class);
        /** @var QueryBuilder $adapter */
        $adapter = $neighbourhoodRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('0.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
     *         required=true
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
        $neighbourhoodRepository = $this->getDoctrine()->getRepository(Neighbourhood::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $neighbourhoodRepository->find((int)$neighbourhoodId),
                self::NEIGHBOURHOOD_DETAIL_FIELDS
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
     *         description="The id of the public space",
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
    public function getPublicSpaces(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $publicSpaceRepository = $this->getDoctrine()->getRepository(PublicSpace::class);
        /** @var QueryBuilder $adapter */
        $adapter = $publicSpaceRepository->createQueryBuilder('o');
        $adapter->join('o.addresses', 'a');
        $adapter->andWhere($adapter->expr()->eq('a.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->groupBy('o.id');
        $adapter->orderBy('o.name', 'ASC');

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
     *         name="neighbourhoodId",
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
        $publicSpaceRepository = $this->getDoctrine()->getRepository(PublicSpace::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $publicSpaceRepository->find((int)$publicSpaceId),
                self::PUBLICSPACE_DETAIL_FIELDS
            )
        );
    }

    /**
     * BLOCKS
     *
     * @Todo Define the DELETE
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
    public function getBlocks(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        $adapter = $blockRepository->createQueryBuilder('o');
        $adapter->andWhere($adapter->expr()->eq('o.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if ($searchTerm !== null) {
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

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
        } else {
            $block->setHousingStock(null);
        }
        if (!empty($changeBlock['name'])) {
            $block->setName($changeBlock['name']);
        } else {
            $block->setName(null);
        }
        if (!empty($changeBlock['code'])) {
            $block->setCode($changeBlock['code']);
        } else {
            $block->setCode(null);
        }
        if (!empty($changeBlock['financialNumber'])) {
            $block->setFinancialNumber($changeBlock['financialNumber']);
        } else {
            $block->setFinancialNumber(null);
        }
        if (!empty($changeBlock['description'])) {
            $block->setDescription($changeBlock['description']);
        } else {
            $block->setDescription(null);
        }
        $block->setLastChangeTime();

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
        return $this->json(
            ApiRenderEngine::renderData(
                $blockRepository->findOneBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$blockId
                    ]
                ),
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    /**
     * BUILDINGTYPES
     *
     * @Todo Define the POST, PUT and DELETE methods
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
    public function getBuildingTypes(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $adapter = $buildingTypeRepository->createQueryBuilder('o');
        $adapter->andWhere($adapter->expr()->eq('o.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if ($searchTerm !== null) {
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

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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
        } else {
            $buildingType->setHousingStock(null);
        }
        if (!empty($changeBuildingType['name'])) {
            $buildingType->setName($changeBuildingType['name']);
        } else {
            $buildingType->setName(null);
        }
        if (!empty($changeBuildingType['code'])) {
            $buildingType->setCode($changeBuildingType['code']);
        } else {
            $buildingType->setCode(null);
        }
        if (!empty($changeBuildingType['description'])) {
            $buildingType->setDescription($changeBuildingType['description']);
        } else {
            $buildingType->setDescription(null);
        }
        $buildingType->setLastChangeTime();

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
        return $this->json(
            ApiRenderEngine::renderData(
                $buildingTypeRepository->findOneBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$buildingtypeId
                    ]
                ),
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
    public function getAddresses(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $addressRepository = $this->getDoctrine()->getRepository(Address::class);
        $adapter = $addressRepository->createQueryBuilder('o');
        $adapter->andWhere($adapter->expr()->eq('o.housingStock', $adapter->expr()->literal($housingStock->getId())));
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.streetName', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.city', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.rentalUnitNumber', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.city', 'ASC')->orderBy('o.streetName', 'ASC')->orderBy('o.houseNumber', 'ASC');

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
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

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->find((int) $newAddress['residentialarea']);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $newAddress['block']);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $newAddress['buildingtype']);

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $newAddress['vtw']);

        $address = new Address();
        if (!empty($housingStock)) {
            $address->setHousingStock($housingStock);
        }
        if (!empty($residentialArea)) {
            $address->setResidentialArea($residentialArea);
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
        if (!empty($newAddress['housenumber'])) {
            $address->setHouseNumber($newAddress['housenumber']);
        }
        if (!empty($newAddress['addition'])) {
            $address->setAddition($newAddress['addition']);
        }
        if (!empty($newAddress['zipcode'])) {
            $address->setZipcode($newAddress['zipcode']);
        }
        if (!empty($newAddress['city'])) {
            $address->setCity($newAddress['city']);
        }
        if (!empty($newAddress['orientation'])) {
            $address->setOrientation($newAddress['orientation']);
        }
        if (is_bool($newAddress['daeb'])) {
            $address->setDaeb($newAddress['daeb']);
        }
        $address->setCreationTime();
        $address->setLastChangeTime();

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

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->find((int) $changeAddress['residentialarea']);

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
        if (!empty($residentialArea)) {
            $address->setResidentialArea($residentialArea);
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
        if (!empty($changeAddress['housenumber'])) {
            $address->setHouseNumber($changeAddress['housenumber']);
        }
        if (!empty($changeAddress['addition'])) {
            $address->setAddition($changeAddress['addition']);
        }
        if (!empty($changeAddress['zipcode'])) {
            $address->setZipcode($changeAddress['zipcode']);
        }
        if (!empty($changeAddress['city'])) {
            $address->setCity($changeAddress['city']);
        }
        if (!empty($changeAddress['orientation'])) {
            $address->setOrientation($changeAddress['orientation']);
        }
        if (is_bool($changeAddress['daeb'])) {
            $address->setDaeb($changeAddress['daeb']);
        }
        $address->setLastChangeTime();

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
        return $this->json(
            ApiRenderEngine::renderData(
                $addressRepository->findBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$addressId
                    ]
                ),
                self::ADDRESS_DETAIL_FIELDS
            )
        );
    }

    /**
     * VTWS
     */

    #[Route('/vtws', name: 'vtws', methods: ['GET'])]
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
    public function getVtws(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        $adapter = $vtwRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.typeDescription', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.typeDescription', 'ASC');

        if ($page === null) {
            $data = $adapter->getQuery()->getResult();
        } else {
            $data = new Pagerfanta(new QueryAdapter($adapter));
            $data->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $data->setCurrentPage($page);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::VTW_LIST_FIELDS
            )
        );
    }

}

<?php

namespace App\Controller\Api\V1;

use App\Entity\Authorization\Owner;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use App\Entity\Portfolio\Vtw;
use App\Helpers\ErrorExtractor;
use App\Helpers\ApiRenderEngine;
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
 *     schema="livingTypes",
 *     title="Living types",
 *     description="An array of living types",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/LivingType")
 *     )
 * )
 * @OA\Schema(
 *     schema="buildingAddresses",
 *     title="Addresses",
 *     description="An array of addresses",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/BuildingAddress")
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
        'description',
        'numberOfBlocks',
        'numberOfBuildingAddresses',
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
        'buildingAddresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
        'housingStockOptionSet' => [
            'id',
        ],
        'creationTime' => [
            'timestamp',
        ],
        'lastChangeTime' => [
            'timestamp',
        ],
        'numberOfBlocks',
        'numberOfBuildingAddresses',
    ];

    private const RESIDENTIALAREA_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
        ],
    ];

    private const RESIDENTIALAREA_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
            'streetName',
            'houseNumber',
            'addition',
            'zipcode',
            'city',
        ],
    ];

    private const BLOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
        ],
        'numberOfBuildingAddresses',
        'buildingSelection' => [
            'id',
        ],
        'financialNumber',
    ];

    private const BLOCK_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
            'rentalUnitNumber',
            'zipcode',
            'houseNumber',
            'addition',
        ],
        'numberOfBuildingAddresses',
        'buildingSelection' => [
            'id',
            'code',
            'name',
        ],
        'financialNumber',
    ];

    private const BUILDINGTYPE_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
        ],
    ];

    private const BUILDINGTYPE_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
            'streetName',
            'houseNumber',
            'addition',
            'zipcode',
            'city',
        ],
    ];

    private const LIVINGTYPE_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
            'id',
        ],
    ];

    private const LIVINGTYPE_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'buildingAddresses' => [
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
        'livingType' => [
            'id',
            'name',
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
        'livingType' => [
            'id',
            'code',
            'name',
        ],
        'streetName',
        'houseNumber',
        'addition',
        'zipcode',
        'city',
        'bagId',
        'constructionYear',
        'renovationYear',
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
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
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
     *         required=true
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
     *         required=true
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
     * RESIDENTIALAREAS
     */

    #[Route('/housingstocks/{housingStockId}/residentialareas', name: 'listresidentialareas', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/residentialareas",
     *     summary="Returns details about multiple residential areas",
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
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple residential areas",
     *         @OA\JsonContent(ref="#/components/schemas/residentialAreas")
     *     )
     * )
     */
    public function getResidentialAreas(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        $adapter = $residentialAreaRepository->createQueryBuilder('o');
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
                self::RESIDENTIALAREA_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas', name: 'addresidentialarea', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/residentialareas",
     *     summary="Add new residential area",
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
     *     @OA\RequestBody(
     *         description="Details about new residential area",
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
     *         description="Details about created residential area",
     *         @OA\JsonContent(ref="#/components/schemas/ResidentialArea")
     *     )
     * )
     */
    public function addResidentialArea(string $housingStockId, Request $request, ValidatorInterface $validator): Response
    {
        $newResidentialArea = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residentialArea = new ResidentialArea();
        if (!empty($housingStock)) {
            $residentialArea->setHousingStock($housingStock);
        }
        if (!empty($newResidentialArea['name'])) {
            $residentialArea->setName($newResidentialArea['name']);
        }
        if (!empty($newResidentialArea['code'])) {
            $residentialArea->setCode($newResidentialArea['code']);
        }
        if (!empty($newResidentialArea['description'])) {
            $residentialArea->setDescription($newResidentialArea['description']);
        }
        $residentialArea->setCreationTime();
        $residentialArea->setLastChangeTime();

        $violations = $validator->validate($residentialArea);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($residentialArea);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $residentialArea,
                self::RESIDENTIALAREA_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}', name: 'changeresidentialarea', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}",
     *     summary="Change residential area",
     *     @OA\RequestBody(
     *         description="Details for changing residential area",
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
     *         description="The id of the housing stock",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="residentialAreaId",
     *         description="The id of the residential area",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed residential area",
     *         @OA\JsonContent(ref="#/components/schemas/ResidentialArea")
     *     )
     * )
     */
    public function changeResidentialArea(string $housingStockId, string $residentialAreaId, Request $request, ValidatorInterface $validator): Response
    {
        $changeResidentialArea = json_decode($request->getContent(), true);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->find((int) $residentialAreaId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        if (!empty($housingStock)) {
            $residentialArea->setHousingStock($housingStock);
        } else {
            $residentialArea->setHousingStock(null);
        }
        if (!empty($changeResidentialArea['name'])) {
            $residentialArea->setName($changeResidentialArea['name']);
        } else {
            $residentialArea->setName(null);
        }
        if (!empty($changeResidentialArea['code'])) {
            $residentialArea->setCode($changeResidentialArea['code']);
        } else {
            $residentialArea->setCode(null);
        }
        if (!empty($changeResidentialArea['description'])) {
            $residentialArea->setDescription($changeResidentialArea['description']);
        } else {
            $residentialArea->setDescription(null);
        }
        $residentialArea->setLastChangeTime();

        $violations = $validator->validate($residentialArea);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($residentialArea);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $residentialArea,
                self::RESIDENTIALAREA_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}', name: 'deleteresidentialarea', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}",
     *     summary="Delete residential area",
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
     *     @OA\Parameter(
     *         name="residentialAreaId",
     *         description="The id of the residential area",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a residential area"
     *     )
     * )
     */
    public function deleteResidentialArea(string $housingStockId, string $residentialAreaId): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $residentialAreaId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($residentialArea);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}', name: 'getresidentialarea', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}",
     *     summary="Returns details about a residential area",
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
     *     @OA\Parameter(
     *         name="residentialAreaId",
     *         description="The id of a residential area",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a residential area",
     *         @OA\JsonContent(ref="#/components/schemas/ResidentialArea")
     *     )
     * )
     */
    public function getResidentialArea(string $housingStockId, string $residentialAreaId): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $residentialAreaRepository->findOneBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$residentialAreaId
                    ]
                ),
                self::RESIDENTIALAREA_DETAIL_FIELDS
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
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
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="blockId",
     *         description="The id of a block",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
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
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="buildingTypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="buildingTypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="buildingtypeId",
     *         description="The id of a building type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
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
     * LIVINGTYPES
     */

    #[Route('/housingstocks/{housingStockId}/livingtypes', name: 'listlivingtypes', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/livingtypes",
     *     summary="Returns details about multiple living types",
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
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple living types",
     *         @OA\JsonContent(ref="#/components/schemas/livingTypes")
     *     )
     * )
     */
    public function getLivingTypes(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        $adapter = $livingTypeRepository->createQueryBuilder('o');
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
                self::LIVINGTYPE_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes', name: 'addlivingtype', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/livingtypes",
     *     summary="Add new living type",
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
     *     @OA\RequestBody(
     *         description="Details about new living type",
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
     *         description="Details about created living type",
     *         @OA\JsonContent(ref="#/components/schemas/LivingType")
     *     )
     * )
     */
    public function addLivingType(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newLivingType = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $livingType = new LivingType();
        if (!empty($housingStock)) {
            $livingType->setHousingStock($housingStock);
        }
        if (!empty($newLivingType['name'])) {
            $livingType->setName($newLivingType['name']);
        }
        if (!empty($newLivingType['code'])) {
            $livingType->setCode($newLivingType['code']);
        }
        if (!empty($newLivingType['description'])) {
            $livingType->setDescription($newLivingType['description']);
        }
        $livingType->setCreationTime();
        $livingType->setLastChangeTime();

        $violations = $validator->validate($livingType);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($livingType);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $livingType,
                self::LIVINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes/{livingTypeId}', name: 'changelivingtype', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/livingtypes/{livingTypeId}",
     *     summary="Change living type",
     *     @OA\RequestBody(
     *         description="Details for changing living type",
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="buildingTypeId",
     *         description="The id of a living type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed living type",
     *         @OA\JsonContent(ref="#/components/schemas/LivingType")
     *     )
     * )
     */
    public function changeLivingType(string $housingStockId, string $livingTypeId, Request $request, ValidatorInterface $validator): Response
    {
        $changeLivingType = json_decode($request->getContent(), true);

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        /** @var LivingType $livingType */
        $livingType = $livingTypeRepository->find((int) $livingTypeId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        if (!empty($housingStock)) {
            $livingType->setHousingStock($housingStock);
        } else {
            $livingType->setHousingStock(null);
        }
        if (!empty($changeLivingType['name'])) {
            $livingType->setName($changeLivingType['name']);
        } else {
            $livingType->setName(null);
        }
        if (!empty($changeLivingType['code'])) {
            $livingType->setCode($changeLivingType['code']);
        } else {
            $livingType->setCode(null);
        }
        if (!empty($changeLivingType['description'])) {
            $livingType->setDescription($changeLivingType['description']);
        } else {
            $livingType->setDescription(null);
        }
        $livingType->setLastChangeTime();

        $violations = $validator->validate($livingType);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($livingType);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $livingType,
                self::LIVINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes/{livingTypeId}', name: 'deletelivingtype', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/livingtypes/{livingTypeId}",
     *     summary="Delete living type",
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
     *     @OA\Parameter(
     *         name="livingTypeId",
     *         description="The id of a living type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a living type"
     *     )
     * )
     */
    public function deleteLivingType(string $housingStockId, string $livingTypeId): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        /** @var LivingType $livingType */
        $livingType = $livingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $livingTypeId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($livingType);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes/{livingTypeId}', name: 'getlivingtype', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/livingtypes/{livingTypeId}",
     *     summary="Returns details about a living type",
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
     *     @OA\Parameter(
     *         name="livingTypeId",
     *         description="The id of a living type",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a living type",
     *         @OA\JsonContent(ref="#/components/schemas/LivingType")
     *     )
     * )
     */
    public function getLivingType(string $housingStockId, string $livingTypeId): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $livingTypeRepository->findOneBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$livingTypeId
                    ]
                ),
                self::LIVINGTYPE_DETAIL_FIELDS
            )
        );
    }

    /**
     * ADDRESSES
     */

    #[Route('/housingstocks/{housingStockId}/buildingaddresses', name: 'listbuildingaddresses', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildingaddresses",
     *     summary="Returns details about multiple buildingaddresses",
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
     *     @OA\Parameter(
     *         name="page",
     *         description="The page number to get",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple buildingaddresses",
     *         @OA\JsonContent(ref="#/components/schemas/buildingAddresses")
     *     )
     * )
     */
    public function getBuildingAddresses(string $housingStockId, Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingAddressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        $adapter = $buildingAddressRepository->createQueryBuilder('o');
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

    #[Route('/housingstocks/{housingStockId}/buildingaddresses', name: 'addbuildingaddress', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/housingstocks/{housingStockId}/buildingaddresses",
     *     summary="Add new address",
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
     *     @OA\RequestBody(
     *         description="Details about new buildingaddress",
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
     *         description="Details about created buildingaddress",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function addBuildingAddress(Request $request, ValidatorInterface $validator, string $housingStockId): Response
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

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        /** @var LivingType $livingType */
        $livingType = $livingTypeRepository->find((int) $newAddress['livingtype']);

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $newAddress['vtw']);

        $buildingAddress = new BuildingAddress();
        if (!empty($housingStock)) {
            $buildingAddress->setHousingStock($housingStock);
        }
        if (!empty($residentialArea)) {
            $buildingAddress->setResidentialArea($residentialArea);
        }
        if (!empty($block)) {
            $buildingAddress->setBlock($block);
        }
        if (!empty($buildingType)) {
            $buildingAddress->setBuildingType($buildingType);
        }
        if (!empty($livingType)) {
            $buildingAddress->setLivingType($livingType);
        }
        if (!empty($vtw)) {
            $buildingAddress->setVtw($vtw);
        }
        if (!empty($newAddress['rentalunitnumber'])) {
            $buildingAddress->setRentalUnitNumber($newAddress['rentalunitnumber']);
        }
        if (!empty($newAddress['streetname'])) {
            $buildingAddress->setStreetName($newAddress['streetname']);
        }
        if (!empty($newAddress['housenumber'])) {
            $buildingAddress->setHouseNumber($newAddress['housenumber']);
        }
        if (!empty($newAddress['addition'])) {
            $buildingAddress->setAddition($newAddress['addition']);
        }
        if (!empty($newAddress['zipcode'])) {
            $buildingAddress->setZipcode($newAddress['zipcode']);
        }
        if (!empty($newAddress['city'])) {
            $buildingAddress->setCity($newAddress['city']);
        }
        if (!empty($newAddress['bagid'])) {
            $buildingAddress->setBagId($newAddress['bagid']);
        }
        if (!empty($newAddress['constructionyear'])) {
            $buildingAddress->setConstructionYear($newAddress['constructionyear']);
        }
        if (!empty($newAddress['renovationyear'])) {
            $buildingAddress->setRenovationYear($newAddress['renovationyear']);
        }
        if (!empty($newAddress['orientation'])) {
            $buildingAddress->setOrientation($newAddress['orientation']);
        }
        if (is_bool($newAddress['daeb'])) {
            $buildingAddress->setDaeb($newAddress['daeb']);
        }
        $buildingAddress->setCreationTime();
        $buildingAddress->setLastChangeTime();

        $violations = $validator->validate($buildingAddress);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingAddress);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingAddress,
                self::ADDRESS_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}', name: 'changebuildingaddress', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}",
     *     summary="Change buildingaddress",
     *     @OA\RequestBody(
     *         description="Details for changing buildingaddress",
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an buildingaddress",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed buildingaddress",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function changeBuildingAddress(string $housingStockId, string $buildingAddressId, Request $request, ValidatorInterface $validator): Response
    {
        $changeAddress = json_decode($request->getContent(), true);

        $buildingAddressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        /** @var BuildingAddress $buildingAddress */
        $buildingAddress = $buildingAddressRepository->find((int) $buildingAddressId);

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

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        /** @var LivingType $livingType */
        $livingType = $livingTypeRepository->find((int) $changeAddress['livingtype']);

        $vtwRepository = $this->getDoctrine()->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $changeAddress['vtw']);

        if (!empty($housingStock)) {
            $buildingAddress->setHousingStock($housingStock);
        }
        if (!empty($residentialArea)) {
            $buildingAddress->setResidentialArea($residentialArea);
        }
        if (!empty($block)) {
            $buildingAddress->setBlock($block);
        }
        if (!empty($buildingType)) {
            $buildingAddress->setBuildingType($buildingType);
        }
        if (!empty($livingType)) {
            $buildingAddress->setLivingType($livingType);
        }
        if (!empty($vtw)) {
            $buildingAddress->setVtw($vtw);
        }
        if (!empty($changeAddress['rentalunitnumber'])) {
            $buildingAddress->setRentalUnitNumber($changeAddress['rentalunitnumber']);
        }
        if (!empty($changeAddress['streetname'])) {
            $buildingAddress->setStreetName($changeAddress['streetname']);
        }
        if (!empty($changeAddress['housenumber'])) {
            $buildingAddress->setHouseNumber($changeAddress['housenumber']);
        }
        if (!empty($changeAddress['addition'])) {
            $buildingAddress->setAddition($changeAddress['addition']);
        }
        if (!empty($changeAddress['zipcode'])) {
            $buildingAddress->setZipcode($changeAddress['zipcode']);
        }
        if (!empty($changeAddress['city'])) {
            $buildingAddress->setCity($changeAddress['city']);
        }
        if (!empty($changeAddress['bagid'])) {
            $buildingAddress->setBagId($changeAddress['bagid']);
        }
        if (!empty($changeAddress['constructionyear'])) {
            $buildingAddress->setConstructionYear($changeAddress['constructionyear']);
        }
        if (!empty($changeAddress['renovationyear'])) {
            $buildingAddress->setRenovationYear($changeAddress['renovationyear']);
        }
        if (!empty($changeAddress['orientation'])) {
            $buildingAddress->setOrientation($changeAddress['orientation']);
        }
        if (is_bool($changeAddress['daeb'])) {
            $buildingAddress->setDaeb($changeAddress['daeb']);
        }
        $buildingAddress->setLastChangeTime();

        $violations = $validator->validate($buildingAddress);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingAddress);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingAddress,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}', name: 'deletebuildingaddress', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}",
     *     summary="Delete buildingaddress",
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
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an buildingaddress",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an buildingaddress"
     *     )
     * )
     */
    public function deleteBuildingAddress(string $housingStockId, string $buildingAddressId): Response
    {
        $buildingAddressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        /** @var BuildingAddress $buildingAddress */
        $buildingAddress = (object)$buildingAddressRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingAddressId], null, 1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($buildingAddress);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}', name: 'getbuildingaddress', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks/{housingStockId}/buildingaddresses/{buildingAddressId}",
     *     summary="Returns details about an buildingaddress",
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
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an buildingaddress",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about an buildingaddress",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function getBuildingAddress(string $housingStockId, string $buildingAddressId): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $addressRepository->findBy(
                    [
                        'housingStock' => (int)$housingStockId,
                        'id' => (int)$buildingAddressId
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
     *         required=false
     *     ),
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false
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

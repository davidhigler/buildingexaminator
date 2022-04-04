<?php

namespace App\Controller\Api\V1;

use App\Entity\Portfolio\Owner;
use Exception;
use JetBrains\PhpStorm\Pure;
use OpenApi\Annotations as OA;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Psr\Log\LoggerInterface;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
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
 *     url="http://localhost/api/v1",
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
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Owner")
 * )
 * @OA\Schema(
 *     schema="housingStocks",
 *     title="Housing stocks",
 *     description="An array of housing stocks",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/HousingStock")
 * )
 * @OA\Schema(
 *     schema="blocks",
 *     title="Blocks",
 *     description="An array of blocks",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Block")
 * )
 * @OA\Schema(
 *     schema="buildingAddresses",
 *     title="Addresses",
 *     description="An array of addresses",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/BuildingAddress")
 * )
 * @OA\Schema(
 *     schema="buildingTypes",
 *     title="Building types",
 *     description="An array of building types",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/BuildingType")
 * )
 * @OA\Schema(
 *     schema="livingTypes",
 *     title="Living types",
 *     description="An array of living types",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/LivingType")
 * )
 * @OA\Schema(
 *     schema="residentialAreas",
 *     title="Residential areas",
 *     description="An array of residential areas",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/ResidentialArea")
 * )
 */
class ApiController extends AbstractController
{
    private const DEFAULT_PAGE_LIMIT = 10;

    private const OWNER_LIST_FIELDS = [
        'id',
        'name',
        'kvk',
        'btw',
        'lnumber',
        'website',
    ];

    private const OWNER_DETAIL_FIELDS = [
        'id',
        'name',
        'kvk',
        'btw',
        'lnumber',
        'website',
        'housingstocks' => [
            'id',
            'code',
            'name',
            'description',
        ],
    ];

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
        'blocks' => [
            'id',
            'code',
            'name',
        ],
        'streetName',
        'houseNumber',
        'addition',
        'zipcode',
        'city',
        'daeb',
    ];

    #[Route('/documentation', name: 'documentation', methods: ['GET'])]
    public function getDocumentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }

    /**
     * OWNERS
     */

    #[Route('/owners', name: 'listowners', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/owners",
     *     summary="Returns details about multiple ownerss",
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple owners",
     *         @OA\JsonContent(ref="#/components/schemas/owners")
     *     )
     * )
     */
    public function getOwners(Request $request, LoggerInterface $logger): Response
    {
        $repository = $this->getDoctrine()->getRepository(Owner::class);
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $adapter = $repository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.lnumber', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $searchTerm)
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

        return $this->renderData($data, self::OWNER_LIST_FIELDS, $logger);
    }

    #[Route('/owners', name: 'addowner', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/owners",
     *     summary="Add new owner",
     *     @OA\RequestBody(
     *         description="Details about new owner",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="kvk",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="btw",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="lnumber",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created owner",
     *         @OA\JsonContent(ref="#/components/schemas/Owner")
     *     )
     * )
     */
    public function addOwner(Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $newOwner = json_decode($request->getContent(), true);

        $owner = new Owner();
        if (!empty($newOwner['name'])) {
            $owner->setName($newOwner['name']);
        }
        if (!empty($newOwner['kvk'])) {
            $owner->setKvk($newOwner['kvk']);
        }
        if (!empty($newOwner['btw'])) {
            $owner->setBtw($newOwner['btw']);
        }
        if (!empty($newOwner['lnumber'])) {
            $owner->setLnumber($newOwner['lnumber']);
        }
        if (!empty($newOwner['website'])) {
            $owner->setWebsite($newOwner['website']);
        }

        $violations = $validator->validate($owner);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($owner);
        $entityManager->flush();

        return $this->renderData($owner, self::OWNER_DETAIL_FIELDS, $logger);
    }

    #[Route('/owners/{ownerId}', name: 'changeowner', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/owners/{ownerId}",
     *     summary="Change owner",
     *     @OA\RequestBody(
     *         description="Details for changing owner",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="kvk",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="btw",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="lnumber",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the owner",
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
    public function changeOwner(string $ownerId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeOwner = json_decode($request->getContent(), true);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $ownerId);

        $owner->setName($changeOwner['name']);
        if (!empty($changeOwner['kvk'])) {
            $owner->setKvk($changeOwner['kvk']);
        }
        if (!empty($changeOwner['btw'])) {
            $owner->setBtw($changeOwner['btw']);
        }
        if (!empty($changeOwner['lnumber'])) {
            $owner->setLnumber($changeOwner['lnumber']);
        }
        if (!empty($changeOwner['website'])) {
            $owner->setWebsite($changeOwner['website']);
        }

        $violations = $validator->validate($owner);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($owner);
        $entityManager->flush();

        return $this->renderData($owner, self::OWNER_DETAIL_FIELDS, $logger);
    }

    #[Route('/owners/{ownerId}', name: 'deleteowner', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/owners/{ownerId}",
     *     summary="Delete owner",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the owner",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an owner"
     *     )
     * )
     */
    public function deleteOwner(string $ownerId): Response
    {
        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        $owner = $ownerRepository->find((int) $ownerId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($owner);
        $entityManager->flush();

        return new Response('', 200);
    }

    #[Route('/owners/{ownerId}', name: 'getowner', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/owners/{ownerId}",
     *     summary="Returns details about an owner",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the owner",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about an owner",
     *         @OA\JsonContent(ref="#/components/schemas/Owner")
     *     )
     * )
     */
    public function getOwner(string $ownerId, LoggerInterface $logger): Response
    {
        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        return $this->renderData($ownerRepository->find((int) $ownerId), self::OWNER_DETAIL_FIELDS, $logger);
    }

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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple housing stocks",
     *         @OA\JsonContent(ref="#/components/schemas/housingStocks")
     *     )
     * )
     */
    public function getHousingStocks(Request $request, LoggerInterface $logger): Response
    {
        $repository = $this->getDoctrine()->getRepository(HousingStock::class);
        $page = $request->query->get('page');

        if ($page === null) {
            return $this->renderData($repository->findBy([], ['name' => 'ASC']), self::HOUSING_STOCK_LIST_FIELDS, $logger);
        } else {
            $adapter = $repository->createQueryBuilder('h')->orderBy('h.name', 'ASC');

            $pager = new Pagerfanta(new QueryAdapter($adapter));
            $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $pager->setCurrentPage($page);

            return $this->renderData($pager, self::HOUSING_STOCK_LIST_FIELDS, $logger);
        }
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
    public function addHousingStock(Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $newHousingStock = json_decode($request->getContent(), true);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
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
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($housingStock);
        $entityManager->flush();

        return $this->renderData($housingStock, self::HOUSING_STOCK_DETAIL_FIELDS, $logger);
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
    public function changeHousingStock(string $housingStockId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeHousingStock = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        $owner = $ownerRepository->find((int) $changeHousingStock['owner']);

        $housingStock->setOwner($owner);
        $housingStock->setName($changeHousingStock['name']);
        $housingStock->setCode($changeHousingStock['code']);
        $housingStock->setDescription($changeHousingStock['description']);
        $housingStock->setLastChangeTime();

        $violations = $validator->validate($housingStock);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($housingStock);
        $entityManager->flush();

        return $this->renderData($housingStock, self::HOUSING_STOCK_DETAIL_FIELDS, $logger);
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
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($housingStock);
        $entityManager->flush();

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
    public function getHousingStock(string $housingStockId, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        return $this->renderData($housingStockRepository->find((int) $housingStockId), self::HOUSING_STOCK_DETAIL_FIELDS, $logger);
    }

    /**
     * RESIDENTIALAREAS
     *
     * @Todo Define the POST, PUT and DELETE methods
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple residential areas",
     *         @OA\JsonContent(ref="#/components/schemas/residentialAreas")
     *     )
     * )
     */
    public function getResidentialAreas(string $housingStockId, Request $request, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        $page = $request->query->get('page');

        if ($page === null) {
            return $this->renderData($residentialAreaRepository->findBy(['housingStock' => $housingStock->getId()], ['name' => 'ASC']), self::RESIDENTIALAREA_LIST_FIELDS, $logger);
        } else {
            $adapter = $residentialAreaRepository->createQueryBuilder('r')
                ->where('r.housingStock = :housingStockId')
                ->setParameter('housingStockId', $housingStock->getId())
                ->orderBy('r.name', 'ASC');

            $pager = new Pagerfanta(new QueryAdapter($adapter));
            $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $pager->setCurrentPage($page);

            return $this->renderData($pager, self::RESIDENTIALAREA_LIST_FIELDS, $logger);
        }
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
    public function addResidentialArea(string $housingStockId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $newResidentialArea = json_decode($request->getContent(), true);

        $residentialArea = new ResidentialArea();
        $residentialArea->setHousingStock($housingStock);
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
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($residentialArea);
        $entityManager->flush();

        return $this->renderData($residentialArea, self::RESIDENTIALAREA_DETAIL_FIELDS, $logger);
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
    public function changeResidentialArea(string $housingStockId, string $residentialAreaId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeResidentialArea = json_decode($request->getContent(), true);

        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->find((int) $residentialAreaId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $residentialArea->setHousingStock($housingStock);
        $residentialArea->setName($changeResidentialArea['name']);
        $residentialArea->setCode($changeResidentialArea['code']);
        $residentialArea->setDescription($changeResidentialArea['description']);
        $residentialArea->setLastChangeTime();

        $violations = $validator->validate($residentialArea);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($residentialArea);
        $entityManager->flush();

        return $this->renderData($residentialArea, self::RESIDENTIALAREA_DETAIL_FIELDS, $logger);
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
        $residentialArea = $residentialAreaRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $residentialAreaId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($residentialArea);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json($this->extractErrorFromException($exception), 500);
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
    public function getResidentialArea(string $housingStockId, string $residentialAreaId, LoggerInterface $logger): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->renderData($residentialAreaRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $residentialAreaId]), self::RESIDENTIALAREA_DETAIL_FIELDS, $logger);
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple blocks",
     *         @OA\JsonContent(ref="#/components/schemas/blocks")
     *     )
     * )
     */
    public function getBlocks(string $housingStockId, Request $request, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        $page = $request->query->get('page');

        if ($page === null) {
            return $this->renderData($blockRepository->findBy(['housingStock' => $housingStock->getId()], ['name' => 'ASC']), self::BLOCK_LIST_FIELDS, $logger);
        } else {
            $adapter = $blockRepository->createQueryBuilder('b')
                ->where('b.housingStock = :housingStockId')
                ->setParameter('housingStockId', $housingStock->getId())
                ->orderBy('b.name', 'ASC');

            $pager = new Pagerfanta(new QueryAdapter($adapter));
            $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $pager->setCurrentPage($page);

            return $this->renderData($pager, self::BLOCK_LIST_FIELDS, $logger);
        }
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
    public function addBlock(Request $request, ValidatorInterface $validator, string $housingStockId, LoggerInterface $logger): Response
    {
        $newBlock = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $block = new Block();
        $block->setHousingStock($housingStock);
        $block->setName($newBlock['name']);
        $block->setCode($newBlock['code']);
        $block->setDescription($newBlock['description']);
        $block->setFinancialNumber($newBlock['financialnumber']);
        $block->setCreationTime();
        $block->setLastChangeTime();

        $violations = $validator->validate($block);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($block);
        $entityManager->flush();

        return $this->renderData($block, self::BLOCK_DETAIL_FIELDS, $logger);
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
    public function changeBlock(string $housingStockId, string $blockId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeBlock = json_decode($request->getContent(), true);

        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $blockId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $block->setHousingStock($housingStock);
        $block->setName($changeBlock['name']);
        $block->setCode($changeBlock['code']);
        $block->setFinancialNumber($changeBlock['financialNumber']);
        $block->setDescription($changeBlock['description']);
        $block->setLastChangeTime();

        $violations = $validator->validate($block);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($block);
        $entityManager->flush();

        return $this->renderData($block, self::BLOCK_DETAIL_FIELDS, $logger);
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
        $block = $blockRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($block);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json($this->extractErrorFromException($exception), 500);
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
    public function getBlock(string $housingStockId, string $blockId, LoggerInterface $logger): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        return $this->renderData($blockRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]), self::BLOCK_DETAIL_FIELDS, $logger);
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple buildingtypes",
     *         @OA\JsonContent(ref="#/components/schemas/buildingTypes")
     *     )
     * )
     */
    public function getBuildingTypes(string $housingStockId, Request $request, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $page = $request->query->get('page');

        if ($page === null) {
            return $this->renderData($buildingTypeRepository->findBy(['housingStock' => $housingStock->getId()], ['name' => 'ASC']), self::BUILDINGTYPE_LIST_FIELDS, $logger);
        } else {
            $adapter = $buildingTypeRepository->createQueryBuilder('b')
                ->where('b.housingStock = :housingStockId')
                ->setParameter('housingStockId', $housingStock->getId())
                ->orderBy('b.name', 'ASC');

            $pager = new Pagerfanta(new QueryAdapter($adapter));
            $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $pager->setCurrentPage($page);

            return $this->renderData($pager, self::BUILDINGTYPE_LIST_FIELDS, $logger);
        }
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
    public function addBuildingType(Request $request, ValidatorInterface $validator, string $housingStockId, LoggerInterface $logger): Response
    {
        $newBuildingType = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingType = new BuildingType();
        $buildingType->setHousingStock($housingStock);
        $buildingType->setName($newBuildingType['name']);
        $buildingType->setCode($newBuildingType['code']);
        $buildingType->setDescription($newBuildingType['description']);
        $buildingType->setCreationTime();
        $buildingType->setLastChangeTime();

        $violations = $validator->validate($buildingType);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingType);
        $entityManager->flush();

        return $this->renderData($buildingType, self::BUILDINGTYPE_DETAIL_FIELDS, $logger);
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
    public function changeBuildingType(string $housingStockId, string $buildingTypeId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeBuildingType = json_decode($request->getContent(), true);

        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $buildingTypeId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $buildingType->setHousingStock($housingStock);
        $buildingType->setName($changeBuildingType['name']);
        $buildingType->setCode($changeBuildingType['code']);
        $buildingType->setDescription($changeBuildingType['description']);
        $buildingType->setLastChangeTime();

        $violations = $validator->validate($buildingType);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingType);
        $entityManager->flush();

        return $this->renderData($buildingType, self::BUILDINGTYPE_DETAIL_FIELDS, $logger);
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
        $buildingType = $buildingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingTypeId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($buildingType);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json($this->extractErrorFromException($exception), 500);
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
    public function getBuildingType(string $housingStockId, string $buildingtypeId, LoggerInterface $logger): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        return $this->renderData($buildingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingtypeId]), self::BUILDINGTYPE_DETAIL_FIELDS, $logger);
    }

    /**
     * LIVINGTYPES
     *
     * @Todo Define the POST, PUT and DELETE methods
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple living types",
     *         @OA\JsonContent(ref="#/components/schemas/livingTypes")
     *     )
     * )
     */
    public function getLivingTypes(string $housingStockId, Request $request, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        $page = $request->query->get('page');

        if ($page === null) {
            return $this->renderData($livingTypeRepository->findBy(['housingStock' => $housingStock->getId()], ['name' => 'ASC']), self::LIVINGTYPE_LIST_FIELDS, $logger);
        } else {
            $adapter = $livingTypeRepository->createQueryBuilder('l')
                ->where('l.housingStock = :housingStockId')
                ->setParameter('housingStockId', $housingStock->getId())
                ->orderBy('l.name', 'ASC');

            $pager = new Pagerfanta(new QueryAdapter($adapter));
            $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
            $pager->setCurrentPage($page);

            return $this->renderData($pager, self::LIVINGTYPE_LIST_FIELDS, $logger);
        }
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
    public function addLivingType(Request $request, ValidatorInterface $validator, string $housingStockId, LoggerInterface $logger): Response
    {
        $newLivingType = json_decode($request->getContent(), true);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $livingType = new LivingType();
        $livingType->setHousingStock($housingStock);
        $livingType->setName($newLivingType['name']);
        $livingType->setCode($newLivingType['code']);
        $livingType->setDescription($newLivingType['description']);
        $livingType->setCreationTime();
        $livingType->setLastChangeTime();

        $violations = $validator->validate($livingType);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($livingType);
        $entityManager->flush();

        return $this->renderData($livingType, self::LIVINGTYPE_DETAIL_FIELDS, $logger);
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
    public function changeLivingType(string $housingStockId, string $livingTypeId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeLivingType = json_decode($request->getContent(), true);

        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        /** @var LivingType $livingType */
        $livingType = $livingTypeRepository->find((int) $livingTypeId);

        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $livingType->setHousingStock($housingStock);
        $livingType->setName($changeLivingType['name']);
        $livingType->setCode($changeLivingType['code']);
        $livingType->setDescription($changeLivingType['description']);
        $livingType->setLastChangeTime();

        $violations = $validator->validate($livingType);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($livingType);
        $entityManager->flush();

        return $this->renderData($livingType, self::LIVINGTYPE_DETAIL_FIELDS, $logger);
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
        $livingType = $livingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $livingTypeId]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($livingType);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json($this->extractErrorFromException($exception), 500);
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
    public function getLivingType(string $housingStockId, string $livingTypeId, LoggerInterface $logger): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        return $this->renderData($livingTypeRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $livingTypeId]), self::LIVINGTYPE_DETAIL_FIELDS, $logger);
    }

    /**
     * ADDRESSES
     *
     * @Todo Define the POST, PUT and DELETE methods
     */

    #[Route('/housingstocks/{housingStockId}/addresses', name: 'listaddress', methods: ['GET'])]
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
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple addresses",
     *         @OA\JsonContent(ref="#/components/schemas/buildingAddresses")
     *     )
     * )
     */
    public function getAddresses(string $housingStockId, Request $request, LoggerInterface $logger): Response
    {
        $pager = new Pagerfanta(
            new QueryAdapter(
                $this->getDoctrine()
                    ->getRepository(BuildingAddress::class)
                    ->createQueryBuilder('b')
                    ->where('b.housingStock = ' . $housingStockId)
            )
        );

        $pager->setMaxPerPage($request->query->get('limit') ?? self::DEFAULT_PAGE_LIMIT);
        $pager->setCurrentPage($request->query->get('page') ?? 1);

        return $this->renderData($pager, self::ADDRESS_LIST_FIELDS, $logger);
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
     *         required=true
     *     ),
     *     @OA\RequestBody(
     *         description="Details about new address",
     *         @OA\JsonContent(
     *             type="object",
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
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created address",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function addAddress(Request $request, ValidatorInterface $validator, string $housingStockId, LoggerInterface $logger): Response
    {
        $newAddress = json_decode($request->getContent(), true);

        $blockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $blockRepository->find((int) $housingStockId);

        $address = new BuildingAddress();
        $address->setHousingStock($housingStock);
        $address->setStreetName($newAddress['streetname']);
        $address->setHouseNumber($newAddress['housenumber']);
        $address->setAddition($newAddress['addition']);
        $address->setZipcode($newAddress['zipcode']);
        $address->setCity($newAddress['city']);
        $address->setCreationTime();
        $address->setLastChangeTime();

        $violations = $validator->validate($address);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($address);
        $entityManager->flush();

        return $this->renderData($address, self::ADDRESS_DETAIL_FIELDS, $logger);
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed address",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function changeAddress(string $addressId, Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $changeAddress = json_decode($request->getContent(), true);

        $buildingAddressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        /** @var BuildingAddress $buildingAddress */
        $buildingAddress = $buildingAddressRepository->find((int) $addressId);

        $buildingAddress->setStreetName($changeAddress['streetName']);
        $buildingAddress->setHouseNumber($changeAddress['houseNumber']);
        $buildingAddress->setAddition($changeAddress['addition']);
        $buildingAddress->setZipcode($changeAddress['zipcode']);
        $buildingAddress->setCity($changeAddress['city']);
        $buildingAddress->setDaeb($changeAddress['daeb']);
        $buildingAddress->setLastChangeTime();

        $violations = $validator->validate($buildingAddress);
        if ($violations->count() > 0) {
            return $this->json($this->extractErrorsFromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($buildingAddress);
        $entityManager->flush();

        return $this->renderData($buildingAddress, self::HOUSING_STOCK_DETAIL_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'deleteaddress', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/housingstocks/{housingStockId}/blocks/{addressId}",
     *     summary="Delete address",
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
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an address"
     *     )
     * )
     */
    public function deleteAddress(string $housingStockId, string $addressId): Response
    {
        $buildingAddressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        $buildingAddress = (object)$buildingAddressRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $addressId], null, 1);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($buildingAddress);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json($this->extractErrorFromException($exception), 500);
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
     *         required=true
     *     ),
     *     @OA\Parameter(
     *         name="addressId",
     *         description="The id of an address",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about an address",
     *         @OA\JsonContent(ref="#/components/schemas/BuildingAddress")
     *     )
     * )
     */
    public function getAddress(string $housingStockId, string $addressId, LoggerInterface $logger): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        return $this->renderData($addressRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $addressId]), self::ADDRESS_DETAIL_FIELDS, $logger);
    }

    /**
     * EXTRA
     */

    private function renderData($results, array $fields, LoggerInterface $logger): Response
    {
        try {
            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $data = $serializer->normalize(
                $results instanceof Pagerfanta ? $results->getCurrentPageResults() : $results,
                null,
                [AbstractNormalizer::ATTRIBUTES => $fields]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );

            return $this->json(['error' => $exception->getMessage()], 500);
        }

        if ($results instanceof Pagerfanta) {
            return $this->json(
                [
                    'data' => $data,
                    'pager' => [
                        'count' => $results->getNbPages(),
                        'current' => $results->getCurrentPage(),
                        'next' => $results->hasNextPage() ? $results->getNextPage() : 0,
                        'previous' => $results->hasPreviousPage() ? $results->getPreviousPage() : 0,
                    ],
                ]
            );
        } else {
            return $this->json(
                [
                    'data' => $data
                ]
            );
        }
    }

    private function extractErrorsFromViolations(ConstraintViolationListInterface $violations): array
    {
        $errors = [];
        /** @var ConstraintViolationInterface $violation */
        foreach ($violations as $violation) {
            $error = new stdClass();
            $error->code = $violation->getCode();
            $error->message = $violation->getMessage();
            $errors[] = $error;
        }
        return $errors;
    }

    #[Pure]
    private function extractErrorFromException(Exception $exception): array
    {
        $errors = [];
        $error = new stdClass();
        $error->code = $exception->getCode();
        $error->message = $exception->getMessage();
        $errors[] = $error;
        return $errors;
    }
}

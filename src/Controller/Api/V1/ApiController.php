<?php

namespace App\Controller\Api\V1;

use Doctrine\Persistence\ObjectManager;
use OpenApi\Annotations as OA;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/buildingexaminator/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Info(
 *     title="Building Examinator",
 *     version="0.0.1"
 * )
 * @OA\ExternalDocumentation(
 *     url="/api/buildingexaminator/v1/documentation"
 * )
 * @OA\Server(url="/api/buildingexaminator/v1")
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
#[Route('/api/buildingexaminator/v1', name: 'api-v1-')]
class ApiController extends AbstractController
{
    private const HOUSING_STOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'blocks' => [
            'id',
        ],
        'buildingTypes' => [
            'id',
        ],
        'livingTypes' => [
            'id',
        ],
        'buildingAddresses' => [
            'id',
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

    private const HOUSING_STOCK_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'description',
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

    private const ADDRESS_LIST_FIELDS = [
        'id',
        'residentialArea' => [
            'id',
        ],
        'buildingType' => [
            'id',
        ],
        'livingType' => [
            'id',
        ],
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

    #[Route('/documentation', name: 'documentation', methods: ['GET'])]
    public function getDocumentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }

    #[Route('/housingstocks', name: 'listhousingstocks', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks",
     *     summary="Returns details about multiple housing stocks",
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple housing stocks",
     *         @OA\JsonContent(ref="#/components/schemas/housingStocks")
     *     )
     * )
     */
    public function getHousingStocks(LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        return $this->renderData($housingStockRepository->findAll(), self::HOUSING_STOCK_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks', name: 'addhousingstocks', methods: ['POST'])]
    public function addHousingStock(Request $request, ValidatorInterface $validator, LoggerInterface $logger): Response
    {
        $newHousingStock = json_decode($request->getContent(), true);

        $housingStock = new HousingStock();
        $housingStock->setName($newHousingStock['name']);
        $housingStock->setCode($newHousingStock['code']);
        $housingStock->setDescription($newHousingStock['description']);
        $housingStock->setCreationTime();
        $housingStock->setLastChangeTime();

        $errors = $validator->validate($housingStock);

        if (count($errors) > 0) {
            $errorsString = (string) $errors;

            return new Response($errorsString, 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($housingStock);

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}', name: 'housingstock', methods: ['GET'])]
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

    #[Route('/housingstocks/{housingStockId}/blocks', name: 'blocks', methods: ['GET'])]
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple blocks",
     *         @OA\JsonContent(ref="#/components/schemas/blocks")
     *     )
     * )
     */
    public function getBlocks(string $housingStockId, LoggerInterface $logger): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        return $this->renderData($blockRepository->findBy(['housingStock' => (int) $housingStockId]), self::BLOCK_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'block', methods: ['GET'])]
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
        return $this->renderData($blockRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]), self::BLOCK_DETAIL_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/addresses', name: 'addresses', methods: ['GET'])]
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
    public function getAddresses(string $housingStockId, LoggerInterface $logger): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        return $this->renderData($addressRepository->findBy(['housingStock' => (int) $housingStockId]), self::ADDRESS_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'address', methods: ['GET'])]
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

    #[Route('/housingstocks/{housingStockId}/buildingtypes', name: 'buildingtypes', methods: ['get'])]
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple buildingtypes",
     *         @OA\JsonContent(ref="#/components/schemas/buildingTypes")
     *     )
     * )
     */
    public function getBuildingTypes(string $housingStockId, LoggerInterface $logger): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        return $this->renderData($buildingTypeRepository->findBy(['housingStock' => (int) $housingStockId]), self::BUILDINGTYPE_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}', name: 'buildingtype', methods: ['get'])]
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
        return $this->renderData($buildingTypeRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingtypeId]), self::BUILDINGTYPE_DETAIL_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes', name: 'livingtypes', methods: ['get'])]
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple living types",
     *         @OA\JsonContent(ref="#/components/schemas/livingTypes")
     *     )
     * )
     */
    public function getLivingTypes(string $housingStockId, LoggerInterface $logger): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        return $this->renderData($livingTypeRepository->findBy(['housingStock' => (int) $housingStockId]), self::LIVINGTYPE_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes/{livingTypeId}', name: 'livingtype', methods: ['get'])]
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
        return $this->renderData($livingTypeRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $livingTypeId]), self::LIVINGTYPE_DETAIL_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas', name: 'residentialareas', methods: ['get'])]
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
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple residential areas",
     *         @OA\JsonContent(ref="#/components/schemas/residentialAreas")
     *     )
     * )
     */
    public function getResidentialAreas(string $housingStockId, LoggerInterface $logger): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->renderData($residentialAreaRepository->findBy(['housingStock' => (int) $housingStockId]), self::RESIDENTIALAREA_LIST_FIELDS, $logger);
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}', name: 'residentialArea', methods: ['get'])]
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
        return $this->renderData($residentialAreaRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $residentialAreaId]), self::RESIDENTIALAREA_DETAIL_FIELDS, $logger);
    }

    private function renderData($results, array $fields, LoggerInterface $logger): Response
    {
        $data = [];

        try {
            $serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
            $data = $serializer->normalize(
                $results,
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

        return $this->json($data, 200);
    }
}

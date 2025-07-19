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
use OpenApi\Attributes as OA;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route('/api/v1', name: 'api-v1-')]
#[OA\Info(
    version: '0.0.1',
    title: 'Building Examinator',
)]
#[OA\ExternalDocumentation(
    url: '/api/v1/documentation',
)]
#[OA\Server(
    url: 'https://www.buildingexaminator.nl/api/v1',
    description: 'Development',
)]
#[OA\Schema(
    schema: 'ids',
    type: 'array',
    items: new OA\Items(
        properties: [
            new OA\Property(
                property: 'id',
                type: 'integer',
            )
        ],
        type: 'object',
    ),
)]
#[OA\Schema(
    schema: 'housingStocks',
    title: 'Housing stocks',
    description: 'An array of housing stocks',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/HousingStock',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'municipalities',
    title: 'Municipalities',
    description: 'An array of municipalities',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Municipality',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'residentialAreas',
    title: 'Residential areas',
    description: 'An array of residential areas',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/ResidentialArea',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'neighbourhoods',
    title: 'Neighbourhoods',
    description: 'An array of neighbourhoods',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Neighbourhood',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'cities',
    title: 'Cities',
    description: 'An array of cities',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/City',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'publicspaces',
    title: 'Publicspaces',
    description: 'An array of public spaces',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/PublicSpace',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'buildings',
    title: 'Buildings',
    description: 'An array of buildings',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Building',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'residences',
    title: 'Residences',
    description: 'An array of residences',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Residence',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'blocks',
    title: 'Blocks',
    description: 'An array of blocks',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Block',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'buildingTypes',
    title: 'Building types',
    description: 'An array of building types',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/BuildingType',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'addresses',
    title: 'Addresses',
    description: 'An array of addresses',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Address',
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'vtws',
    title: 'Vtws',
    description: 'An array of vtws',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Vtw',
            ),
        ),
    ],
    type: 'object',
)]
class PortfolioController extends AbstractController implements LoggerAwareInterface
{
    private const array HOUSING_STOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'numberOfBlocks',
        'numberOfAddresses',
    ];

    private const array HOUSING_STOCK_DETAIL_FIELDS = [
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

    private const array MUNICIPALITY_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'numberOfAddresses',
    ];

    private const array MUNICIPALITY_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
    ];

    private const array RESIDENTIALAREA_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const array RESIDENTIALAREA_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'municipality' => [
            'name'
        ],
        'numberOfAddresses',
    ];

    private const array NEIGHBOURHOOD_LIST_FIELDS = [
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

    private const array NEIGHBOURHOOD_DETAIL_FIELDS = [
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

    private const array VTW_LIST_FIELDS = [
        'id',
        'code',
        'typeDescription',
        'constructionYearDescription',
        'roofTypeDescription',
        'numberOfAddresses',
    ];

    private const array VTW_DETAIL_FIELDS = [
        'id',
        'code',
        'typeDescription',
        'buildingTypeDescription',
        'constructionYearDescription',
        'roofTypeDescription',
    ];

    private const array CITY_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'name',
        'numberOfAddresses',
    ];

    private const array CITY_DETAIL_FIELDS =[
        'id',
        'objectId',
        'identification',
        'name',
        'addresses' => [
            'id',
        ],
    ];

    private const array PUBLICSPACE_LIST_FIELDS = [
        'id',
        'objectId',
        'identification',
        'name',
        'type',
        'numberOfAddresses',
    ];

    private const array PUBLICSPACE_DETAIL_FIELDS = [
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

    private const array BUILDING_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'constructionYear',
        'status',
        'residenceCount',
        'surfaceArea',
        'numberOfAddresses',
    ];

    private const array BUILDING_DETAIL_FIELDS =[
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

    private const array RESIDENCE_LIST_FIELDS =[
        'id',
        'objectId',
        'identification',
        'surfaceArea',
        'status',
        'intendedUse',
        'intendedUseBasic',
        'numberOfAddresses',
    ];

    private const array RESIDENCE_DETAIL_FIELDS =[
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

    private const array BLOCK_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'financialNumber',
        'numberOfAddresses',
    ];

    private const array BLOCK_DETAIL_FIELDS = [
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

    private const array BUILDINGTYPE_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'description',
        'numberOfAddresses',
    ];

    private const array BUILDINGTYPE_DETAIL_FIELDS = [
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

    private const array ADDRESS_LIST_FIELDS = [
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

    private const array ADDRESS_DETAIL_FIELDS = [
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

    public function __construct(
        private LoggerInterface $logger,
        private readonly ManagerRegistry $managerRegistry,
    ) {}


    /**
     * HOUSINGSTOCKS
     */

    #[Route('/housingstocks', name: 'listhousingstocks', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks',
        description: 'Returns details about multiple housing stocks',
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple housing stocks',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/housingStocks',
                ),
            ),
        ],
    )]
    public function getHousingStocks(Request $request, PaginatorInterface $paginator): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        $adapter = $objectRepository->createQueryBuilder('o');

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
            } catch (AccessDeniedException) {
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
    #[OA\Post(
        path: '/housingstocks',
        summary: 'Add new housing stock',
        requestBody: new OA\RequestBody(
            description: 'Details about new housing stock',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'owner',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created housing stock',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/HousingStock',
                ),
            ),
        ],
    )]
    public function addHousingStock(Request $request, ValidatorInterface $validator): Response
    {
        $newHousingStock = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $objectRepository->find((int) $newHousingStock['owner']);

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

        $constraintViolationList = $validator->validate($housingStock);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($housingStock);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $housingStock,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}', name: 'changehousingstock', methods: ['PUT'])]
    #[OA\Put(
        path: '/housingstocks/{housingStockId}',
        description: 'Change housing stock',
        requestBody: new OA\RequestBody(
            description: 'Details for changing housing stock',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'owner',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about changed housing stock',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/HousingStock',
                ),
            ),
        ],
    )]
    public function changeHousingStock(string $housingStockId, Request $request, ValidatorInterface $validator): Response
    {
        $changeHousingStock = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $ownerRepository = $this->managerRegistry->getRepository(Owner::class);
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

        $constraintViolationList = $validator->validate($housingStock);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $this->denyAccessUnlessGranted(HousingStockVoter::EDIT, $housingStock);

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($housingStock);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $housingStock,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}', name: 'deletehousingstock', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/housingstocks/{housingStockId}',
        description: 'Delete housing stock',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successfully deleted a housing stock',
            ),
        ],
    )]
    public function deleteHousingStock(string $housingStockId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $this->denyAccessUnlessGranted(HousingStockVoter::DELETE, $housingStock);

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->remove($housingStock);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}', name: 'gethousingstock', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}',
        description: 'Returns details about a housing stock',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a housing stock',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/HousingStock',
                ),
            ),
        ],
    )]
    public function getHousingStock(string $housingStockId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);

        $housingStock = $objectRepository->find((int)$housingStockId);

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
    #[OA\Get(
        path: '/municipalities',
        description: 'Returns details about multiple municipalities',
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple municipalities',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/municipalities',
                ),
            ),
        ],
    )]
    public function getMunicipalities(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(Municipality::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
    #[OA\Get(
        path: '/municipalities/{municipalityId}',
        description: 'Returns details about a municipality',
        parameters: [
            new OA\Parameter(
                name: 'municipalityId',
                description: 'The id of the municipality',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a municipality',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Municipality',
                ),
            ),
        ],
    )]
    public function getMunicipality(string $municipalityId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(ResidentialArea::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$municipalityId),
                self::MUNICIPALITY_DETAIL_FIELDS
            )
        );
    }

    /**
     * RESIDENTIALAREAS
     */

    #[Route('/residentialareas', name: 'listresidentialareas', methods: ['GET'])]
    #[OA\Get(
        path: '/residentialareas',
        description: 'Returns details about multiple residential areas',
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about residential areas',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/residentialAreas',
                ),
            ),
        ],
    )]
    public function getResidentialAreas(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(ResidentialArea::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
    #[OA\Get(
        path: '/residentialareas/{residentialAreaId}',
        description: 'Returns details about a residential area',
        parameters: [
            new OA\Parameter(
                name: 'residentialAreaId',
                description: 'The id of the residential area',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a residential area',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ResidentialArea',
                ),
            ),
        ],
    )]
    public function getResidentialArea(string $residentialAreaId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(ResidentialArea::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$residentialAreaId),
                self::RESIDENTIALAREA_DETAIL_FIELDS
            )
        );
    }

    /**
     * NEIGHBOURHOODS
     */

    #[Route('/neighbourhoods', name: 'listneighbourhoods', methods: ['GET'])]
    #[OA\Get(
        path: '/neighbourhoods',
        description: 'Returns details about multiple neighbourhoods',
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple neighbourhoods',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/neighbourhoods',
                ),
            ),
        ],
    )]
    public function getNeighbourhoods(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(Neighbourhood::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
    #[OA\Get(
        path: '/neighbourhoods/{neighbourhoodId}',
        description: 'Returns details about a neighbourhood',
        parameters: [
            new OA\Parameter(
                name: 'neighbourhoodId',
                description: 'The id of the neighbourhood',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a neighbourhood',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Neighbourhood',
                ),
            ),
        ],
    )]
    public function getNeighbourhood(string $neighbourhoodId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(Neighbourhood::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$neighbourhoodId),
                self::NEIGHBOURHOOD_DETAIL_FIELDS
            )
        );
    }

    /**
     * VTWS
     */

    #[Route('/vtws', name: 'listvtws', methods: ['GET'])]
    #[OA\Get(
        path: '/vtws',
        description: 'Returns details about multiple vtws',
        parameters: [
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple vtws',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/vtws',
                ),
            ),
        ],
    )]
    public function getVtws(Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(Vtw::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
    #[OA\Get(
        path: '/vtws/{vtwId}',
        description: 'Returns details about a vtw',
        parameters: [
            new OA\Parameter(
                name: 'vtwId',
                description: 'The id of the vtw',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a vtw',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Vtw',
                ),
            ),
        ],
    )]
    public function getVtw(string $vtwId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(Vtw::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$vtwId),
                self::VTW_DETAIL_FIELDS
            )
        );
    }

    /**
     * CITIES
     */

    #[Route('/housingstocks/{housingStockId}/cities', name: 'listcities', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/cities',
        description: 'Returns details about multiple cities',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple cities',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/cities',
                ),
            ),
        ],
    )]
    public function getCities(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $cityRepository = $this->managerRegistry->getRepository(City::class);
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/cities/{cityId}',
        description: 'Returns details about a city',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'cityId',
                description: 'The id of the city',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a city',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/City',
                ),
            ),
        ],
    )]
    public function getCity(string $cityId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(City::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$cityId),
                self::CITY_DETAIL_FIELDS
            )
        );
    }

    /**
     * PUBLICSPACES
     */

    #[Route('/housingstocks/{housingStockId}/publicspaces', name: 'listpublicspaces', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/publicspaces',
        description: 'Returns details about multiple publicspaces',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple publicspaces',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/publicspaces',
                ),
            ),
        ],
    )]
    public function getPublicSpaces(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $publicSpaceRepository = $this->managerRegistry->getRepository(PublicSpace::class);
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/publicspaces/{publicSpaceId}',
        description: 'Returns details about a publicspace',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'publicSpaceId',
                description: 'The id of the publicspace',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a publicspace',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/PublicSpace',
                ),
            ),
        ],
    )]
    public function getPublicSpace(string $publicSpaceId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(PublicSpace::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$publicSpaceId),
                self::PUBLICSPACE_DETAIL_FIELDS
            )
        );
    }

    /**
     * BUILDINGS
     */

    #[Route('/housingstocks/{housingStockId}/buildings', name: 'listbuildings', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/buildings',
        description: 'Returns details about multiple buildings',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple buildings',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/buildings',
                ),
            ),
        ],
    )]
    public function getBuildings(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $buildingRepository = $this->managerRegistry->getRepository(Building::class);
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/buildings/{buildingId}',
        description: 'Returns details about a building',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'buildingId',
                description: 'The id of the building',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a building',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Building',
                ),
            ),
        ],
    )]
    public function getBuilding(string $buildingId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(Building::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$buildingId),
                self::BUILDING_DETAIL_FIELDS
            )
        );
    }

    /**
     * RESIDENCES
     */

    #[Route('/housingstocks/{housingStockId}/residences', name: 'listresidences', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/residences',
        description: 'Returns details about multiple residences',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple residences',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/residences',
                ),
            ),
        ],
    )]
    public function getResidences(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $residenceRepository = $this->managerRegistry->getRepository(Residence::class);
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/residences/{residenceId}',
        description: 'Returns details about a residence',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'residenceId',
                description: 'The id of the residence',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a residence',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Residence',
                ),
            ),
        ],
    )]
    public function getResidence(string $residenceId): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $objectRepository = $this->managerRegistry->getRepository(Residence::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $objectRepository->find((int)$residenceId),
                self::RESIDENCE_DETAIL_FIELDS
            )
        );
    }

    /**
     * BLOCKS
     */

    #[Route('/housingstocks/{housingStockId}/blocks', name: 'listblocks', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/blocks',
        description: 'Returns details about multiple blocks',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple blocks',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/blocks',
                ),
            ),
        ],
    )]
    public function getBlocks(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $blockRepository = $this->managerRegistry->getRepository(Block::class);
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
            } catch (AccessDeniedException) {
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
    #[OA\Post(
        path: '/housingstocks/{housingStockId}/blocks',
        summary: 'Add new block',
        requestBody: new OA\RequestBody(
            description: 'Details about new block',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'financialnumber',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created block',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Block',
                ),
            ),
        ],
    )]
    public function addBlock(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newBlock = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

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

        $constraintViolationList = $validator->validate($block);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($block);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $block,
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'changeblock', methods: ['PUT'])]
    #[OA\Put(
        path: '/housingstocks/{housingStockId}/blocks/{blockId}',
        description: 'Change block',
        requestBody: new OA\RequestBody(
            description: 'Details for changing block',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'financialnumber',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'blockId',
                description: 'The id of the block',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about changed block',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Block',
                ),
            ),
        ],
    )]
    public function changeBlock(string $housingStockId, string $blockId, Request $request, ValidatorInterface $validator): Response
    {
        $changeBlock = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(Block::class);
        /** @var Block $block */
        $block = $objectRepository->find((int) $blockId);

        $housingStockRepository = $this->managerRegistry->getRepository(HousingStock::class);
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

        $constraintViolationList = $validator->validate($block);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($block);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $block,
                self::BLOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'deleteblock', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/housingstocks/{housingStockId}/blocks/{blockId}',
        description: 'Delete block',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'blockId',
                description: 'The id of the block',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successfully deleted a block',
            ),
        ],
    )]
    public function deleteBlock(string $housingStockId, string $blockId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(Block::class);
        /** @var Block $block */
        $block = $objectRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]);

        $this->denyAccessUnlessGranted(BlockVoter::DELETE, $block);

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->remove($block);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/blocks/{blockId}', name: 'getblock', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/blocks/{blockId}',
        description: 'Returns details about a block',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'blockId',
                description: 'The id of the block',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a block',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Block',
                ),
            ),
        ],
    )]
    public function getBlock(string $housingStockId, string $blockId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(Block::class);

        $block = $objectRepository->findOneBy(
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/buildingtypes',
        description: 'Returns details about multiple buildingtypes',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple buildingtypes',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/buildingTypes',
                ),
            ),
        ],
    )]
    public function getBuildingTypes(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $buildingTypeRepository = $this->managerRegistry->getRepository(BuildingType::class);
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
            } catch (AccessDeniedException) {
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
    #[OA\Post(
        path: '/housingstocks/{housingStockId}/buildingtypes',
        summary: 'Add new buildingtype',
        requestBody: new OA\RequestBody(
            description: 'Details about new buildingtype',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created buildingtype',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BuildingType',
                ),
            ),
        ],
    )]
    public function addBuildingType(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newBuildingType = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

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

        $constraintViolationList = $validator->validate($buildingType);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($buildingType);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingType,
                self::BUILDINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}', name: 'changebuildingtype', methods: ['PUT'])]
    #[OA\Put(
        path: '/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}',
        description: 'Change buildingtype',
        requestBody: new OA\RequestBody(
            description: 'Details for changing buildingtype',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'description',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'buildingTypeId',
                description: 'The id of the buildingtype',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about changed buildingtype',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BuildingType',
                ),
            ),
        ],
    )]
    public function changeBuildingType(string $housingStockId, string $buildingTypeId, Request $request, ValidatorInterface $validator): Response
    {
        $changeBuildingType = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $objectRepository->find((int) $buildingTypeId);

        $housingStockRepository = $this->managerRegistry->getRepository(HousingStock::class);
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

        $constraintViolationList = $validator->validate($buildingType);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($buildingType);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $buildingType,
                self::BUILDINGTYPE_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}', name: 'deletebuildingtype', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/housingstocks/{housingStockId}/buildingtypes/{buildingTypeId}',
        description: 'Delete buildingtype',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'buildingTypeId',
                description: 'The id of the buildingtype',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successfully deleted a buildingtype',
            ),
        ],
    )]
    public function deleteBuildingType(string $housingStockId, string $buildingTypeId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $objectRepository->findOneBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingTypeId]);

        $this->denyAccessUnlessGranted(BuildingTypeVoter::DELETE, $buildingType);

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->remove($buildingType);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}', name: 'getbuildingtype', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}',
        description: 'Returns details about a buildingtype',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'buildingtypeId',
                description: 'The id of the buildingtype',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about a buildingtype',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/BuildingType',
                ),
            ),
        ],
    )]
    public function getBuildingType(string $housingStockId, string $buildingtypeId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(BuildingType::class);
        $buildingType = $objectRepository->findOneBy(
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
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/addresses',
        description: 'Returns details about multiple addresses',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'page',
                description: 'The page number to get',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'searchterm',
                description: 'The searchterm',
                in: 'query',
                required: false,
                schema: new OA\Schema(
                    type: 'string',
                ),
                example: 'test',
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about multiple addresses',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/addresses',
                ),
            ),
        ],
    )]
    public function getAddresses(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $addressRepository = $this->managerRegistry->getRepository(Address::class);
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
            } catch (AccessDeniedException) {
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
    #[OA\Post(
        path: '/housingstocks/{housingStockId}/addresses',
        summary: 'Add new address',
        requestBody: new OA\RequestBody(
            description: 'Details about new address',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'residentialarea',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'block',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'buildingtype',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'livingtype',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'rentalunitnumber',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'streetname',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'housenumber',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'addition',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'zipcode',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'city',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'bagid',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'constructionyear',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'renovationyear',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'orientation',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'deab',
                        type: 'boolean',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created address',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Address',
                ),
            ),
        ],
    )]
    public function addAddress(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newAddress = json_decode($request->getContent(), true);

        $arcgisRepository = new arcgisRepository();

        try {
            $arcgisAddress = $arcgisRepository->getAddressByZipcodeAndHousenumber($newAddress['zipcode'], $newAddress['housenumber'], empty($newAddress['addition']) ? null : $newAddress['addition']);
        } catch (ArcgisException $arcgisException) {
            $this->logger->debug(
                $arcgisException->getMessage(),
                array_merge(
                    $arcgisException->getContext(),
                    [
                        'subject' => 'error with request to arcgis api',
                        'class' => self::class,
                        'function' => __FUNCTION__,
                        'line' => __LINE__,
                    ]
                )
            );
            return new Response('Arcgis error, see logs.', 500);
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
                        'class' => self::class,
                        'function' => __FUNCTION__,
                        'line' => __LINE__,
                    ]
                )
            );
            return new Response('CBS error, see logs.', 500);
        }

        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $objectRepository->find((int) $housingStockId);

        $blockRepository = $this->managerRegistry->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $newAddress['block']);

        $buildingTypeRepository = $this->managerRegistry->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $newAddress['buildingtype']);

        $vtwRepository = $this->managerRegistry->getRepository(Vtw::class);
        /** @var Vtw $vtw */
        $vtw = $vtwRepository->find((int) $newAddress['vtw']);

        $municipalityRepository = $this->managerRegistry->getRepository(Municipality::class);
        /** @var Municipality $municipality */
        $municipality = $municipalityRepository->findOneBy(['code' => $cbsResults['municipality']]);

        $residentialAreaRepository = $this->managerRegistry->getRepository(ResidentialArea::class);
        /** @var ResidentialArea $residentialArea */
        $residentialArea = $residentialAreaRepository->findOneBy(['code' => $cbsResults['residentialarea']]);

        $neighbourhoodRepository = $this->managerRegistry->getRepository(Neighbourhood::class);
        /** @var Neighbourhood $neighbourhood */
        $neighbourhood = $neighbourhoodRepository->findOneBy(['code' => $cbsResults['neighbourhood']]);

        $cityRepository = $this->managerRegistry->getRepository(City::class);
        /** @var City $city */
        $city = $cityRepository->findOneBy(['identification' => $arcgisAddress['city']['identification']]);
        if ($city === null) {
            $city = new City();
            $city->setObjectId($arcgisAddress['city']['objectid']);
            $city->setIdentification($arcgisAddress['city']['identification']);
            $city->setName($arcgisAddress['city']['name']);
            $cityManager = $this->managerRegistry->getManager(City::class);
            $cityManager->persist($city);
        }

        $buildingRepository = $this->managerRegistry->getRepository(Building::class);
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
            $buildingManager = $this->managerRegistry->getManager(Building::class);
            $buildingManager->persist($building);
        }

        $residenceRepository = $this->managerRegistry->getRepository(Residence::class);
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
            $residenceManager = $this->managerRegistry->getManager(Residence::class);
            $residenceManager->persist($residence);
        }

        $publicSpaceRepository = $this->managerRegistry->getRepository(PublicSpace::class);
        /** @var PublicSpace $publicSpace */
        $publicSpace = $publicSpaceRepository->findOneBy(['identification' => $arcgisAddress['publicspace']['identification']]);
        if ($publicSpace === null) {
            $publicSpace = new PublicSpace();
            $publicSpace->setObjectId($arcgisAddress['publicspace']['objectid']);
            $publicSpace->setIdentification($arcgisAddress['publicspace']['identification']);
            $publicSpace->setName($arcgisAddress['publicspace']['name']);
            $publicSpace->setType($arcgisAddress['publicspace']['type']);
            $publicSpaceManager = $this->managerRegistry->getManager(PublicSpace::class);
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

        $constraintViolationList = $validator->validate($address);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($address);
        try {
            $objectManager->flush();
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
    #[OA\Put(
        path: '/housingstocks/{housingStockId}/addresses/{addressId}',
        description: 'Change address',
        requestBody: new OA\RequestBody(
            description: 'Details for changing address',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'residentialarea',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'block',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'buildingtype',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'livingtype',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'rentalunitnumber',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'streetname',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'housenumber',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'addition',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'zipcode',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'city',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'bagid',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'constructionyear',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'renovationyear',
                        type: 'integer',
                    ),
                    new OA\Property(
                        property: 'orientation',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'deab',
                        type: 'boolean',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'addressId',
                description: 'The id of the address',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about changed address',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Address',
                ),
            ),
        ],
    )]
    public function changeAddress(string $housingStockId, string $addressId, Request $request, ValidatorInterface $validator): Response
    {
        $changeAddress = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(Address::class);
        /** @var Address $address */
        $address = $objectRepository->find((int) $addressId);

        $housingStockRepository = $this->managerRegistry->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $blockRepository = $this->managerRegistry->getRepository(Block::class);
        /** @var Block $block */
        $block = $blockRepository->find((int) $changeAddress['block']);

        $buildingTypeRepository = $this->managerRegistry->getRepository(BuildingType::class);
        /** @var BuildingType $buildingType */
        $buildingType = $buildingTypeRepository->find((int) $changeAddress['buildingtype']);

        $vtwRepository = $this->managerRegistry->getRepository(Vtw::class);
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

        $constraintViolationList = $validator->validate($address);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->persist($address);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $address,
                self::HOUSING_STOCK_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'deleteaddress', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/housingstocks/{housingStockId}/addresses/{addressId}',
        description: 'Delete address',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'addressId',
                description: 'The id of the address',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Successfully deleted an address',
            ),
        ],
    )]
    public function deleteAddress(string $housingStockId, string $addressId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(Address::class);
        /** @var Address $address */
        $address = (object)$objectRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $addressId], null, 1);

        $this->denyAccessUnlessGranted(AddressVoter::DELETE, $address);

        $objectManager = $this->managerRegistry->getManager();
        $objectManager->remove($address);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/housingstocks/{housingStockId}/addresses/{addressId}', name: 'getaddress', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/addresses/{addressId}',
        description: 'Returns details about an address',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'addressId',
                description: 'The id of the address',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about an address',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Address',
                ),
            ),
        ],
    )]
    public function getAddress(string $housingStockId, string $addressId): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(Address::class);
        $address = $objectRepository->findOneBy(
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

    public function setLogger(LoggerInterface $logger): void
    {
        $this->logger = $logger;
    }
}

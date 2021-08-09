<?php

namespace App\Controller\Api\V1;

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

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route(
    '/api/buildingexaminator/v1',
    name: 'api-v1-'
)]
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

    #[Route(
        '/documentation',
        name: 'documentation',
        methods: ['GET']
    )]
    public function getDocumentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }

    #[Route(
        '/housingstocks',
        name: 'housingstocks',
        methods: ['GET']
    )]
    public function getHousingStocks(LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStocks = $housingStockRepository->findAll();

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $housingStocks,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::HOUSING_STOCK_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}',
        name: 'housingstock',
        methods: ['GET']
    )]
    public function getHousingStock(string $housingStockId, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $housingStock,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::HOUSING_STOCK_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/blocks',
        name: 'blocks',
        methods: ['GET']
    )]
    public function getBlocks(string $housingStockId, LoggerInterface $logger): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        $blocks = $blockRepository->findBy(
            [
                'housingStock' => (int) $housingStockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $blocks,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::BLOCK_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/blocks/{blockId}',
        name: 'block',
        methods: ['GET']
    )]
    public function getBlock(string $housingStockId, string $blockId, LoggerInterface $logger): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        $block = $blockRepository->findBy(
            [
                'housingStock' => (int) $housingStockId,
                'id' => (int) $blockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $block,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::BLOCK_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/addresses',
        name: 'addresses',
        methods: ['GET']
    )]
    public function getAddresses(string $housingStockId, LoggerInterface $logger): Response {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        $addresses = $addressRepository->findBy(
            [
                'housingStock' => (int) $housingStockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $addresses,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::ADDRESS_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/addresses/{addressId}',
        name: 'address',
        methods: ['GET']
    )]
    public function getAddress(string $housingStockId, string $addressId, LoggerInterface $logger): Response {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        $addresses = $addressRepository->findBy(
            [
                'housingStock' => (int) $housingStockId,
                'id' => (int) $addressId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $addresses,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::ADDRESS_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/buildingtypes',
        name: 'buildingtypes',
        methods: ['get']
    )]
    public function getBuildingTypes(string $housingStockId, LoggerInterface $logger): Response {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $buildingTypes = $buildingTypeRepository->findBy(
            [
                'housingStock' => (int) $housingStockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $buildingTypes,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::BUILDINGTYPE_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}',
        name: 'buildingtype',
        methods: ['get']
    )]
    public function getBuildingType(string $housingStockId, string $buildingtypeId, LoggerInterface $logger): Response {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        $buildingTypes = $buildingTypeRepository->findBy(
            [
                'housingStock' => (int) $housingStockId,
                'id' => (int) $buildingtypeId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $buildingTypes,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::BUILDINGTYPE_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/livingtypes',
        name: 'livingtypes',
        methods: ['get']
    )]
    public function getLivingTypes(string $housingStockId, LoggerInterface $logger): Response {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        $livingTypes = $livingTypeRepository->findBy(
            [
                'housingStock' => (int) $housingStockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $livingTypes,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::LIVINGTYPE_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/livingtypes/{livingTypeId}',
        name: 'livingtype',
        methods: ['get']
    )]
    public function getLivingType(string $housingStockId, string $livingTypeId, LoggerInterface $logger): Response {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        $livingType = $livingTypeRepository->findBy(
            [
                'housingStock' => (int) $housingStockId,
                'id' => (int) $livingTypeId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $livingType,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::LIVINGTYPE_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/residentialareas',
        name: 'residentialareas',
        methods: ['get']
    )]
    public function getResidentialAreas(string $housingStockId, LoggerInterface $logger): Response {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        $residentialAreas = $residentialAreaRepository->findBy(
            [
                'housingStock' => (int) $housingStockId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $residentialAreas,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::RESIDENTIALAREA_LIST_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}',
        name: 'residentialArea',
        methods: ['get']
    )]
    public function getResidentialArea(string $housingStockId, string $residentialAreaId, LoggerInterface $logger): Response {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        $residentialArea = $residentialAreaRepository->findBy(
            [
                'housingStock' => (int) $housingStockId,
                'id' => (int) $residentialAreaId
            ]
        );

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $residentialArea,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::RESIDENTIALAREA_DETAIL_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing an array',
                [
                    'exception' => $exception,
                    'request' => Request::createFromGlobals(),
                ]
            );
        }

        return $this->json($data);
    }

    private function getSerializer(): Serializer {
        return new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }
}
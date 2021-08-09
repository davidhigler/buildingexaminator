<?php

namespace App\Controller\Api\V1;

use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\HousingStock;
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
    private const HOUSING_STOCK_FIELDS = [
        'id',
        'blocks' => [
            'id',
            'name',
        ],
        'buildingTypes' => [
            'id',
            'name',
        ],
        'livingTypes' => [
            'id',
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
        'code',
        'name',
        'description',
        'numberOfBlocks',
        'numberOfBuildingAddresses',
    ];

    private const BLOCK_FIELDS = [
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
            'name',
        ],
        'financialNumber',
    ];

    private const ADDRESS_FIELDS = [
        'id',
        'code',
        'name',
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
        'streetName',
        'houseNumber',
        'addition',
        'zipcode',
        'city',
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
                [AbstractNormalizer::ATTRIBUTES => self::HOUSING_STOCK_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error(
                'Something went wrong with normalizing a housingStocks array',
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
                [AbstractNormalizer::ATTRIBUTES => self::HOUSING_STOCK_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing a housingStock object',
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
                [AbstractNormalizer::ATTRIBUTES => self::BLOCK_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing a blocks array',
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
                [AbstractNormalizer::ATTRIBUTES => self::BLOCK_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing a block object',
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
                [AbstractNormalizer::ATTRIBUTES => self::ADDRESS_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing a blocks array',
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
<?php

namespace App\Controller\Api\V1;

use App\Entity\Portefeuille\HousingStock;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/api/v1', name: 'api-v1-')]
class ApiController extends AbstractController
{
    private const HOUSING_STOCK_FIELDS = [
        'id',
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

    /**
     * Returns the documentation for the V1 API documentation
     * @return Response
     */
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
            $logger->error('Something went wrong with normalizing a housingStocks array', ['exception' => $exception]);
        }

        return $this->json($data);
    }

    #[Route(
        '/housingstocks/{projectId}',
        name: 'housingstock',
        methods: ['GET']
    )]
    public function getHousingStock(string $projectId, LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStock = $housingStockRepository->find((int) $projectId);

        $data = [];

        try {
            $data = $this->getSerializer()->normalize(
                $housingStock,
                null,
                [AbstractNormalizer::ATTRIBUTES => self::HOUSING_STOCK_FIELDS]
            );
        } catch (ExceptionInterface $exception) {
            $logger->error('Something went wrong with normalizing a housingStock object', ['exception' => $exception]);
        }

        return $this->json($data);
    }

    private function getSerializer(): Serializer {
        return new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }
}
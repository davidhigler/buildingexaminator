<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\HousingStock;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route('/api/v1', name: 'api-v1-')]
class StatisticsController extends AbstractController
{
    public function __construct(
        private readonly ManagerRegistry $managerRegistry)
    {}

    #[Route('/statistics', name: 'globalstatistics', methods: ['GET'])]
    public function getGlobalStatistics(): Response
    {
        $objectRepository = $this->managerRegistry->getRepository(HousingStock::class);
        $housingStockQueryBuilder = $objectRepository->createQueryBuilder('o');

        $housingStockQueryBuilder->select('count(o.id)');

        $housingStockCount = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $housingStockQueryBuilder->select('max(o.creationTime)');
        $housingStockLatestCreate = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $housingStockQueryBuilder->select('max(o.lastChangeTime)');
        $housingStockLatestChange = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $addressesRepository = $this->managerRegistry->getRepository(Address::class);
        $addressesQueryBuilder = $addressesRepository->createQueryBuilder('o');

        $addressesQueryBuilder->select('count(o.id)');

        $addressesCount = $addressesQueryBuilder->getQuery()->getSingleScalarResult();

        return $this->json([
            'HousingStocks' => [
                'Count' => $housingStockCount,
                'LatestCreate' => $housingStockLatestCreate,
                'LatestChange' => $housingStockLatestChange
            ],
            'Addresses' => [
                'Count' => $addressesCount,
            ]
        ]);
    }
}

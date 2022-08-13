<?php

namespace App\Controller\Api\V1;

use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\HousingStock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
class StatisticsController extends AbstractController
{
    #[Route('/statistics', name: 'globalstatistics', methods: ['GET'])]
    public function getGlobalStatistics(): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingStockQueryBuilder = $housingStockRepository->createQueryBuilder('o');

        $housingStockQueryBuilder->select('count(o.id)');
        $housingStockCount = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $housingStockQueryBuilder->select('max(o.creationTime)');
        $housingStockLatestCreate = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $housingStockQueryBuilder->select('max(o.lastChangeTime)');
        $housingStockLatestChange = $housingStockQueryBuilder->getQuery()->getSingleScalarResult();

        $addressesRepository = $this->getDoctrine()->getRepository(Address::class);
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
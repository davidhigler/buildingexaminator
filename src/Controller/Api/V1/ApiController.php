<?php

namespace App\Controller\Api\V1;

use OpenApi\Annotations as OA;
use App\Entity\Portfolio\Block;
use App\Entity\Portfolio\BuildingAddress;
use App\Entity\Portfolio\BuildingType;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Portfolio\LivingType;
use App\Entity\Portfolio\ResidentialArea;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/buildingexaminator/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Info(title="Building Examinator", version="0.0.1")
 * @OA\Schema(
 *     schema="HousingStocks",
 *     title="Housing stocks",
 *     description="An array of housing stocks",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/HousingStock")
 * )
 * @OA\Schema(
 *     schema="Blocks",
 *     title="Blocks",
 *     description="An array of blocks",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/Block")
 * )
 * @OA\Schema(
 *     schema="Addresses",
 *     title="Addresses",
 *     description="An array of addresses",
 *     type="array",
 *     @OA\Items(ref="#/components/schemas/BuildingAddress")
 * )
 */
class ApiController extends AbstractController
{
    #[Route('/documentation', name: 'documentation', methods: ['GET'])]
    public function getDocumentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }

    #[Route('/housingstocks', name: 'housingstocks', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/housingstocks",
     *     summary="Returns details about multiple housing stocks",
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple housing stocks",
     *         @OA\JsonContent(ref="#/components/schemas/HousingStocks")
     *     )
     * )
     */
    public function getHousingStocks(LoggerInterface $logger): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        return $this->json($housingStockRepository->findAll());
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
        return $this->json($housingStockRepository->find((int) $housingStockId));
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
     *         @OA\JsonContent(ref="#/components/schemas/Blocks")
     *     )
     * )
     */
    public function getBlocks(string $housingStockId, LoggerInterface $logger): Response
    {
        $blockRepository = $this->getDoctrine()->getRepository(Block::class);
        return $this->json($blockRepository->findBy(['housingStock' => (int) $housingStockId]));
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
        return $this->json($blockRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $blockId]));
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
     *         @OA\JsonContent(ref="#/components/schemas/Addresses")
     *     )
     * )
     */
    public function getAddresses(string $housingStockId, LoggerInterface $logger): Response
    {
        $addressRepository = $this->getDoctrine()->getRepository(BuildingAddress::class);
        return $this->json($addressRepository->findBy(['housingStock' => (int) $housingStockId]));
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
        return $this->json($addressRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $addressId]));
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes', name: 'buildingtypes', methods: ['get'])]
    public function getBuildingTypes(string $housingStockId, LoggerInterface $logger): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        return $this->json($buildingTypeRepository->findBy(['housingStock' => (int) $housingStockId]));
    }

    #[Route('/housingstocks/{housingStockId}/buildingtypes/{buildingtypeId}', name: 'buildingtype', methods: ['get'])]
    public function getBuildingType(string $housingStockId, string $buildingtypeId, LoggerInterface $logger): Response
    {
        $buildingTypeRepository = $this->getDoctrine()->getRepository(BuildingType::class);
        return $this->json($buildingTypeRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $buildingtypeId]));
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes', name: 'livingtypes', methods: ['get'])]
    public function getLivingTypes(string $housingStockId, LoggerInterface $logger): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        return $this->json($livingTypeRepository->findBy(['housingStock' => (int) $housingStockId]));
    }

    #[Route('/housingstocks/{housingStockId}/livingtypes/{livingTypeId}', name: 'livingtype', methods: ['get'])]
    public function getLivingType(string $housingStockId, string $livingTypeId, LoggerInterface $logger): Response
    {
        $livingTypeRepository = $this->getDoctrine()->getRepository(LivingType::class);
        return $this->json($livingTypeRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $livingTypeId]));
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas', name: 'residentialareas', methods: ['get'])]
    public function getResidentialAreas(string $housingStockId, LoggerInterface $logger): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->json($residentialAreaRepository->findBy(['housingStock' => (int) $housingStockId]));
    }

    #[Route('/housingstocks/{housingStockId}/residentialareas/{residentialAreaId}', name: 'residentialArea', methods: ['get'])]
    public function getResidentialArea(string $housingStockId, string $residentialAreaId, LoggerInterface $logger): Response
    {
        $residentialAreaRepository = $this->getDoctrine()->getRepository(ResidentialArea::class);
        return $this->json($residentialAreaRepository->findBy(['housingStock' => (int) $housingStockId, 'id' => (int) $residentialAreaId]));
    }
}
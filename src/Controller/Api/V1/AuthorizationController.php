<?php

namespace App\Controller\Api\V1;

use App\Entity\Authorization\Owner;
use App\Helpers\ApiRenderEngine;
use App\Helpers\ErrorExtractor;
use Exception;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use OpenApi\Annotations as OA;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
class AuthorizationController extends AbstractController
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

    /**
     * OWNERS
     */

    #[Route('/owners', name: 'listowners', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/owners",
     *     summary="Returns details about multiple owners",
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
    public function getOwners(Request $request): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        $adapter = $ownerRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.lnumber', $adapter->expr()->literal($searchTerm . '%')),
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
                self::OWNER_LIST_FIELDS
            )
        );
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
    public function addOwner(Request $request, ValidatorInterface $validator): Response
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
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($owner);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
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
    public function changeOwner(string $ownerId, Request $request, ValidatorInterface $validator): Response
    {
        $changeOwner = json_decode($request->getContent(), true);

        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $ownerId);

        $owner->setName($changeOwner['name']);
        if (!empty($changeOwner['kvk'])) {
            $owner->setKvk($changeOwner['kvk']);
        } else {
            $owner->setKvk(null);
        }
        if (!empty($changeOwner['btw'])) {
            $owner->setBtw($changeOwner['btw']);
        } else {
            $owner->setBtw(null);
        }
        if (!empty($changeOwner['lnumber'])) {
            $owner->setLnumber($changeOwner['lnumber']);
        } else {
            $owner->setLnumber(null);
        }
        if (!empty($changeOwner['website'])) {
            $owner->setWebsite($changeOwner['website']);
        } else {
            $owner->setWebsite(null);
        }

        $violations = $validator->validate($owner);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($owner);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
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
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $ownerId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($owner);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

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
    public function getOwner(string $ownerId): Response
    {
        $ownerRepository = $this->getDoctrine()->getRepository(Owner::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $ownerRepository->find(
                    (int) $ownerId
                ),
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

}
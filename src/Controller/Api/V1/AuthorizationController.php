<?php

namespace App\Controller\Api\V1;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Owner;
use App\Entity\Authorization\Subcontractor;
use App\Helpers\ApiRenderEngine;
use App\Helpers\ErrorExtractor;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use OpenApi\Annotations as OA;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 *
 * @OA\Schema(
 *     schema="owners",
 *     title="Owners",
 *     description="An array of owners",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Owner")
 *     )
 * )
 * @OA\Schema(
 *     schema="users",
 *     title="Users",
 *     description="An array of users",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Users")
 *     )
 * )
 * @OA\Schema(
 *     schema="contractors"
 *     title="Contractors",
 *     description="An array of contractors",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/Contractor")
 *     )
 * )
 */
class AuthorizationController extends AbstractController
{
    private const DEFAULT_PAGE_LIMIT = 10;

    private const OWNER_LIST_FIELDS = [
        'id',
        'name',
        'lnumber',
    ];

    private const OWNER_DETAIL_FIELDS = [
        'id',
        'name',
        'kvk',
        'btw',
        'lnumber',
        'website',
        'housingStocks' => [
            'id',
            'code',
            'name',
            'description',
        ],
    ];

    private const CONTRACTOR_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'website',
    ];

    private const CONTRACTOR_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'kvk',
        'btw',
        'website',
    ];

    private const SUBCONTRACTOR_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'website',
    ];

    private const SUBCONTRACTOR_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'kvk',
        'btw',
        'website',
    ];

    private const USER_LIST_FIELDS = [
        'id',
        'email',
        'admin',
        'type',
    ];

    private const USER_DETAIL_FIELDS = [
        'id',
        'email',
        'admin',
        'type',
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
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple owners",
     *         @OA\JsonContent(ref="#/components/schemas/owners")
     *     )
     * )
     */
    public function getOwners(Request $request, PaginatorInterface $paginator): Response
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

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, self::DEFAULT_PAGE_LIMIT);
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
     *         description="Details about changed owner",
     *         @OA\JsonContent(ref="#/components/schemas/Owner")
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

    /** CONTRACTORS */

    #[Route('/contractors', name: 'listcontractors', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/contractors",
     *     summary="Returns details about multiple contractors",
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
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple contractors",
     *         @OA\JsonContent(ref="#/components/schemas/contractors")
     *     )
     * )
     */
    public function getContractors(Request $request, PaginatorInterface $paginator): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $contractorRepository = $this->getDoctrine()->getRepository(Contractor::class);
        $adapter = $contractorRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.code', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, self::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::CONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/contractors', name: 'addcontractor', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/contractors",
     *     summary="Add new contractor",
     *     @OA\RequestBody(
     *         description="Details about new contractor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
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
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created contractor",
     *         @OA\JsonContent(ref="#/components/schemas/Contractor")
     *     )
     * )
     */
    public function addContractor(Request $request, ValidatorInterface $validator): Response
    {
        $newContractor = json_decode($request->getContent(), true);

        $contractor = new Contractor();
        if (!empty($newContractor['code'])) {
            $contractor->setCode($newContractor['code']);
        }
        if (!empty($newContractor['name'])) {
            $contractor->setName($newContractor['name']);
        }
        if (!empty($newContractor['kvk'])) {
            $contractor->setKvk($newContractor['kvk']);
        }
        if (!empty($newContractor['btw'])) {
            $contractor->setBtw($newContractor['btw']);
        }
        if (!empty($newContractor['website'])) {
            $contractor->setWebsite($newContractor['website']);
        }

        $violations = $validator->validate($contractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contractor);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/contractors/{contractorId}', name: 'changecontractor', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/contractors/{contractorId}",
     *     summary="Change contractor",
     *     @OA\RequestBody(
     *         description="Details for changing contractor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
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
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the contractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed contractor",
     *         @OA\JsonContent(ref="#/components/schemas/Contractor")
     *     )
     * )
     */
    public function changeContractor(string $contractorId, Request $request, ValidatorInterface $validator): Response
    {
        $changeContractor = json_decode($request->getContent(), true);

        $contractorRepository = $this->getDoctrine()->getRepository(Contractor::class);
        /** @var Contractor $contractor */
        $contractor = $contractorRepository->find((int) $contractorId);

        if (!empty($changeContractor['code'])) {
            $contractor->setCode($changeContractor['code']);
        }
        if (!empty($changeContractor['name'])) {
            $contractor->setName($changeContractor['name']);
        }
        if (!empty($changeContractor['kvk'])) {
            $contractor->setKvk($changeContractor['kvk']);
        }
        if (!empty($changeContractor['btw'])) {
            $contractor->setBtw($changeContractor['btw']);
        }
        if (!empty($changeContractor['website'])) {
            $contractor->setWebsite($changeContractor['website']);
        }

        $violations = $validator->validate($contractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($contractor);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/contractors/{contractorId}', name: 'deletecontractor', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/contractors/{contractorId}",
     *     summary="Delete contractor",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the contractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an contractor"
     *     )
     * )
     */
    public function deleteContractor(string $contractorId): Response
    {
        $contractorRepository = $this->getDoctrine()->getRepository(Contractor::class);
        /** @var Contractor $contractor */
        $contractor = $contractorRepository->find((int) $contractorId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($contractor);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/contractors/{contractorId}', name: 'getcontractor', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/contractors/{contractorId}",
     *     summary="Returns details about a contractor",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the contractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a contractor",
     *         @OA\JsonContent(ref="#/components/schemas/Contractor")
     *     )
     * )
     */
    public function getContractor(string $contractorId): Response
    {
        $contractorRepository = $this->getDoctrine()->getRepository(Contractor::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $contractorRepository->find(
                    (int) $contractorId
                ),
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    /** SUBCONTRACTORS */

    #[Route('/subcontractors', name: 'listsubcontractors', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/subcontractors",
     *     summary="Returns details about multiple subcontractors",
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
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple subcontractors",
     *         @OA\JsonContent(ref="#/components/schemas/subcontractors")
     *     )
     * )
     */
    public function getSubcontractors(Request $request, PaginatorInterface $paginator): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $subcontractorRepository = $this->getDoctrine()->getRepository(Subcontractor::class);
        $adapter = $subcontractorRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.code', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, self::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::SUBCONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/subcontractors', name: 'addsubcontractor', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/subcontractors",
     *     summary="Add new subcontractor",
     *     @OA\RequestBody(
     *         description="Details about new subcontractor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
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
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created subcontractor",
     *         @OA\JsonContent(ref="#/components/schemas/Subcontractor")
     *     )
     * )
     */
    public function addSubcontractor(Request $request, ValidatorInterface $validator): Response
    {
        $newSubcontractor = json_decode($request->getContent(), true);

        $subcontractor = new Subcontractor();
        if (!empty($newSubcontractor['code'])) {
            $subcontractor->setCode($newSubcontractor['code']);
        }
        if (!empty($newSubcontractor['name'])) {
            $subcontractor->setName($newSubcontractor['name']);
        }
        if (!empty($newSubcontractor['kvk'])) {
            $subcontractor->setKvk($newSubcontractor['kvk']);
        }
        if (!empty($newSubcontractor['btw'])) {
            $subcontractor->setBtw($newSubcontractor['btw']);
        }
        if (!empty($newSubcontractor['website'])) {
            $subcontractor->setWebsite($newSubcontractor['website']);
        }

        $violations = $validator->validate($subcontractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($subcontractor);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'changesubcontractor', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/subcontractors/{subcontractorId}",
     *     summary="Change subcontractor",
     *     @OA\RequestBody(
     *         description="Details for changing subcontractor",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="code",
     *                 type="string"
     *             ),
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
     *                 property="website",
     *                 type="string"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the subcontractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed subcontractor",
     *         @OA\JsonContent(ref="#/components/schemas/Subcontractor")
     *     )
     * )
     */
    public function changeSubcontractor(string $subcontractorId, Request $request, ValidatorInterface $validator): Response
    {
        $changeSubcontractor = json_decode($request->getContent(), true);

        $subcontractorRepository = $this->getDoctrine()->getRepository(Subcontractor::class);
        /** @var Subcontractor $subcontractor */
        $subcontractor = $subcontractorRepository->find((int) $subcontractorId);

        if (!empty($changeSubcontractor['code'])) {
            $subcontractor->setCode($changeSubcontractor['code']);
        }
        if (!empty($changeSubcontractor['name'])) {
            $subcontractor->setName($changeSubcontractor['name']);
        }
        if (!empty($changeSubcontractor['kvk'])) {
            $subcontractor->setKvk($changeSubcontractor['kvk']);
        }
        if (!empty($changeSubcontractor['btw'])) {
            $subcontractor->setBtw($changeSubcontractor['btw']);
        }
        if (!empty($changeSubcontractor['website'])) {
            $subcontractor->setWebsite($changeSubcontractor['website']);
        }

        $violations = $validator->validate($subcontractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($subcontractor);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'deletesubcontractor', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/contractors/{contractorId}",
     *     summary="Delete contractor",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the contractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted an contractor"
     *     )
     * )
     */
    public function deleteSubcontractor(string $subcontractorId): Response
    {
        $subcontractorRepository = $this->getDoctrine()->getRepository(Subcontractor::class);
        /** @var Subcontractor $subcontractor */
        $subcontractor = $subcontractorRepository->find((int) $subcontractorId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($subcontractor);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'getsubcontractor', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/subcontractors/{subcontractorId}",
     *     summary="Returns details about a subcontractor",
     *     @OA\Parameter(
     *         name="ownerId",
     *         description="The id of the subcontractor",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a subcontractor",
     *         @OA\JsonContent(ref="#/components/schemas/Subcontractor")
     *     )
     * )
     */
    public function getSubcontractor(string $subcontractorId): Response
    {
        $subcontractorRepository = $this->getDoctrine()->getRepository(Subcontractor::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractorRepository->find(
                    (int) $subcontractorId
                ),
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    /**
     * USERS
     */

    #[Route('/users', name: 'listusers', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/users",
     *     summary="Returns details about multiple users",
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
     *     @OA\Parameter(
     *         name="searchterm",
     *         description="The searchterm",
     *         @OA\Schema(
     *             type="string",
     *         ),
     *         in="query",
     *         required=false,
     *         example="test"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about multiple users",
     *         @OA\JsonContent(ref="#/components/schemas/users")
     *     )
     * )
     */
    public function getUsers(Request $request, PaginatorInterface $paginator): Response
    {
        $page = $request->query->get('page');
        $searchTerm = $request->query->get('searchterm');

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        $adapter = $userRepository->createQueryBuilder('o');
        if ($searchTerm !== null) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.email', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }
        $adapter->orderBy('o.email', 'ASC');

        $data = $adapter->getQuery()->getResult();

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, $page, self::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::USER_LIST_FIELDS
            )
        );
    }

    #[Route('/users', name: 'adduser', methods: ['POST'])]
    /**
     * @OA\Post(
     *     path="/users",
     *     summary="Add new user",
     *     @OA\RequestBody(
     *         description="Details about new user",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="email",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="confirmpassword",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="adminrole",
     *                 type="bool"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about created user",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function addUser(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher): Response
    {
        $newUser = json_decode($request->getContent(), true);

        if ($newUser['password'] !== $newUser['confirmpassword']) {
            $error = new stdClass();
            $error->code = 0;
            $error->message = 'Password and the confirm password are not the same';
            return $this->json([$error], 500);
        }

        $user = match ($newUser['type']) {
            'Dobro' => new User(),
            'Owner' => new OwnerUser(),
            'Contractor' => new ContractorUser(),
            'Subcontractor' => new SubcontractorUser(),
        };

        if (!empty($newUser['email'])) {
            $user->setEmail($newUser['email']);
        }
        if (!empty($newUser['password'])) {
            $user->setRawPassword($newUser['password']);
            $user->setPassword($hasher->hashPassword($user, $newUser['password']));
        }
        if (
            is_bool($newUser['adminrole'])
            || $newUser['adminrole'] === true
        ) {
            $user->setRoles(['ROLE_ADMIN']);
        } else {
            $user->setRoles([]);
        }

        $violations = $validator->validate($user);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $user,
                self::USER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/users/{userId}', name: 'changeuser', methods: ['PUT'])]
    /**
     * @OA\Put(
     *     path="/users/{userId}",
     *     summary="Change user",
     *     @OA\RequestBody(
     *         description="Details for changing user",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="email",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="password",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="confirmpassword",
     *                 type="string"
     *             ),
     *             @OA\Property(
     *                 property="adminrole",
     *                 type="bool"
     *             )
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="userId",
     *         description="The id of the user",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about changed user",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function changeUser(string $userId, Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher): Response
    {
        $changeUser = json_decode($request->getContent(), true);

        $userRepository = $this->getDoctrine()->getRepository(User::class);
        /** @var User $user */
        $user = $userRepository->find((int) $userId);

        if (!empty($changeUser['password'])) {
            if ($changeUser['password'] !== $changeUser['confirmpassword']) {
                $error = new stdClass();
                $error->code = 0;
                $error->message = 'Password and the confirm password are not the same';
                return $this->json([$error], 500);
            }
            $user->setRawPassword($changeUser['password']);
            $user->setPassword($hasher->hashPassword($user, $changeUser['password']));
        } else {
            $user->setRawPassword('Ab1#cdefgh');
        }
        if (!empty($changeUser['email'])) {
            $user->setEmail($changeUser['email']);
        }
        if (
            is_bool($changeUser['adminrole'])
            || $changeUser['adminrole'] === true
        ) {
            $user->setRoles(['ROLE_ADMIN']);
        } else {
            $user->setRoles([]);
        }

        $violations = $validator->validate($user);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $user,
                self::USER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/users/{userId}', name: 'deleteuser', methods: ['DELETE'])]
    /**
     * @OA\Delete(
     *     path="/users/{userId}",
     *     summary="Delete user",
     *     @OA\Parameter(
     *         name="userId",
     *         description="The id of the user",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successfully deleted a user"
     *     )
     * )
     */
    public function deleteUser(string $userId): Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        /** @var User $user */
        $user = $userRepository->find((int) $userId);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        try {
            $entityManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/users/{userId}', name: 'getuser', methods: ['GET'])]
    /**
     * @OA\Get(
     *     path="/users/{userId}",
     *     summary="Returns details about a user",
     *     @OA\Parameter(
     *         name="userId",
     *         description="The id of the user",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *         ),
     *         in="path",
     *         required=true
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Details about a user",
     *         @OA\JsonContent(ref="#/components/schemas/User")
     *     )
     * )
     */
    public function getUserInfo(string $userId): Response
    {
        $userRepository = $this->getDoctrine()->getRepository(User::class);
        return $this->json(
            ApiRenderEngine::renderData(
                $userRepository->find(
                    (int) $userId
                ),
                self::USER_DETAIL_FIELDS
            )
        );
    }
}
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
use App\Security\Voters\ContractorVoter;
use App\Security\Voters\OwnerVoter;
use App\Security\Voters\SubcontractorVoter;
use App\Security\Voters\UserVoter;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use OpenApi\Attributes as OA;
use stdClass;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route('/api/v1', name: 'api-v1-')]
#[OA\Schema(
    schema: 'owners',
    title: 'Owners',
    description: "An array of owners",
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Owner'
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'users',
    title: 'Users',
    description: 'An array of users',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/User'
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'contractors',
    title: 'Contractors',
    description: 'An array of contractors',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Contractor'
            ),
        ),
    ],
    type: 'object',
)]
#[OA\Schema(
    schema: 'subcontractors',
    title: 'Subcontractors',
    description: 'An array of subcontractors',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Subcontractor'
            ),
        ),
    ],
    type: 'object',
)]
class AuthorizationController extends AbstractController
{
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

    public function __construct(
        private readonly ManagerRegistry $doctrine)
    {}

    /**
     * OWNERS
     */

    #[Route('/owners', name: 'listowners', methods: ['GET'])]
    #[OA\Get(
        path: '/owners',
        summary: 'Returns details about multiple owners',
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
                description: 'Details about multiple owners',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/owners',
                ),
            ),
        ],
    )]
    public function getOwners(Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $ownerRepository = $this->doctrine->getRepository(Owner::class);
        $adapter = $ownerRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
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

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(OwnerVoter::VIEW, $item);
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
                self::OWNER_LIST_FIELDS
            )
        );
    }

    #[Route('/owners', name: 'addowner', methods: ['POST'])]
    #[OA\Post(
        path: '/owners',
        summary: 'Add new owner',
        requestBody: new OA\RequestBody(
            description: 'Details about new owner',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'lnumber',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created owner',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Owner',
                ),
            ),
        ],
    )]
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

        $this->denyAccessUnlessGranted(OwnerVoter::CREATE, $owner);

        $violations = $validator->validate($owner);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $ownerManager = $this->doctrine->getManager(Owner::class);
        $ownerManager->persist($owner);
        $ownerManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/owners/{ownerId}', name: 'changeowner', methods: ['PUT'])]
    #[OA\Put(
        path: '/owners/{ownerId}',
        description: 'Change owner',
        requestBody: new OA\RequestBody(
            description: 'Details for changing owner',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'lnumber',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'ownerId',
                description: 'The id of the owner',
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
                description: 'Details about changed owner',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Owner',
                ),
            ),
        ],
    )]
    public function changeOwner(string $ownerId, Request $request, ValidatorInterface $validator): Response
    {
        $changeOwner = json_decode($request->getContent(), true);

        $ownerRepository = $this->doctrine->getRepository(Owner::class);
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

        $this->denyAccessUnlessGranted(OwnerVoter::EDIT, $owner);

        $violations = $validator->validate($owner);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $ownerManager = $this->doctrine->getManager(Owner::class);
        $ownerManager->persist($owner);
        $ownerManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/owners/{ownerId}', name: 'deleteowner', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/owners/{ownerId}',
        description: 'Delete owner',
        parameters: [
            new OA\Parameter(
                name: 'ownerId',
                description: 'The id of the owner',
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
                description: 'Successfully deleted an owner',
            ),
        ],
    )]
    public function deleteOwner(string $ownerId): Response
    {
        $ownerRepository = $this->doctrine->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $ownerRepository->find((int) $ownerId);

        $this->denyAccessUnlessGranted(OwnerVoter::DELETE, $owner);

        $ownerManager = $this->doctrine->getManager(Owner::class);
        $ownerManager->remove($owner);
        try {
            $ownerManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/owners/{ownerId}', name: 'getowner', methods: ['GET'])]
    #[OA\Get(
        path: '/owners/{ownerId}',
        description: 'Returns details about an owner',
        parameters: [
            new OA\Parameter(
                name: 'ownerId',
                description: 'The id of the owner',
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
                description: 'Details about an owner',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Owner',
                ),
            ),
        ],
    )]
    public function getOwner(string $ownerId): Response
    {
        $ownerRepository = $this->doctrine->getRepository(Owner::class);
        $owner = $ownerRepository->find(
            (int)$ownerId
        );

        $this->denyAccessUnlessGranted(OwnerVoter::VIEW, $owner);

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

    /** CONTRACTORS */

    #[Route('/contractors', name: 'listcontractors', methods: ['GET'])]
    #[OA\Get(
        path: '/contractors',
        summary: 'Returns details about multiple contractors',
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
                description: 'Details about multiple contractors',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/contractors',
                ),
            ),
        ],
    )]
    public function getContractors(Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $contractorRepository = $this->doctrine->getRepository(Contractor::class);
        $adapter = $contractorRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
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

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(ContractorVoter::VIEW, $item);
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
                self::CONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/contractors', name: 'addcontractor', methods: ['POST'])]
    #[OA\Post(
        path: '/contractors',
        summary: 'Add new contractor',
        requestBody: new OA\RequestBody(
            description: 'Details about new contractor',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created contractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Contractor',
                ),
            ),
        ],
    )]
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

        $this->denyAccessUnlessGranted(ContractorVoter::CREATE, $contractor);

        $violations = $validator->validate($contractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $contractorManager = $this->doctrine->getManager(Contractor::class);
        $contractorManager->persist($contractor);
        $contractorManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/contractors/{contractorId}', name: 'changecontractor', methods: ['PUT'])]
    #[OA\Put(
        path: '/contractors/{contractorId}',
        description: 'Change contractor',
        requestBody: new OA\RequestBody(
            description: 'Details for changing contractor',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'contractorId',
                description: 'The id of the contractor',
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
                description: 'Details about changed contractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Contractor',
                ),
            ),
        ],
    )]
    public function changeContractor(string $contractorId, Request $request, ValidatorInterface $validator): Response
    {
        $changeContractor = json_decode($request->getContent(), true);

        $contractorRepository = $this->doctrine->getRepository(Contractor::class);
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

        $this->denyAccessUnlessGranted(ContractorVoter::EDIT, $contractor);

        $violations = $validator->validate($contractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $contractorManager = $this->doctrine->getManager(Contractor::class);
        $contractorManager->persist($contractor);
        $contractorManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/contractors/{contractorId}', name: 'deletecontractor', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/contractors/{contractorId}',
        description: 'Delete contractor',
        parameters: [
            new OA\Parameter(
                name: 'contractorId',
                description: 'The id of the contractor',
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
                description: 'Successfully deleted a contractor',
            ),
        ],
    )]
    public function deleteContractor(string $contractorId): Response
    {
        $contractorRepository = $this->doctrine->getRepository(Contractor::class);
        /** @var Contractor $contractor */
        $contractor = $contractorRepository->find((int) $contractorId);

        $this->denyAccessUnlessGranted(ContractorVoter::DELETE, $contractor);

        $contractorManager = $this->doctrine->getManager(Contractor::class);
        $contractorManager->remove($contractor);
        try {
            $contractorManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/contractors/{contractorId}', name: 'getcontractor', methods: ['GET'])]
    #[OA\Get(
        path: '/contractors/{contractorId}/contractors/{contractorId}',
        description: 'Returns details about an contractor',
        parameters: [
            new OA\Parameter(
                name: 'contractorId',
                description: 'The id of the contractor',
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
                description: 'Details about changed contractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Contractor',
                ),
            ),
        ],
    )]
    public function getContractor(string $contractorId): Response
    {
        $contractorRepository = $this->doctrine->getRepository(Contractor::class);
        $contractor = $contractorRepository->find(
            (int)$contractorId
        );

        $this->denyAccessUnlessGranted(ContractorVoter::VIEW, $contractor);

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    /** SUBCONTRACTORS */

    #[Route('/subcontractors', name: 'listsubcontractors', methods: ['GET'])]
    #[OA\Get(
        path: '/subcontractors',
        summary: 'Returns details about multiple subcontractors',
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
                description: 'Details about multiple subcontractors',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/subcontractors',
                ),
            ),
        ],
    )]
    public function getSubcontractors(Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $subcontractorRepository = $this->doctrine->getRepository(Subcontractor::class);
        $adapter = $subcontractorRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
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

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(SubcontractorVoter::VIEW, $item);
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
                self::SUBCONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/subcontractors', name: 'addsubcontractor', methods: ['POST'])]
    #[OA\Post(
        path: '/subcontractors',
        summary: 'Add new subcontractor',
        requestBody: new OA\RequestBody(
            description: 'Details about new subcontractor',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created subcontractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Subcontractor',
                ),
            ),
        ],
    )]
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

        $this->denyAccessUnlessGranted(SubcontractorVoter::CREATE, $subcontractor);

        $violations = $validator->validate($subcontractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $subcontractorManager = $this->doctrine->getManager(Subcontractor::class);
        $subcontractorManager->persist($subcontractor);
        $subcontractorManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'changesubcontractor', methods: ['PUT'])]
    #[OA\Put(
        path: '/subcontractors/{subcontractorId}',
        description: 'Change subcontractor',
        requestBody: new OA\RequestBody(
            description: 'Details for changing subcontractor',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'kvk',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'btw',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'website',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'subcontractorId',
                description: 'The id of the subcontractor',
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
                description: 'Details about created subcontractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Subcontractor',
                ),
            ),
        ],
    )]
    public function changeSubcontractor(string $subcontractorId, Request $request, ValidatorInterface $validator): Response
    {
        $changeSubcontractor = json_decode($request->getContent(), true);

        $subcontractorRepository = $this->doctrine->getRepository(Subcontractor::class);
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

        $this->denyAccessUnlessGranted(SubcontractorVoter::EDIT, $subcontractor);

        $violations = $validator->validate($subcontractor);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $subcontractorManager = $this->doctrine->getManager(Subcontractor::class);
        $subcontractorManager->persist($subcontractor);
        $subcontractorManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'deletesubcontractor', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/subcontractors/{subcontractorId}',
        description: 'Delete subcontractor',
        parameters: [
            new OA\Parameter(
                name: 'subcontractorId',
                description: 'The id of the subcontractor',
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
                description: 'Successfully deleted a subcontractor',
            ),
        ],
    )]
    public function deleteSubcontractor(string $subcontractorId): Response
    {
        $subcontractorRepository = $this->doctrine->getRepository(Subcontractor::class);
        /** @var Subcontractor $subcontractor */
        $subcontractor = $subcontractorRepository->find((int) $subcontractorId);

        $this->denyAccessUnlessGranted(SubcontractorVoter::DELETE, $subcontractor);

        $subcontractorManager = $this->doctrine->getManager(Subcontractor::class);
        $subcontractorManager->remove($subcontractor);
        try {
            $subcontractorManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/subcontractors/{subcontractorId}', name: 'getsubcontractor', methods: ['GET'])]
    #[OA\Get(
        path: '/subcontractors/{subcontractorId}',
        description: 'Returns details about a subcontractor',
        parameters: [
            new OA\Parameter(
                name: 'subcontractorId',
                description: 'The id of the subcontractor',
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
                description: 'Details about a subcontractor',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Subcontractor',
                ),
            ),
        ],
    )]
    public function getSubcontractor(string $subcontractorId): Response
    {
        $subcontractorRepository = $this->doctrine->getRepository(Subcontractor::class);
        $subcontractor = $subcontractorRepository->find(
            (int)$subcontractorId
        );

        $this->denyAccessUnlessGranted(SubcontractorVoter::VIEW, $subcontractor);

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    /**
     * USERS
     */

    #[Route('/users', name: 'listusers', methods: ['GET'])]
    #[OA\Get(
        path: '/users',
        summary: 'Returns details about multiple users',
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
                description: 'Details about multiple users',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/users',
                ),
            ),
        ],
    )]
    public function getUsers(Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $userRepository = $this->doctrine->getRepository(User::class);
        $adapter = $userRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
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

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(UserVoter::VIEW, $item);
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
                self::USER_LIST_FIELDS
            )
        );
    }

    #[Route('/users', name: 'adduser', methods: ['POST'])]
    #[OA\Post(
        path: '/users',
        summary: 'Add new user',
        requestBody: new OA\RequestBody(
            description: 'Details about new user',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'password',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'confirmpassword',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'adminrole',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Details about created user',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/User',
                ),
            ),
        ],
    )]
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

        $this->denyAccessUnlessGranted(UserVoter::CREATE, $user);

        $violations = $validator->validate($user);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $userManager = $this->doctrine->getManager(User::class);
        $userManager->persist($user);
        $userManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $user,
                self::USER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/users/{userId}', name: 'changeuser', methods: ['PUT'])]
    #[OA\Put(
        path: '/users/{userId}',
        description: 'Change user',
        requestBody: new OA\RequestBody(
            description: 'Details for changing user',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'email',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'password',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'confirmpassword',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'adminrole',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'userId',
                description: 'The id of the user',
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
                description: 'Details about created user',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/User',
                ),
            ),
        ],
    )]
    public function changeUser(string $userId, Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $hasher): Response
    {
        $changeUser = json_decode($request->getContent(), true);

        $userRepository = $this->doctrine->getRepository(User::class);
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

        $this->denyAccessUnlessGranted(UserVoter::EDIT, $user);

        $violations = $validator->validate($user);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $userManager = $this->doctrine->getManager(User::class);
        $userManager->persist($user);
        $userManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $user,
                self::USER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/users/{userId}', name: 'deleteuser', methods: ['DELETE'])]
    #[OA\Delete(
        path: '/users/{userId}',
        description: 'Delete user',
        parameters: [
            new OA\Parameter(
                name: 'userId',
                description: 'The id of the user',
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
                description: 'Successfully deleted an user',
            ),
        ],
    )]
    public function deleteUser(string $userId): Response
    {
        $userRepository = $this->doctrine->getRepository(User::class);
        /** @var User $user */
        $user = $userRepository->find((int) $userId);

        $this->denyAccessUnlessGranted(UserVoter::DELETE, $user);

        $userManager = $this->doctrine->getManager(User::class);
        $userManager->remove($user);
        try {
            $userManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', 200);
    }

    #[Route('/users/{userId}', name: 'getuser', methods: ['GET'])]
    #[OA\Get(
        path: '/users/{userId}',
        description: 'Returns details about an user',
        parameters: [
            new OA\Parameter(
                name: 'userId',
                description: 'The id of the user',
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
                description: 'Details about an user',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/User',
                ),
            ),
        ],
    )]
    public function getUserInfo(string $userId): Response
    {
        $userRepository = $this->doctrine->getRepository(User::class);
        $user = $userRepository->find(
            (int)$userId
        );

        $this->denyAccessUnlessGranted(UserVoter::VIEW, $user);

        return $this->json(
            ApiRenderEngine::renderData(
                $user,
                self::USER_DETAIL_FIELDS
            )
        );
    }
}
<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Entity\Authorization\Contractor;
use App\Entity\Authorization\Owner;
use App\Entity\Authorization\OwnerGroup;
use App\Entity\Authorization\Subcontractor;
use App\Helpers\ApiRenderEngine;
use App\Helpers\ErrorExtractor;
use App\Security\Voters\ContractorVoter;
use App\Security\Voters\OwnerGroupVoter;
use App\Security\Voters\OwnerVoter;
use App\Security\Voters\SubcontractorVoter;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
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
    private const array OWNER_LIST_FIELDS = [
        'id',
        'name',
        'lnumber',
    ];

    private const array OWNER_DETAIL_FIELDS = [
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

    private const array CONTRACTOR_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'website',
    ];

    private const array CONTRACTOR_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'kvk',
        'btw',
        'website',
    ];

    private const array SUBCONTRACTOR_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'website',
    ];

    private const array SUBCONTRACTOR_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'kvk',
        'btw',
        'website',
    ];

    public function __construct(
        private readonly ManagerRegistry $managerRegistry)
    {}

    /**
     * OWNERS
     */

    #[Route('/api/v1/owners', name: 'api-v1-listowners', methods: ['GET'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Owner::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
            $data = $paginator->paginate($data, (int)$page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::OWNER_LIST_FIELDS
            )
        );
    }

    #[Route('/api/v1/owners', name: 'api-v1-addowner', methods: ['POST'])]
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

        $constraintViolationList = $validator->validate($owner);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Owner::class);
        $objectManager->persist($owner);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/owners/{ownerId}', name: 'api-v1-changeowner', methods: ['PUT'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $objectRepository->find((int) $ownerId);

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

        $constraintViolationList = $validator->validate($owner);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Owner::class);
        $objectManager->persist($owner);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $owner,
                self::OWNER_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/owners/{ownerId}', name: 'api-v1-deleteowner', methods: ['DELETE'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Owner::class);
        /** @var Owner $owner */
        $owner = $objectRepository->find((int) $ownerId);

        $this->denyAccessUnlessGranted(OwnerVoter::DELETE, $owner);

        $objectManager = $this->managerRegistry->getManager(Owner::class);
        $objectManager->remove($owner);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    #[Route('/api/v1/owners/{ownerId}', name: 'api-v1-getowner', methods: ['GET'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Owner::class);
        $owner = $objectRepository->find(
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

    /** OWNER GROUPS */

    #[Route('/api/v1/ownergroups', name: 'api-v1-listownergroups', methods: ['GET'])]
    #[OA\Get(
        path: '/ownergroups',
        summary: 'Returns details about multiple owner groups',
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
                description: 'Details about multiple owner groups',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/ownergroups',
                ),
            ),
        ],
    )]
    public function getOwnerGroups(Request $request, PaginatorInterface $paginator): Response
    {
        $searchTerm = $request->query->get('searchterm');

        $objectRepository = $this->managerRegistry->getRepository(OwnerGroup::class);
        $adapter = $objectRepository->createQueryBuilder('o');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('o.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->eq('o.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }

        $adapter->orderBy('o.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(OwnerGroupVoter::VIEW, $item);
            } catch (AccessDeniedException) {
                unset($data[$index]);
            }
        }

        $page = $request->query->get('page');
        if ($page !== null) {
            $data = $paginator->paginate($data, (int)$page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::CONTRACTOR_LIST_FIELDS
            )
        );
    }

    /** CONTRACTORS */

    #[Route('/api/v1/contractors', name: 'api-v1-listcontractors', methods: ['GET'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Contractor::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
            $data = $paginator->paginate($data, (int)$page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::CONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/api/v1/contractors', name: 'api-v1-addcontractor', methods: ['POST'])]
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

        $constraintViolationList = $validator->validate($contractor);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Contractor::class);
        $objectManager->persist($contractor);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/contractors/{contractorId}', name: 'api-v1-changecontractor', methods: ['PUT'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Contractor::class);
        /** @var Contractor $contractor */
        $contractor = $objectRepository->find((int) $contractorId);

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

        $constraintViolationList = $validator->validate($contractor);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Contractor::class);
        $objectManager->persist($contractor);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $contractor,
                self::CONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/contractors/{contractorId}', name: 'api-v1-deletecontractor', methods: ['DELETE'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Contractor::class);
        /** @var Contractor $contractor */
        $contractor = $objectRepository->find((int) $contractorId);

        $this->denyAccessUnlessGranted(ContractorVoter::DELETE, $contractor);

        $objectManager = $this->managerRegistry->getManager(Contractor::class);
        $objectManager->remove($contractor);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    #[Route('/api/v1/contractors/{contractorId}', name: 'api-v1-getcontractor', methods: ['GET'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Contractor::class);
        $contractor = $objectRepository->find(
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

    #[Route('/api/v1/subcontractors', name: 'api-v1-listsubcontractors', methods: ['GET'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Subcontractor::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
            $data = $paginator->paginate($data, (int)$page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $data,
                self::SUBCONTRACTOR_LIST_FIELDS
            )
        );
    }

    #[Route('/api/v1/subcontractors', name: 'api-v1-addsubcontractor', methods: ['POST'])]
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

        $constraintViolationList = $validator->validate($subcontractor);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Subcontractor::class);
        $objectManager->persist($subcontractor);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/subcontractors/{subcontractorId}', name: 'api-v1-changesubcontractor', methods: ['PUT'])]
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

        $objectRepository = $this->managerRegistry->getRepository(Subcontractor::class);
        /** @var Subcontractor $subcontractor */
        $subcontractor = $objectRepository->find((int) $subcontractorId);

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

        $constraintViolationList = $validator->validate($subcontractor);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(Subcontractor::class);
        $objectManager->persist($subcontractor);
        $objectManager->flush();

        return $this->json(
            ApiRenderEngine::renderData(
                $subcontractor,
                self::SUBCONTRACTOR_DETAIL_FIELDS
            )
        );
    }

    #[Route('/api/v1/subcontractors/{subcontractorId}', name: 'api-v1-deletesubcontractor', methods: ['DELETE'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Subcontractor::class);
        /** @var Subcontractor $subcontractor */
        $subcontractor = $objectRepository->find((int) $subcontractorId);

        $this->denyAccessUnlessGranted(SubcontractorVoter::DELETE, $subcontractor);

        $objectManager = $this->managerRegistry->getManager(Subcontractor::class);
        $objectManager->remove($subcontractor);
        try {
            $objectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return new Response('', \Symfony\Component\HttpFoundation\Response::HTTP_OK);
    }

    #[Route('/api/v1/subcontractors/{subcontractorId}', name: 'api-v1-getsubcontractor', methods: ['GET'])]
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
        $objectRepository = $this->managerRegistry->getRepository(Subcontractor::class);
        $subcontractor = $objectRepository->find(
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
}

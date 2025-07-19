<?php

namespace App\Controller\Api\V1;

use App\Entity\Portfolio\Address;
use App\Entity\Portfolio\HousingStock;
use App\Entity\Strategies\Project;
use App\Helpers\ErrorExtractor;
use App\Security\Voters\ProjectVoter;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Helpers\ApiRenderEngine;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route('/api/v1', name: 'api-v1-')]
#[OA\Schema(
    schema: 'projects',
    title: 'Projects',
    description: 'An array of projects',
    properties: [
        new OA\Property(
            property: 'data',
            type: 'array',
            items: new OA\Items(
                ref: '#/components/schemas/Project',
            ),
        ),
    ],
    type: 'object',
)]
class StrategyController extends AbstractController
{
    private const array PROJECT_LIST_FIELDS = [
        'id',
        'code',
        'name',
        'numberOfAddresses'
    ];

    private const array PROJECT_DETAIL_FIELDS = [
        'id',
        'code',
        'name',
        'housingStock' => [
            'id',
            'code',
            'name',
        ],
        'numberOfAddresses',
        'preferredStartDate',
        'actualStartDate',
        'preferredEndDat',
        'actualEndDate',
        'contractors' => [
            'id',
            'code',
            'name',
        ],
        'subContractors' => [
            'id',
            'code',
            'name',
        ],
    ];

    public function __construct(
        private readonly ManagerRegistry $doctrine)
    {}

    #[Route('/housingstocks/{housingStockId}/projects', name: 'listprojects', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/projects',
        description: 'Returns details about multiple projects',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
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
                description: 'Details about multiple projects',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/projects',
                ),
            ),
        ],
    )]
    public function getProjects(string $housingStockId, Request $request, PaginatorInterface $paginator): Response
    {
        $housingStockRepository = $this->doctrine->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $projectRepository = $this->doctrine->getRepository(Project::class);
        $adapter = $projectRepository->createQueryBuilder('p');
        $adapter->andWhere($adapter->expr()->eq('p.housingStock', $adapter->expr()->literal($housingStock->getId())));

        $searchTerm = $request->query->get('searchterm');
        if (!empty($searchTerm)) {
            $adapter
                ->andWhere(
                    $adapter->expr()->orX(
                        $adapter->expr()->like('p.name', $adapter->expr()->literal('%' . $searchTerm . '%')),
                        $adapter->expr()->like('p.code', $adapter->expr()->literal($searchTerm . '%')),
                        $adapter->expr()->eq('p.id', $adapter->expr()->literal($searchTerm))
                    )
                );
        }

        $adapter->orderBy('p.name', 'ASC');

        $data = $adapter->getQuery()->getResult();

        foreach ($data as $index => $item) {
            try {
                $this->denyAccessUnlessGranted(ProjectVoter::VIEW, $item);
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
                self::PROJECT_LIST_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/projects', name: 'addproject', methods: ['POST'])]
    #[OA\Post(
        path: '/housingstocks/{housingStockId}/projects',
        summary: 'Add new project',
        requestBody: new OA\RequestBody(
            description: 'Details about new project',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'name',
                        type: 'string',
                    ),
                    new OA\Property(
                        property: 'code',
                        type: 'string',
                    ),
                ],
                type: 'object',
            ),
        ),
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housingstock',
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
                description: 'Details about created project',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Project',
                ),
            ),
        ],
    )]
    public function addProject(Request $request, ValidatorInterface $validator, string $housingStockId): Response
    {
        $newProject = json_decode($request->getContent(), true);

        $housingStockRepository = $this->doctrine->getRepository(HousingStock::class);
        /** @var HousingStock $housingStock */
        $housingStock = $housingStockRepository->find((int) $housingStockId);

        $project = new Project();
        if (!empty($housingStock)) {
            $project->setHousingStock($housingStock);
        }

        if (!empty($newProject['name'])) {
            $project->setName($newProject['name']);
        }

        if (!empty($newProject['code'])) {
            $project->setCode($newProject['code']);
        }

        if (!empty($newProject['preferredStartDate'])) {
            $project->setPreferredStartDate($newProject['preferredStartDate']);
        }

        if (!empty($newProject['preferredEndDate'])) {
            $project->setPreferredEndDate($newProject['preferredEndDate']);
        }

        if (!empty($newProject['addresses'])) {
            $addressRepository = $this->doctrine->getRepository(Address::class);

            foreach ($newProject['addresses'] as $newAddress) {
                $address = $addressRepository->find((int)$newAddress);
                $project->addAddress($address);
            }
        }

        $this->denyAccessUnlessGranted(ProjectVoter::CREATE, $project);

        $violations = $validator->validate($project);
        if ($violations->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($violations), 500);
        }

        $projectManager = $this->doctrine->getManager(Project::class);
        $projectManager->persist($project);
        try {
            $projectManager->flush();
        } catch (Exception $exception) {
            return $this->json(ErrorExtractor::fromException($exception), 500);
        }

        return $this->json(
            ApiRenderEngine::renderData(
                $project,
                self::PROJECT_DETAIL_FIELDS
            )
        );
    }

    #[Route('/housingstocks/{housingStockId}/projects/{projectId}', name: 'getproject', methods: ['GET'])]
    #[OA\Get(
        path: '/housingstocks/{housingStockId}/projects/{projectId}',
        description: 'Returns details about a project',
        parameters: [
            new OA\Parameter(
                name: 'housingStockId',
                description: 'The id of the housing stock',
                in: 'path',
                required: true,
                schema: new OA\Schema(
                    type: 'integer',
                    format: 'int64',
                ),
            ),
            new OA\Parameter(
                name: 'projectId',
                description: 'The id of the project',
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
                description: 'Details about an project',
                content: new OA\JsonContent(
                    ref: '#/components/schemas/Project',
                ),
            ),
        ],
    )]
    public function getProject(string $housingStockId, string $projectId): Response
    {
        $projectRepository = $this->doctrine->getRepository(Project::class);
        $project = $projectRepository->findOneBy(
            [
                'housingStock' => (int)$housingStockId,
                'id' => (int)$projectId
            ]
        );

        $this->denyAccessUnlessGranted(ProjectVoter::VIEW, $project);

        return $this->json(
            ApiRenderEngine::renderData(
                $project,
                self::PROJECT_DETAIL_FIELDS
            )
        );
    }
}
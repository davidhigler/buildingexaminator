<?php

declare(strict_types=1);

namespace App\Controller\Api\V1;

use App\Entity\Authentication\ContractorUser;
use App\Entity\Authentication\OwnerUser;
use App\Entity\Authentication\SubcontractorUser;
use App\Entity\Authentication\User;
use App\Helpers\ApiRenderEngine;
use App\Helpers\ErrorExtractor;
use App\Security\Voters\UserVoter;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use OpenApi\Attributes as OA;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use stdClass;
use Exception;

/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
#[Route('/api/v1', name: 'api-v1-')]
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
class AuthenticationController extends AbstractController
{
    private const array USER_LIST_FIELDS = [
        'id',
        'email',
        'admin',
        'type',
    ];

    private const array USER_DETAIL_FIELDS = [
        'id',
        'email',
        'admin',
        'type',
    ];

    public function __construct(
        private readonly ManagerRegistry $managerRegistry)
    {}

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

        $objectRepository = $this->managerRegistry->getRepository(User::class);
        $adapter = $objectRepository->createQueryBuilder('o');
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
            $data = $paginator->paginate($data, (int)$page, ApiRenderEngine::DEFAULT_PAGE_LIMIT);
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
    public function addUser(Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $userPasswordHasher): Response
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
            $user->setPassword($userPasswordHasher->hashPassword($user, $newUser['password']));
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

        $constraintViolationList = $validator->validate($user);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(User::class);
        $objectManager->persist($user);
        $objectManager->flush();

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
    public function changeUser(string $userId, Request $request, ValidatorInterface $validator, UserPasswordHasherInterface $userPasswordHasher): Response
    {
        $changeUser = json_decode($request->getContent(), true);

        $objectRepository = $this->managerRegistry->getRepository(User::class);
        /** @var User $user */
        $user = $objectRepository->find((int) $userId);

        if (!empty($changeUser['password'])) {
            if ($changeUser['password'] !== $changeUser['confirmpassword']) {
                $error = new stdClass();
                $error->code = 0;
                $error->message = 'Password and the confirm password are not the same';
                return $this->json([$error], 500);
            }

            $user->setRawPassword($changeUser['password']);
            $user->setPassword($userPasswordHasher->hashPassword($user, $changeUser['password']));
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

        $constraintViolationList = $validator->validate($user);
        if ($constraintViolationList->count() > 0) {
            return $this->json(ErrorExtractor::fromViolations($constraintViolationList), 500);
        }

        $objectManager = $this->managerRegistry->getManager(User::class);
        $objectManager->persist($user);
        $objectManager->flush();

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
        $objectRepository = $this->managerRegistry->getRepository(User::class);
        /** @var User $user */
        $user = $objectRepository->find((int) $userId);

        $this->denyAccessUnlessGranted(UserVoter::DELETE, $user);

        $objectManager = $this->managerRegistry->getManager(User::class);
        $objectManager->remove($user);
        try {
            $objectManager->flush();
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
        $objectRepository = $this->managerRegistry->getRepository(User::class);
        $user = $objectRepository->find(
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

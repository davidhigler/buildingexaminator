<?php

namespace App\Controller\Api\V1;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api/v1', name: 'api-v1-')]
class ApiController extends AbstractController
{
    /**
     * Returns the documentation for the V1 API documentation
     * @return Response
     */
    #[Route(
        '/documentation',
        name: 'documentation',
        methods: ['GET']
    )]
    public function Documentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }

    #[Route(
        '/projects',
        name: 'projects',
        methods: ['GET']
    )]
    public function getProjects(): Response
    {
        return new Response('Projects');
    }

    #[Route(
        '/projects/{projectId}',
        name: 'project',
        methods: ['GET']
    )]
    public function getProject(string $projectId): Response
    {
        return new Response('projectId: ' . $projectId);
    }

    #[Route(
        '/users',
        name: 'users',
        methods: ['GET']
    )]
    public function getUsers(Connection $connection): Response
    {
        $users = $connection->fetchAllAssociative('SELECT * FROM users;');
        return new Response(json_encode($users));
    }
}
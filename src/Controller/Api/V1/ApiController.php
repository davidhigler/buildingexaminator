<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    #[Route('/api/v1/documentation', name: 'api-v1-documentation', methods: ['GET'])]
    public function Documentation(): Response
    {
        return new Response('Documentation');
    }
}
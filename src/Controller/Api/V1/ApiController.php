<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    #[Route('/api/v1/documentation', name: 'documentation', methods: ['GET'])]
    public function Documentation(): Response
    {
        return new Response('Documentation');
    }
}
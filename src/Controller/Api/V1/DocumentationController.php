<?php

namespace App\Controller\Api\V1;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/v1', name: 'api-v1-')]
/**
 * @author David C. Higler <davidhigler@gmail.com>
 */
class DocumentationController extends AbstractController
{
    #[Route('/documentation', name: 'documentation', methods: ['GET'])]
    public function getDocumentation(): Response
    {
        return $this->render('api/v1/documentation/index.twig');
    }
}
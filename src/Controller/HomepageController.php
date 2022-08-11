<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends AbstractController
{
    #[Route('/home', name: 'homepage', methods: ['GET'])]
    public function Homepage(): Response
    {
        return $this->render('index.twig');
    }
}
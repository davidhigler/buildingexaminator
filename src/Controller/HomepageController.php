<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage', methods: ['GET'])]
    public function Homepage(RouterInterface $router): Response
    {
        $routes = [];
        foreach ($router->getRouteCollection()->all() as $routeObject) {
            if (str_starts_with($routeObject->getPath(), '/_') === false) {
                $routes[] = [
                    'methods' => join(', ', $routeObject->getMethods()),
                    'path' => $routeObject->getPath()
                ];
            }
        }
        return $this->render(
            'index.twig',
            [
                'routes' => $routes
            ]
        );
    }

}
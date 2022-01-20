<?php

namespace App\Controller;

use App\Entity\Portfolio\HousingStock;
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

    #[Route('/housingstock', name: 'housingstock_overview', methods: ['GET'])]
    public function HousingStockOverview(RouterInterface $router): Response
    {
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingstocks = $housingStockRepository->findAll();
        return $this->render(
            'api/v1/portfolio/housingstock/overview.twig',
            [
                'housingstocks' => $housingstocks
            ]
        );
    }

    #[Route('/housingstock/new', name: 'housingstock_new', methods: ['GET'])]
    public function HousingStockNew(RouterInterface $router): Response
    {
        return $this->render(
            'api/v1/portfolio/housingstock/new_edit.twig',
            []
        );
    }

    #[Route('/buildingaddress/new', name: 'buildingaddress_new', methods: ['GET'])]
    public function BuildingAddressNew(RouterInterface $router): Response
    {
        return $this->render(
            'api/v1/portfolio/buildingaddress/new_edit.twig',
            []
        );
    }
}
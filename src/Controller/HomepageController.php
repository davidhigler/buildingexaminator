<?php

namespace App\Controller;

use App\Entity\Portfolio\HousingStock;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;

class HomepageController extends AbstractController
{
    private array $controllerTwigVariables = [];

    public function __construct(RouterInterface $router) {
        $this->controllerTwigVariables['routes'] = [];
        foreach ($router->getRouteCollection()->all() as $routeName => $routeObject) {
            if (
                str_starts_with($routeObject->getPath(), '/_') === false
                && str_starts_with($routeObject->getPath(), '/api') === false
            ) {
                $this->controllerTwigVariables['routes'][$routeName] = [
                    'methods' => join(', ', $routeObject->getMethods()),
                    'title' => $routeObject->getOption('title'),
                    'path' => $routeObject->getPath(),
                ];
            }
        }
    }

    #[Route('/', name: 'homepage', options: ['title' => 'Home'], methods: ['GET'])]
    public function Homepage(Request $request): Response
    {
        $this->addTitleToControllerTwigVariables($request);
        return $this->render(
            'index.twig',
            $this->controllerTwigVariables,
        );
    }

    #[Route('/housingstock', name: 'housingstock_overview', options: ['title' => 'Housingstocks'], methods: ['GET'])]
    public function HousingStockOverview(Request $request): Response
    {
        $this->addTitleToControllerTwigVariables($request);
        $housingStockRepository = $this->getDoctrine()->getRepository(HousingStock::class);
        $housingstocks = $housingStockRepository->findAll();
        return $this->render(
            'api/v1/portfolio/housingstock/overview.twig',
            array_merge(
                $this->controllerTwigVariables,
                [
                    'housingstocks' => $housingstocks,
                ]
            ),
        );
    }

    #[Route('/housingstock/new', name: 'housingstock_new', options: ['title' => 'New housingstock'], methods: ['GET'])]
    public function HousingStockNew(Request $request): Response
    {
        $this->addTitleToControllerTwigVariables($request);

        $housingstock = new HousingStock();
        $housingstock->setCreationTime();
        $housingstock->setLastChangeTime();

        $form = $this->createFormBuilder($housingstock)
            ->add('code', TextType::class, ['label' => 'Code', 'attr' => ['placeholder' => '123456']])
            ->add('name', TextType::class, ['label' => 'Name', 'attr' => ['placeholder' => 'Main stock']])
            ->add('description', TextareaType::class, ['label' => 'Description', 'attr' => ['placeholder' => 'This is the main stock of buildings we own']])
            ->add('save', SubmitType::class, ['label' => 'Save'])
            ->getForm();

        return $this->render(
            'api/v1/portfolio/housingstock/new_edit.twig',
            array_merge(
                $this->controllerTwigVariables,
                [
                    'form' => $form->createView(),
                ]
            ),
        );
    }

    #[Route('/buildingaddress/new', name: 'buildingaddress_new', options: ['title' => 'New buildingaddress'], methods: ['GET'])]
    public function BuildingAddressNew(Request $request): Response
    {
        $this->addTitleToControllerTwigVariables($request);
        return $this->render(
            'api/v1/portfolio/buildingaddress/new_edit.twig',
            array_merge(
                $this->controllerTwigVariables,
                [
                ]
            ),
        );
    }

    private function addTitleToControllerTwigVariables(Request $request)
    {
        $routeName = $request->attributes->get('_route');
        $this->controllerTwigVariables['title'] = $this->controllerTwigVariables['routes'][$routeName]['title'];
    }
}
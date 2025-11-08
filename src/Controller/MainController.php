<?php

namespace App\Controller;

use App\Repository\OrdersRepository;
use App\Repository\PeopleRepository;
use App\Repository\DishesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(
        OrdersRepository $ordersRepo,
        PeopleRepository $peopleRepo,
        DishesRepository $dishesRepo
    ): Response {
        return $this->render('main/index.html.twig', [
            'total_orders' => $ordersRepo->count([]),
            'total_customers' => $peopleRepo->count([]),
            'total_dishes' => $dishesRepo->count([]),
            'recent_orders' => $ordersRepo->findBy([], ['id' => 'DESC'], 5),
        ]);
    }
}
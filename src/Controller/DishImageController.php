<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class DishImageController extends AbstractController
{
    #[Route('/dish/image', name: 'app_dish_image')]
    public function index(): Response
    {
        return $this->render('dish_image/index.html.twig', [
            'controller_name' => 'DishImageController',
        ]);
    }
}

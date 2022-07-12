<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FridgeController extends AbstractController
{
    #[Route('/mon-frigo', name: 'app_fridge')]
    public function index(): Response
    {
        return $this->render('fridge/index.html.twig', [
            'controller_name' => 'FridgeController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FillTheFridgeController extends AbstractController
{
    #[Route('/remplissage-frigo', name: 'app_fill_the_fridge')]
    public function index(): Response
    {
        return $this->render('fill_the_fridge/index.html.twig', [
            'controller_name' => 'FillTheFridgeController',
        ]);
    }
}

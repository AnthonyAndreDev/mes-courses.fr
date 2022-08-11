<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductsType;
use App\Repository\FridgeRepository;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FridgeController extends AbstractController
{


    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }



    #[Route('/mon-frigo', name: 'app_fridge')]
    public function index(Request $request, FridgeRepository $fridgeRepository, ProductsRepository $products): Response
    {

        $product = new Products();
        $product->setExpirationDate(new \DateTime('now'));
        $form = $this->createForm(ProductsType::class, $product);
        $form->handleRequest($request);
        // Obtenir l'utilisateur courant : 
        $user = $this->getUser();
        // Accéder au frigo de l'utilisateur courant : 
        $fridge = $fridgeRepository->findOneByUser($user);

        if ($form->isSubmitted() && $form->isValid()) {

            // $product = $form->getData(); 
            // $this->entityManager->persist($product); 
            // $this->entityManager->flush();
            $product = $form->getData();
            $fridge->addProduct($product);
            $this->entityManager->persist($product);
            $this->entityManager->persist($fridge);
            $this->entityManager->flush();
        }

        // dump($fridgeRepository->findOneByUser($user));

        // dump($products->findAll()); 


        // Obtenir la liste des produits du frigo de l'utilisateur connecté : 
        dump($fridge->getProducts()->getValues());
        $listOfProducts = $fridge->getProducts()->getValues();


        return $this->render('fridge/index.html.twig', [
            'controller_name' => 'FridgeController',
            'form' => $form->createView(),
            'listOfProducts' => $listOfProducts
        ]);
    }
}

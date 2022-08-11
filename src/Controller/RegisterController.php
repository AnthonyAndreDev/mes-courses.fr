<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Fridge;
use App\Form\UserType;
use App\Form\FridgeType;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/creation-de-compte', name: 'app_register')]

    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $notification = null;
        $user = new User();
        $fridge = new Fridge(); 

        $form = $this->createForm(RegisterType::class, $user);
        $fridgeForm = $this->createForm(FridgeType::class, $fridge);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $form->getData();

            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if (!$search_email) {

                $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
                $user->setPassword($hashedPassword);
                
                // $doctrine = $this->doctrine->getManager(); 
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                $ID = $user->getID(); 

                $fridge->setUser($user);
                $this->entityManager->persist($fridge); 
                $this->entityManager->flush();


                // $mail= new Mail(); 
                // $content="Bonjour ".$user->getFirstName().",<br><br>Bienvenue sur la première boutique française de boites de jeux vidéos"; 
                // $mail->send($user->getEmail(), $user->getFirstName(), "Bienvenue sur MyGameBox", $content); 

                $notification = "Votre inscription s'est correctement déroulée. Vous pouvez dès à présent vous connecter à votre compte.";
            } else {

                $notification = "L'email renseigné est d'ores et déjà associé à un compte.";
            }
        }

        


        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}

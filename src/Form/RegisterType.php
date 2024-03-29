<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'label' => 'Votre Prénom',
            'constraints' => new Length(min:2, max:30),
            'attr' => [
                'placeholder' => "Saisissez ici votre prénom"
            ]
        ])
        ->add('lastname', TextType::class, [
            'label' => 'Votre Nom',
            'attr' => [
                'placeholder' => "Saisissez ici votre nom"
            ]
        ])
        ->add('email', EmailType::class,[
            'label' => 'Votre Email',
            'attr' => [
                'placeholder' => "Saisissez ici votre adresse email"
            ]
        ])
        ->add('password', RepeatedType::class,[
            'type' => PasswordType::class,
            'invalid_message' => 'Le mot de passe et la confirmation doivent être identiques', 
            'label' => 'Votre Mot De Passe',
            'required' => true, 
            'first_options' => [ 'label' => 'Mot de passe',
            'attr' => [
                'placeholder' => 'Merci de saisir votre mot de passe'
            ]
        ], 
            'second_options' => [ 'label' => 'Confirmez votre mot de passe',
            'attr' => [
                'placeholder' => 'Merci de confirmer votre mot de passe'
            ]
        ],
            'attr' => [
                'placeholder' => "Saisissez ici votre mot de passe"
            ]
        ])
        ->add('submit', SubmitType::class,[
            'label' => 'Inscription'
        ])
    ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProductsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('name', TextType::class, [
            //     'label' => 'Nom du produit',
            //     'constraints' => new Length(min:2, max:30),
            //     'attr' => [
            //         'placeholder' => ""
            //     ]
            // ])
            ->add('name', EntityType::class, [
                'class' => products::class,
                'choice_label' => 'name',
                'choice_value' => 'name',
                'label' => 'Nom du produit'
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantité',
                'attr' => [
                    'placeholder' => ""
                ]
            ])
            ->add('expirationDate', DateType::class, [
                'label' => 'Date de péremption:',
                'attr' => []
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajout'
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Nft;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email adresse',
                'attr' => [
                    'class' => 'form-control mb-3', 
                ],
            ])

            ->add('password', PasswordType::class, [
                'label' => 'Mot de passe',
                'attr' => [
                    'class' => 'form-control mb-3', 
                ],
            ])

            ->add('ismale', ChoiceType::class, [
                'mapped' => true,
                'choices' => [
                    'Male' => 'm',
                    'Female' => 0,
                ],
                'expanded' => false,
                'multiple' => false,
                'label' => 'Genre',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez choisir',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-control mb-3', 
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => "Prénom",
            ])
            ->add('lastname', TextType::class, [
                'label' => "Nom de famille",
            ])
            ->add('datebirth', DateType::class, [
                'years' => range(1930, date('Y')),
                'label' => 'Date de naissance',
            ])
            ->add('adnum', IntegerType::class, [
                'label' => "Numéro de la rue",
            ])
            ->add('adstreet', TextType::class, [
                'label' => "Rue d'adresse",
            ])
            ->add('adcity', TextType::class, [
                'label' => "Ville",
            ])
            ->add('adpostalcode', TextType::class, [
                'label' => "Code posatale",
            ])
            ->add('nfts', EntityType::class, [
                'class' => Nft::class,
                'multiple' => true,
                'choice_label' => 'name_nft',
                'label' => 'NFTs',
                'attr' => [
                    'class' => 'form-control mb-3', 
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'highestRole' => [],
        ]);
    }
}

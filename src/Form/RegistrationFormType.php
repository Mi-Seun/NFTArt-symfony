<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ismale', ChoiceType::class, [
                'mapped' => true,
                'choices' => [
                    'Male' => 'm',
                    'Female' => 0,
                ],
                'expanded' => false, // Pour afficher sous forme de boutons radio
                'multiple' => false, // Pour permettre une seule sélection
                'constraints' => [
                    new NotBlank([
                        'message' => 'You should choose',
                    ]),
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
            ->add('email', EmailType::class, [
                'label' => 'Email adresse',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}

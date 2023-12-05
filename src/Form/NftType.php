<?php

namespace App\Form;

use App\Entity\Nft;
use App\Entity\Subcategory;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class NftType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_nft', TextType::class, [
                'label' => 'Nom de NFT',
                'attr' => ['class' => 'form-control mb-3'] 
            ])
            ->add('priceeth', MoneyType::class, [
                'currency' => 'ETH',
                'attr' => ['class' => 'form-control mb-3'] 
            ])
            ->add("file", FileType::class, [
                "mapped" => false,
                "required" => true,
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                    ]),
                ],
                'attr' => ['class' => 'form-control-file mb-3'] 
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => ['class' => 'form-control mb-3'] 
            ])
            ->add('subcategories', EntityType::class, [
                "class" => Subcategory::class,
                "multiple" => true,
                'choice_label' => 'name_sc',
                'label' => 'Nom de sous-catégorie',
                'attr' => ['class' => 'form-control mb-3'] 
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'choice_label' => 'email',
                'label' => 'Nom de User',
                'attr' => ['class' => 'form-control mb-3'] 
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Nft::class,
        ]);
    }
}

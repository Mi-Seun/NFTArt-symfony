<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Nft;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_sc', null, [
                'label' => 'Subcategory Name',
                'attr' => [
                    'class' => 'form-control mb-3', 
                ],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'multiple' => false,
                'choice_label' => 'name_cat',
                'label' => 'Category',
                'attr' => [
                    'class' => 'form-control mb-3',
                ],
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
            'data_class' => Subcategory::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
       
       // ->add('libelle')
        ->add('libelle', TextType::class, [
            'label' => 'La nature de la communauté',
            "required" => true,
            'attr' => ['placeholder' => 'Saisir la nature de la communaute']
        ])
        //->add('CreatedAt')
        // ->add('UpdatedAt')
        // ->add('utilisateur')
    ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}

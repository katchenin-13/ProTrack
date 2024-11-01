<?php

namespace App\Form;

use App\Entity\Localite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LocaliteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
           // ->add('libelle')
            ->add('libelle', TextType::class, [
                'label' => 'Le nom de la localité',
                "required" => true,
                'attr' => ['placeholder' => 'Saisir le nom de la localité']
            ])
            // ->add('UpdatedAt')
            // ->add('CreatedAt')
            // ->add('Utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Localite::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Communaute;
use App\Entity\Don;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class DonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            //->add('dateremise')
            //->add('remispar')
            // ->add('statusdon')
            // ->add('UpdatedAt')
            // ->add('CreatedAt')
            // ->add('utilisateur')
            // ->add('communaute')
            // ->add('nom')
            // ->add('numero')
            // ->add('email')
            ->add('communaute', EntityType::class, [
                'placeholder' => '---',
                'choice_label' => 'libelle',
                'label' => 'La Communaute',
                'attr' => ['class' => 'has-select2'],
                'choice_attr' => function (Communaute $communaute) {
                    return ['data-value' => $communaute->getLibelle()];
                },
                'class' => Communaute::class,
                'required' => false

            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de récipiendaire',
                 "required" => true,
                'attr' => ['placeholder' => 'Saisir le nom du récipiendaire']
            ])
            ->add('numero', TextType::class, [
                'label' => 'Numéro de téléphone',
                "required" => true,
                'attr' => ['placeholder' => ' Saisir un numéro de téléphone'],
                'constraints' => [new Regex([
                    'pattern' => '/[0-9]{14,16}/',
                    'match' => true,
                    'message' => 'Le numero de téléphone contient seulement des chiffre de 0-9',
                ])]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                 'required'=>false,
                'attr' => ['placeholder' => 'Saisir une adresse mail
            ']
            ])
            ->add('dateremise', DateType::class, [
                "label" => "Date de remise",
                "required" => true,
                "widget" => 'single_text',
                "input_format" => 'Y-m-d',
                "by_reference" => true,
                "empty_data" => '',
                'attr' => ['class' => 'date']
            ])
            // ->add('remispar')
            ->add('remispar', TextType::class, [
                'label' => 'Remis par',
                'attr' => ['placeholder' => 'Saisir le nom de la personne ayant remis le don']
            ])

            ->add('fieldon', CollectionType::class, [
                'entry_type' => FieldonType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'allow_add' => true,
                'label' => false,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
            ]);
           
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Don::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Promesse;
use App\Entity\Communaute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PromesseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
           
            ->add('communaute', EntityType::class, [
                'class'        => Communaute::class,
                'label'        => 'Communaute',
                'choice_label' => 'libelle',
                'multiple'     => false,
                'expanded'     => false,
                'placeholder' => 'Choisir une localité',
                'attr' => ['class' => 'has-select2'],

            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom de récipiendaire',
                'attr' => ['placeholder' => 'Saisir le nom du récipiendaire']
            ])
            ->add('numero', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => ['placeholder' => ' Saisir un numéro de téléphone'],
                'constraints' => [new Regex([
                    'pattern' => '/[0-9]{14,16}/',
                    'match' => true,
                    'message' => 'Le numero de téléphone contient seulement des chiffre de 0-9',
                ])]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                "required" => false,
                'attr' => ['placeholder' => 'Saisir une adresse mail
            ']
            ])

            ->add('dateremise', DateType::class, [
                "label" => "Date à laquelle la promesse sera réalisée ",
                "required" => true,
                "widget" => 'single_text',
                "input_format" => 'Y-m-d',
                "by_reference" => true,
                "empty_data" => '',
                'attr' => ['class' => 'date']
            ])

            ->add('fielpromesses', CollectionType::class, [
                'entry_type' => FielpromesseType::class,
                'entry_options' => [
                    'label' => false,
                   "required" => false,
                ],
                'allow_add' => true,
                'label' => false,
                'by_reference' => false,
                'allow_delete' => true,
                'prototype' => true,
            ])
 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Promesse::class,
        ]);
    }
}

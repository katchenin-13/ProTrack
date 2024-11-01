<?php

namespace App\Form;

use App\Entity\Communaute;
use App\Entity\Demande;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class DemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $etat = $options["etat"];
        $builder
        ->add('motif', TextareaType::class, [
            'label' => 'Motif de la demande d’audience',
            'attr' => ['placeholder' => 'Motif de la demande d’audience']
        ])
        ->add('daterencontre', DateType::class, [
                "label" => "Date de rencontre souhaitée*",
                "required" => true,
                "widget" => 'single_text',
                "input_format" => 'Y-m-d',
                "by_reference" => true,
                "empty_data" => '',
                'attr' => [
                    'class' => 'date',
                    'placeholder' => 'Date de rencontre souhaitée'
                ]
            ])

            ->add('communaute', EntityType::class, [
                'class'        => Communaute::class,
                'label'        => 'Communaute',
                'choice_label' => 'libelle',
                'multiple'     => false,
                'expanded'     => false,
                'required'=>false,
                'placeholder' => 'Sélectionner une communauté',
                'attr' => ['class' => 'has-select2'],

            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom et Prénom(s) du dmandeur',
                "required" => true,
                'attr' => ['placeholder' => 'Nom et Prénom(s) du dmandeur']
            ])
           
            ->add('numero', TextType::class, [
                'label' => 'Nnuméro de téléphone',
                "required" => true,
                'attr' => ['placeholder' => ' Saisir un numéro de téléphone'],
                'constraints' => [new Regex([
                'pattern' => '/[0-9]{14,16}/',
                'match' => true,
                'message' => 'Le numero de téléphone contient seulement des chiffre de 0-9',
            ])]
            ])
            ->add('lieu_habitation', TextType::class, [
                'label' => 'Village/Ville',
                 "required" => true,
                'attr' => ['placeholder' => ' Saisir le nom de la ville ou du village']
            ]);
        if ($etat == 'create') {
            $builder->add('justification', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ]);
        }



        if ($etat == 'demande_rejeter'
        ) {
            $builder->add('justification', TextareaType::class, [
                'label' => 'La raison du rejet du rapport',
                'attr' => ['readonly' => true]
            ])
                ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible ']])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']]);
        }


        if ($etat == 'demande_valider'
        ) {
            $builder->add('justification', TextareaType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']])
                ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']]);
        }



        if ($etat == 'demande_initie'
        ) {
            $builder->add('justification', HiddenType::class, [
                'label' => 'la cause du rejete ',
                "required" => false,
                'attr' => ['readonly' => false]
            ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']]);
            //    ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter ']]);
        }

         
           
           
           
            // ->add('CreatedAt')
            // ->add('UpdatedAt')
            // ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Demande::class,
        ]);

        $resolver->setRequired('etat');
    }
}

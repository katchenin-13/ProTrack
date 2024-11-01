<?php

namespace App\Form;


use App\Entity\Audience;
use App\Entity\Communaute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\Regex;

class AudienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $etat = $options['etat'];
         
        $builder
            ->add('motif', TextType::class, [
                'label' => 'Motif de la demande d’audience',
                'attr' => ['placeholder' => 'Motif de la demande d’audience']
            ])
            ->add('daterencontre', DateType::class, [
                "label" => "Date de rencontre souhaitée",
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
                //'autocomplete' => true,
                'placeholder' => 'Sélectionner une communauté                ',
                'attr' => [
                    'class' => 'has-select2',
                    'autocomplete' => true,
                ],

            ])
            ->add('nomchef', TextType::class, [
                'label' => 'Nom du chef de délégation',
                'attr' => ['placeholder' => 'Nom du chef de délégation']
            ])
            ->add('numero', TextType::class, [
                'label' => 'Nnuméro de téléphone',
                'attr' => ['placeholder' => '+2250154865252'],
                'constraints' => [new Regex([
                'pattern' => '/[0-9]{14,16}/',
                'match' => true,
                'message' => 'Le numero de téléphone contient seulement des chiffre de 0-9',
            ])]
               
            ])
            
  
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
                'attr' => ['placeholder' => 'Saisir une adresse mail
                ']
            ])
            ->add('nombreparticipant', NumberType::class, [
                'label' => 'Nombre de participants',
                'attr' => ['placeholder' => ' Saisir le nombre de participants']
            ]);

        if ($etat == 'create') {
            $builder->add('justification', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ]);
        }   
        


        if ($etat == 'audience_rejeter') {
            $builder->add('justification', TextareaType::class, [
                'label' => 'La raison du rejet du rapport',
                'attr' => ['readonly' => true]
            ])
             ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible ']])
            ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']]);
        }


        if ($etat == 'audience_valider') {
            $builder->add('justification', TextareaType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
            ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']])
               ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']]);
        }



        if ($etat == 'audience_initie') {
            $builder->add('justification', HiddenType::class, [
                'label' => 'la cause du rejet du rapport',
                "required" => false,
                'attr' => ['readonly' => false]
            ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']]);
               // ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter ']]);
        }


        $builder->add('observation', TextareaType::class, [
                'label' => 'Observation',
                'required' => false
            ])
          


            // ->add('UpdatedAt')
            // ->add('CreatedAt')
            // ->add('communaute')
            // ->add('utilisateur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Audience::class,
        ]);
      //  $resolver->setRequired('type');
        $resolver->setRequired('etat');
    }
}

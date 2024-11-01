<?php

namespace App\Form;

use Mpdf\Http\Uri;
use App\Entity\Employe;
use App\Entity\Communaute;
use App\Entity\Utilisateur;
use Lcobucci\JWT\Signer\None;
use App\Entity\Missionrapport;
use Masterminds\HTML5\Entities;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Url;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MissionrapportType extends AbstractType
{

     public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $type = $options["type"];
        $etat =$options["etat"];

     //  dd($etat);

            if ($type == "create") {
             $builder->add('communaute', EntityType::class, [
                    'placeholder' => '---',
                    'choice_label' => 'libelle',
                    'label' => 'Communaute',
                    'class' => Communaute::class,
                    'multiple'     => false,
                    'expanded'     => false,
                    'required' => false,
                    'attr' => ['class' => 'has-select2', 'readonly' => false],
                ])
                ->add('titre_mission', TextType::class, [
                    'label' => 'Titre de la mission',
                    'attr' => ['readonly' => false]
                ])


                ->add('objectifs', TextareaType::class,[
                    'label' => 'Objectif (s) de la mission',
                    'attr' => ['readonly' => false]
                    ])
             
                ->add('employe', EntityType::class, [
                        'class' => Employe::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.id', 'DESC');
                        },
                        'choice_label' => function ($employe) {
                            return $employe->getNom() . ' ' . $employe->getPrenom();
                        },
                        'label' => 'Chef mission',
                        'attr' => ['class' => 'has-select2', 'readonly' => false]
                    ])
                ->add('nombrepersonne', TextType::class, [
                    'label' => 'Nombre de personne',
                    'attr' => ['readonly' => false],
                    'constraints' => [new Regex([
                        'pattern' => '/[0-9]/',
                        'match' => true,
                        'message' => 'Le nombre de personne contient seulement des chiffre de 0-9',
                    ])]
                ])
                ->add('action', TextareaType::class, [
                    'label' => 'Action(s) de la mission',
                    'attr' => ['readonly' => false]
                    ])
           
               ->add('opportunite', HiddenType::class, [
                      'label' => ' ',
                        "required" => false,
                        'attr' => ['readonly' => true, 'hidden'=> true]
                        ])
                ->add('difficulte', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
                    ])
              
                ->add('difficulte', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]
                        
                ]);
            if ($etat == 'create') {
                $builder->add('justification', HiddenType::class, [
                    'label' => ' ',
                    "required" => false,
                    'attr' => ['readonly' => true, 'hidden' => true]
                ]);
            }
            $builder->add('prochaineetat', HiddenType::class, [
                'label' => ' ',
                "required" => false,
                'attr' => ['readonly' => true, 'hidden' => true]

                    ]);
         }
        if ($type == "worklflow") {

            
            if ($etat == 'missionrapport_rejeter') {
                $builder->add('communaute', EntityType::class, [
                    'placeholder' => '---',
                    'choice_label' => 'libelle',
                    'label' => 'Communaute',
                    'class' => Communaute::class,
                    'multiple'     => false,
                    'expanded'     => false,
                    'required' => false,
                    'attr' => ['class' => 'has-select2', 'readonly' =>true],
                  ])
                   ->add('titre_mission', TextType::class, [
                        'label' => 'Titre de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('objectifs', TextareaType::class, [
                        'label' => 'Objectif (s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('employe', EntityType::class, [
                        'class' => Employe::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.id', 'DESC');
                        },
                        'choice_label' => function ($employe) {
                            return $employe->getNom() . ' ' . $employe->getPrenom();
                        },
                        'label' => 'Chef mission',
                        'attr' => ['class' => 'has-select2', 'readonly' => true]
                    ])
                    ->add('nombrepersonne', TextType::class, [
                        'label' => 'Nombre de personne',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('action', TextareaType::class, [
                        'label' => 'Action(s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('opportunite', TextareaType::class, [
                        'attr' => ['readonly' => false]
                    ])
                    ->add('difficulte', TextareaType::class, [
                        'attr' => ['readonly' => false]
                    ])
                    ->add('prochaineetat', TextType::class, [
                        'label' => 'Saisir la prochaine étape',
                        'attr' => ['readonly' => false]

                    ])

                    ->add('justification', TextareaType::class, [
                            'label' => 'La raison du rejet du rapport',
                            'attr' => ['readonly' => true, 'class' => 'text-danger']
                        ])
                        ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible ']])
                        ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider']]);
                    }

            if ($etat == 'missionrapport_valider') {
                $builder->add('communaute', EntityType::class, [
                    'placeholder' => '---',
                    'choice_label' => 'libelle',
                    'label' => 'Communaute',
                    'class' => Communaute::class,
                    'multiple'     => false,
                    'expanded'     => false,
                    'required' => false,
                    'attr' => ['class' => 'has-select2', 'readonly' => true],
                    ])
                    ->add('titre_mission', TextType::class, [
                        'label' => 'Titre de la mission',
                        'attr' => ['readonly' => true]
                    ])


                    ->add('objectifs', TextareaType::class, [
                        'label' => 'Objectif (s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('employe', EntityType::class, [
                        'class' => Employe::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.id', 'DESC');
                        },
                        'choice_label' => function ($employe) {
                            return $employe->getNom() . ' ' . $employe->getPrenom();
                        },
                        'label' => 'Chef mission',
                        'attr' => ['class' => 'has-select2', 'readonly' => true]
                    ])
                    ->add('nombrepersonne', TextType::class, [
                        'label' => 'Nombre de personne',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('action', TextareaType::class, [
                        'label' => 'Action(s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('opportunite', TextareaType::class, [
                        'attr' => ['readonly' => true]
                    ])
                    ->add('difficulte', TextareaType::class, [
                        'attr' => ['readonly' => true]
                    ])
                   ->add('prochaineetat', TextType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => true]

                   ])

                  ->add('justification', TextareaType::class, [
                        'label' => ' ',
                        "required" => false,
                        'attr' => ['readonly' => true, 'hidden'=> true]
                        ])
                    ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible ']])
                    ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => [ 'class' => 'btn btn-main btn-ajax rejeter invisible']]);
                }

            if ($etat == 'missionrapport_initie') {
                $builder->add('communaute', EntityType::class, [
                    'placeholder' => '---',
                    'choice_label' => 'libelle',
                    'label' => 'Communaute',
                    'class' => Communaute::class,
                    'multiple'     => false,
                    'expanded'     => false,
                    'required' => false,
                    'attr' => ['class' => 'has-select2', 'readonly' => true],
                ])
                    ->add('titre_mission', TextType::class, [
                        'label' => 'Titre de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('objectifs', TextareaType::class, [
                        'label' => 'Objectif (s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('employe', EntityType::class, [
                        'class' => Employe::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.id', 'DESC');
                        },
                        'choice_label' => function ($employe) {
                            return $employe->getNom() . ' ' . $employe->getPrenom();
                        },
                        'label' => 'Chef mission',
                        'attr' => ['class' => 'has-select2', 'readonly' => true]
                    ])
                    ->add('nombrepersonne', TextType::class, [
                        'label' => 'Nombre de personne',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('action', TextareaType::class, [
                        'label' => 'Action(s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('opportunite', TextareaType::class, [
                        'attr' => ['readonly' => false]
                    ])
                    ->add('difficulte', TextareaType::class, [
                        'attr' => ['readonly' => false]
                    ])
                    ->add('prochaineetat', TextType::class, [
                        'label' => 'Saisir la prochaine étape',
                        'attr' => ['readonly' => false]

                    ])

                    ->add('justification', TextareaType::class, [
                        'label' => 'La raison du rejet du rapport',
                        'attr' => ['readonly' => true, 'class' => 'text-danger']
                    ])
                    ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible ']])
                    ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider']]);
            }


            if ($etat == 'missionrapport_attend') {


            
                $builder->add('communaute', EntityType::class, [
                    'placeholder' => '---',
                    'choice_label' => 'libelle',
                    'label' => 'Communaute',
                    'class' => Communaute::class,
                    'multiple'     => false,
                    'expanded'     => false,
                    'required' => false,
                    'attr' => ['class' => 'has-select2', 'readonly' => true],
                    ])
                    ->add('titre_mission', TextType::class, [
                        'label' => 'Titre de la mission',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('objectifs', TextareaType::class, [
                        'label' => 'Objectif (s) de la mission',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('employe', EntityType::class, [
                        'class' => Employe::class,
                        'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orderBy('u.id', 'DESC');
                        },
                        'choice_label' => function ($employe) {
                            return $employe->getNom() . ' ' . $employe->getPrenom();
                        },
                        'label' => 'Chef mission',
                        'attr' => ['class' => 'has-select2', 'readonly' => true]
                    ])
                    ->add('nombrepersonne', TextType::class, [
                        'label' => 'Nombre de personne',
                        'attr' => ['readonly' => true]
                    ])
                    ->add('action', TextareaType::class, [
                        'label' => 'Action(s) de la mission',
                        'attr' => ['readonly' => true]
                    ])

                    ->add('opportunite', TextareaType::class, [
                        'attr' => ['readonly' => true]
                    ])
                    ->add('difficulte', TextareaType::class, [
                        'attr' => ['readonly' => true]
                    ])

                    ->add('prochaineetat', TextType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => true]

                    ])

                  ->add('justification', HiddenType::class, [
                    'label' => 'Justifaction',
                    'attr' => ['readonly' => false]
                    ])


                    ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']])
                    ->add('rejeter', SubmitType::class, ['label' => "Rejeter", 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']]);
                  
                           
            }    
        }

       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missionrapport::class,
            'default_protocol' => 'app_gestion_mission_rapport_justification',
        ]);
        $resolver->setRequired('type');
        $resolver->setRequired('etat');

    }


  
}

<?php

namespace App\Form;

use App\Entity\Employe;
use App\Entity\Communaute;
use App\Entity\Utilisateur;
use App\Entity\Missionrapport;
use Masterminds\HTML5\Entities;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Repository\UtilisateurRepository;
use Lcobucci\JWT\Signer\None;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class JutificationMissionType extends AbstractType
{

    /**
     * Cette fonction permet de confugurer les champs de type text 
     *
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder, $default = true)
    {
        if ($default) {
            return [
                'label' => $label,
                'attr' => [
                    'placeholder' => $placeholder
                ]
            ];
        }
    }
     public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $type = $options["type"];
        $etat =$options["etat"];

     //  dd($etat);
     
        
       $builder->add('justification', TextareaType::class, [
                    'label' => 'Justifaction',
                    'attr' => ['readonly' => false]
       ]);


   // ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']]);
    


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missionrapport::class,
        ]);
        $resolver->setRequired('type');
        $resolver->setRequired('etat');

    }


   /* public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $type = $options["type"];
        $etat = $options["etat"];

        $this->addCommonFields($builder, $type);
        $this->addFieldsBasedOnEtat($builder, $etat);

   
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Missionrapport::class,
        ]);
        $resolver->setRequired('type');
        $resolver->setRequired('etat');
    }

    private function addCommonFields(FormBuilderInterface $builder, string $type): void
    {
        $builder
            ->add('communaute', EntityType::class, [
                'placeholder' => '---',
                'choice_label' => 'libelle',
                'label' => 'Communaute',
                'class' => Communaute::class,
                'multiple' => false,
                'expanded' => false,
                'required' => false,
                'attr' => ['class' => 'has-select2', 'readonly' => ($type === 'workflow')],
            ])
            ->add('titre_mission', TextType::class, [
                'label' => 'Titre de la mission',
                'attr' => ['readonly' => ($type === 'workflow')],
            ])
            // Ajoutez d'autres champs communs ici
        ;
    }

    private function addFieldsBasedOnEtat(FormBuilderInterface $builder, string $etat): void
    {
        if ($etat === 'missionrapport_rejeter') {
            $builder
                ->add('justification', TextareaType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => true],
                ])
                ->add('rejeter', SubmitType::class, ['label' => 'Rejeter', 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider ']]);
        } elseif ($etat === 'missionrapport_valider') {
            $builder
                ->add('justification', TextareaType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => true],
                ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider invisible']])
                ->add('rejeter', SubmitType::class, ['label' => 'Rejeter', 'attr' => ['class' => 'btn btn-main btn-ajax rejeter invisible']]);
        } elseif ($etat === 'missionrapport_attend') {
            $builder
                ->add('justification', TextareaType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => false],
                ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider']])
                ->add('rejeter', SubmitType::class, ['label' => 'Rejeter', 'attr' => ['class' => 'btn btn-main btn-ajax rejeter']]);
        } elseif ($etat === 'missionrapport_initie') {
            $builder
                ->add('justification', TextareaType::class, [
                    'label' => 'Saisir la prochaine étape',
                    'attr' => ['readonly' => true],
                ])
                ->add('accorder', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-main btn-ajax valider']])
                ->add('rejeter', SubmitType::class, ['label' => 'Rejeter', 'attr' => ['class' => 'btn btn-main btn-ajax rejeter']]);
        }
    }*/
}

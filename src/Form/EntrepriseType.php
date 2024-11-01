<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EntrepriseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('denomination')

            ->add('Sigle')
            ->add('Agrements')
            ->add('dateCreation',DateType::class,  [
                'attr' => ['class' => 'datepicker no-auto skip-init']
                , 'widget' => 'single_text'
                , 'format' => 'dd/MM/yyyy',
                'label'=>false
                , 'empty_data' => date('d/m/Y')
                , 'required' => false
                , 'html5' => false
            ])
            ->add('situation_geo',TextType::class,[

            ])
            ->add('contacts')

            ->add('mobile')
            ->add('fax')
            ->add('email',EmailType::class,[

                ])
            ->add('site_web')
            ->add('Directeur')
            ->add('pays', EntityType::class, [
                'class' => Pays::class,
                'choice_label' => 'libelle',
                'label' => 'Pays',
                'attr' => ['class' => 'has-select2 form-select']
            ])
            ->add('ville')
            ->add(
                'logo',
                FichierType::class,
                [
                  /*  'label' => 'Fichier',*/
                    'label' => 'Logo',
                    'doc_options' => $options['doc_options'],
                    'required' => $options['doc_required'] ?? true,
                    'validation_groups' => $options['validation_groups'],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Entreprise::class,
            'doc_required' => true,
            'doc_options' => [],
            'validation_groups' => [],
        ]);
        $resolver->setRequired('doc_options');
        $resolver->setRequired('doc_required');
        $resolver->setRequired(['validation_groups']);
    }
}

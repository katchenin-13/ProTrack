<?php

namespace App\Form;

use App\Entity\ConfigApp;
use App\Entity\Entreprise;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConfigAppType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'denomination',
                'label' => false,
                'attr' => ['class' => 'has-select2 form-select']
            ])

            ->add(
                'logo',
                FichierType::class,
                [
                    'label' => 'FichierAdmin',
                    'label' => 'Logo admin',
                    'doc_options' => $options['doc_options'],
                    'required' => $options['doc_required'] ?? true
                ]
            )
            ->add(
                'logoLogin',
                FichierType::class,
                [
                    'label' => 'FichierAdmin',
                    'label' => 'Logo login',
                    'doc_options' => $options['doc_options'],
                    'required' => $options['doc_required'] ?? true
                ]
            )

            ->add(
                'favicon',
                FichierType::class,
                [
                    'label' => 'FichierAdmin',
                    'label' => 'Favicon',
                    'doc_options' => $options['doc_options'],
                    'required' => $options['doc_required'] ?? true
                ]
            )
            ->add(
                'imageLogin',
                FichierType::class,
                [
                    'label' => 'FichierAdmin',
                    'label' => 'Image Login',
                    'doc_options' => $options['doc_options'],
                    'required' => $options['doc_required'] ?? true
                ]
            )
            ->add('mainColorAdmin', ColorType::class, [
                'required' => true,
                'label' => 'Couleur Principale admin',
            ])
            ->add('defaultColorAdmin', ColorType::class, [
                'required' => true,
                'label' => 'Couleur secondaire admin',
            ])
            ->add('mainColorLogin', ColorType::class, [
                'required' => true,
                'label' => 'Couleur Principale login',
            ])
            ->add('defaultColorLogin', ColorType::class, [
                'required' => true,
                'label' => 'Couleur secondaire login',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConfigApp::class,
            'doc_required' => true,
            'doc_options' => [],
        ]);
        $resolver->setRequired('doc_options');
        $resolver->setRequired('doc_required');
    }
}

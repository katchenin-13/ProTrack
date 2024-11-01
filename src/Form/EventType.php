<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('nom')
            // ->add('description')
            // ->add('startdate')
            // ->add('enddate')
            // ->add('starthour')
            // ->add('endhour')
        ->add('nom', TextType::class, [
            'label' => 'Titre',
            'attr' => ['placeholder' =>
                'le libelle ',
                'class' => 'form-control ',]
        ])
            // ->add('description', TextType::class, [
            //     'label' => 'La description',
            //     'attr' => ['placeholder' => 'le libelle ',
            //     'class' => 'form-control',
            //     ]
            // ])

            // ->add('description')
            // ->add('UpdatedAt')
            // ->add('CreatedAt')
            // ->add('utilisateur')

            // ->add('title')
            ->add('startdate', DateType::class, [
                 "label" => "Date de debut",
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

            ->add('enddate', DateType::class, [
                "label" => "Date de fin",
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
            // ->add('startdate',  DateType::class, [
            //     "label" => "Date de debut",
            //     "required" => false,
            //     "widget" => 'single_text',
            //     "input_format" => 'Y-m-d',
            //     "by_reference" => true,
            //     "empty_data" => '',
            //     'attr' => ['class' => 'date form-control form-control-solid ']
            // ])
         
            // ->add('enddate', DateType::class, [
            //     "label" => "Date de fin",
            //     "required" => false,
            //     "widget" => 'single_text',
            //     "input_format" => 'Y-m-d',
            //     "by_reference" => true,
            //     "empty_data" => '',
            //     'attr' => ['class' => 'date form-control form-control-solid ']
            // ])

           

            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}

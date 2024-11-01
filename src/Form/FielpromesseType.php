<?php

namespace App\Form;

use App\Entity\Typedon;
use App\Entity\Fielpromesse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class FielpromesseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('typedon')
            // ->add('promesse')
            // ->add('qte')
            // ->add('nature')
            // ->add('motif')
            // ->add('montant')
            // ->add('UpdatedAt')
            // ->add('CreatedAt')
            // ->add('utilisateur')

            // ->add('typedon', EntityType::class, [
            //     'class'        => Typedon::class,
            //     'label'        => false,
            //     "required" => true,
            //     'choice_label' => 'libelle',
            //     'multiple'     => false,
            //     'expanded'     => false,
            //     'attr' => ['class' => 'has-select2 changer'],

            // ])

            ->add('typepromesse', ChoiceType::class,[
                'choices'  => [
                    '....' => null,
                    'En espèce' => 'en_espece',
                    'En Nature' => 'en_nature',
                ],
                
                'mapped' => true,
                'multiple' => false,
                'expanded' => false,
                'label'        => false,
                "required" => true,
                'attr' => ['class' => 'has-select2 changer'],
            ]
        )

            ->add('qte', NumberType::class, [
                'label' => false,
                "required" => false,
            ])

            ->add('nature', TextType::class, [
                'label' => false,
                "required" => true,
            ])

            ->add('motif', TextType::class, [
                'label' => false,
                "required" => false,
                'attr' => ['placeholder' => 'Motif']
            ])

            ->add('montant', NumberType::class, [
                'label' => false,
                "required" => true,
                'attr' => ['placeholder' => ' Montant / Valeur']
            ])

    ;
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
            /*if ($data->get) {

            }*/
        });
                

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fielpromesse::class,
        ]);
    }
}

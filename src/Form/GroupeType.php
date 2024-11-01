<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Groupe;
use App\Entity\ModuleGroupePermition;
use App\Entity\Pays;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class GroupeType extends AbstractType
{
    private $groupe;
    public function __construct(Security $security){
        $this->groupe = $security->getUser()->getGroupe()->getName();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {




                $builder    ->add('code', null, ['label' => 'Code'])
           ->add('name', null, ['label' => 'Libellé'])
                    ->add('description', TextareaType::class, ['label' => 'Description', 'required' => false, 'empty_data' => ''])
                    ->add('moduleGroupePermitions', CollectionType::class, [
                        'entry_type' => ModuleGroupePermitionType::class,
                        'entry_options' => [
                            'label' => false,
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
            'data_class' => Groupe::class,
        ]);
    }
}

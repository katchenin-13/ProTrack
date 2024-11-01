<?php

namespace App\Form;

use App\Entity\GroupeModule;
use App\Entity\Icon;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Service\Menu;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GroupeModuleType extends AbstractType
{
    public $menu;

    public function __construct(Menu $menu)
    {
        $this->menu=$menu;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('lien',ChoiceType::class,
                [
                    'expanded'     => false,
                    'placeholder' => 'Choisir un lien',
                    'required'     => true,
                    'label'=>'Choisissez un lien',
                    /*   'attr' => ['class' => 'select2_multiple'],
                       'multiple' => true,*/
                    //'choices_as_values' => true,

                    'choices'  => array_flip($this->menu->listeGroupe()),

                ])
                ->add('ordre')
                ->add('icon', EntityType::class, [
                    'class' => Icon::class,
                    'choice_label' => 'libelle',
                    'label' => 'Icon',
                    'attr' => ['class' => 'has-select2 form-select']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GroupeModule::class,
        ]);
    }
}

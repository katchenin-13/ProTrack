<?php

namespace App\Form;

use App\Entity\Entreprise;
use App\Entity\Fonction;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class FonctionType extends AbstractType
{

    private $groupe;
    private $entreprise;
    public function __construct(Security $security){
        $this->groupe = $security->getUser()->getGroupe()->getCode();
        $this->entreprise = $security->getUser()->getEmploye()->getEntreprise();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /*if($this->groupe == "SADM") {
            $builder
           /*->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'denomination',
                'label' => 'Entreprise',
                'attr' => ['class' => 'has-select2 form-select']
            ])
                ->add('libelle', null, ['label' => 'Libellé'])
                /*->add('code', null, ['label' => 'Code'])
            ;
        }else{
           
        }*/

        $builder
            ->add('libelle', null, ['label' => 'Libellé'])
            /*->add('code', null, ['label' => 'Code'])*/;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fonction::class,
        ]);
    }
}

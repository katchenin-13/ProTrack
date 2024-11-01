<?php

namespace App\Form;

use App\Entity\Civilite;
use App\Entity\Entreprise;
use App\Entity\Fonction;
use App\Entity\Employe;
use App\Entity\EmployeService;
use App\Entity\Service;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;

class EmployeType extends AbstractType
{
    private $groupe;
    private $entreprise;
    public function __construct(Security $security){
        $this->groupe = $security->getUser()->getGroupe()->getCode();
        $this->entreprise = $security->getUser()->getEmploye()->getEntreprise();
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if($this->groupe == "SADM") {
            $builder->add('entreprise', EntityType::class, [
                'class' => Entreprise::class,
                'choice_label' => 'denomination',
                'label' => 'Departement',
                'attr' => ['class' => 'has-select2 form-select']
            ])
                /* ->add(
                    'piece',
                    FichierType::class,
                    [
                          'label' => 'Fichier',
                        'label' => 'Inséré une pièce',
                        'doc_options' => $options['doc_options'],
                        'required' => $options['doc_required'] ?? true,
                        'validation_groups' => $options['validation_groups'],
                    ]
                )
                ->add('civilite', EntityType::class, [
                    'class' => Civilite::class,
                    'choice_label' => 'code',
                    'label' => 'Civilité',
                    'attr' => ['class' => 'has-select2 form-select']
                ])*/
                ->add('genre', ChoiceType::class, [
                    'placeholder' => 'Veuillez sélectionner le sex',
                    'choices' => [
                        'F' => '0',
                        'M' => '1',
                    ],
                    'required' => true,

                ])
                //->add('matricule', null, ['label' => 'Matricule'])
                //->add('numPiece', null, ['label' => 'Numéro pièce'])
                ->add('contact', null, ['label' => 'Contact'])
               // ->add('residence', null, ['label' => 'Lieu de résidence'])
                
                ->add('adresseMail', EmailType::class, ['label' => 'Adresse E-mail', 'required' => false, 'empty_data' => ''])
                ->add('nom', null, ['label' => 'Nom'])
                ->add('prenom', null, ['label' => 'Prénoms'])
                ->add('fonction',  EntityType::class, [
                    'class' => Fonction::class,
                    'choice_label' => 'libelle',
                    'query_builder' => function (EntityRepository $er)  {
                          return $er->createQueryBuilder('f')
                              ->orderBy('f.id', 'ASC');
                    },
                    'label' => 'Profils',
                    'attr' => ['class' => 'has-select2 form-select commune']
                ]);
               
               /* ->add('service', EntityType::class, [
                    'class' => Service::class,
                    'choice_label' => 'libelle',
                    'label' => 'Direction',
                    'attr' => ['class' => 'has-select2 form-select']
                ]);*/
                }else{


        $builder
            // ->add('civilite', EntityType::class, [
            //     'class' => Civilite::class,
            //     'choice_label' => 'code',
            //     'label' => 'Civilité',
            //     'attr' => ['class' => 'has-select2 form-select']
            // ])
            
                ->add('genre', ChoiceType::class, [
                    'placeholder' => 'Veuillez sélectionner le sex',
                    'choices' => [
                        'F' => '0',
                        'M' => '1',
                    ],
                    'required' => true,

                ])
          //  ->add('matricule', null, ['label' => 'Matricule'])
            //->add('numPiece', null, ['label' => 'Numéro pièce'])
           // ->add('residence', null, ['label' => 'Lieu de résidence'])
            ->add('contact', null, ['label' => 'Contact(s)'])
            ->add('adresseMail', EmailType::class, ['label' => 'Adresse E-mail', 'required' => false, 'empty_data' => ''])
            ->add('nom', null, ['label' => 'Nom'])
            ->add('prenom', null, ['label' => 'Prénoms'])
            ->add('fonction',  EntityType::class, [
                'class' => Fonction::class,
                'choice_label' => 'libelle',
                'label'=>'Profils',
                'query_builder' => function (EntityRepository $er)  {

                    return $er->createQueryBuilder('f')
                        ->innerJoin('f.entreprise', 'e')
                        ->andWhere('e =: entreprise')
                        ->setParameter('entreprise', $this->entreprise)
                        ->orderBy('f.id', 'ASC');

                },
                'attr' => ['class' => 'has-select2 form-select commune']
            ])

        ;
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employe::class,
            'doc_required' => true,
            'doc_options' => [],
            'validation_groups' => [],
        ]);
        $resolver->setRequired('doc_options');
        $resolver->setRequired('doc_required');
        $resolver->setRequired(['validation_groups']);
    }
}

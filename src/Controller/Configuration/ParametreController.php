<?php

namespace App\Controller\Configuration;

use App\Controller\BaseController;
use App\Repository\CiviliteRepository;
use App\Service\Breadcrumb;
use App\Service\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[Route('/admin/config/parametre')]
class ParametreController extends BaseController
{

    const INDEX_ROOT_NAME = 'app_config_parametre_index';
    const INDEX_ROOT_NAME_MAISON = 'app_config_parametre_maisons_index';
    const INDEX_ROOT_NAME_CONTRAT = 'app_config_parametre_contrats_index';


    /* private $menu;
     public function __construct(Menu $menu){
         $this->menu = $menu;
     }*/

    #[Route(path: '/', name: 'app_config_parametre_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        /* if($this->menu->getPermission()){
             $redirect = $this->generateUrl('app_default');
             return $this->redirect($redirect);
             //dd($this->menu->getPermission());
         }*/
        $modules = [
            [
                'label' => 'Général',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'config'])
            ],
           

            // [
            //     'label' => 'Gestions des utilisateurs dormants',
            //     'icon' => 'bi bi-people',
            //     'href' => $this->generateUrl('app_config_parametre_ls', ['module' => 'rh'])
            // ],
          

        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Tableau de bord'
            ],
            [
                'label' => 'Paramètres'
            ]
        ]);

        return $this->render('config/parametre/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'permition' => $permission
        ]);
    }

    #[Route(path: '/{module}', name: 'app_config_parametre_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametres = [

           
            'rh' => [
                [
                    'label' => 'Profils',
                    'id' => 'param_categorie',
                    'href' => $this->generateUrl('app_parametre_fonction_index')
                ],

                // [
                //     'label' => 'Fonction',
                //     'id' => 'param_categorie',
                //     'href' => $this->generateUrl('app_utilisateur_utilisateur_index')
                // ],
                // [
                //     'label' => 'Direction',
                //     'id' => 'param_direction',
                //     'href' => $this->generateUrl('app_parametre_service_index')
                // ],
                
                [
                    'label' => 'Utilisateur dormant',
                    'id' => 'param_client',
                    'href' => $this->generateUrl('app_utilisateur_employe_index')
                ],
               /* [
                    'label' => 'Utilisateur dormant',
                    'id' => 'param_client',
                    'href' => $this->generateUrl('app_utilisateur_groupe_index')
                ],*/
               

            ],

            'config' => [

                [
                    'label' => 'Nature de la communauté',
                    'id' => 'param_categorie',
                    'href' => $this->generateUrl('app_parametre_categorie_index')
                ],
                [
                    'label' => 'Localités',
                    'id' => 'param_localite',
                    'href' => $this->generateUrl('app_parametre_localite_index')
                ],
                [
                    'label' => 'Communautés',
                    'id' => 'param_communaute',
                    'href' => $this->generateUrl('app_parametre_communaute_index')
                ],

            ],


        ];


        return $this->render('config/parametre/liste.html.twig', ['links' => $parametres[$module] ?? []]);
    }

    #[Route(path: '/maisons', name: 'app_config_parametre_maisons_index', methods: ['GET', 'POST'])]
    public function indexMaison(Request $request, Breadcrumb $breadcrumb): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME_MAISON);

        /* if($this->menu->getPermission()){
             $redirect = $this->generateUrl('app_default');
             return $this->redirect($redirect);
             //dd($this->menu->getPermission());
         }*/
        $modules = [
            [
                'label' => 'Les villes',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_parametre_ville_index')
            ],
            [
                'label' => 'Les quartiers',
                'icon' => 'bi bi-truck',
                'href' => $this->generateUrl('app_parametre_quartier_index')
            ],
            [
                'label' => 'Les types de maison',
                'icon' => 'bi bi-users',
                'href' => $this->generateUrl('app_parametre_Typemaison_index')
            ],[
                'label' => 'Les maisons',
                'icon' => 'bi bi-users',
                'href' => $this->generateUrl('app_parametre_maison_index')
            ],


        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Tableau de bord'
            ],
            [
                'label' => 'Maisons'
            ]
        ]);

        return $this->render('config/parametre/maison/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'permition' => $permission
        ]);
    }

    #[Route(path: '/contrats', name: 'app_config_parametre_contrats_index', methods: ['GET', 'POST'])]
    public function indexContrat(Request $request, Breadcrumb $breadcrumb): Response
    {

        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME_CONTRAT);

        /* if($this->menu->getPermission()){
             $redirect = $this->generateUrl('app_default');
             return $this->redirect($redirect);
             //dd($this->menu->getPermission());
         }*/
        $modules = [
            [
                'label' => 'Années',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_parametre_annee_index')
            ],
            [
                'label' => 'Motifs résiliation',
                'icon' => 'bi bi-truck',
                'href' => $this->generateUrl('app_parametre_motif_index')
            ]



        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Tableau de bord'
            ],
            [
                'label' => 'Contrats'
            ]
        ]);

        return $this->render('config/parametre/contrat/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'permition' => $permission
        ]);
    }
   

    
}

<?php

namespace App\Controller\Configuration;

use App\Service\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/config/group')]
class  AdminGroupController extends BaseController
{
    private const MODULE_NAME = 'Gestion des utilisateurs';
    const INDEX_ROOT_NAME = 'app_config_group_index';

    #[Route(path: '/', name: 'app_config_group_index', methods: ['GET', 'POST'])]
    public function index(Request $request, Breadcrumb $breadcrumb): Response
    {
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);
        
        $modules = [
           
            [
                'label' => 'Profils',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_parametre_fonction_index')
            ],
            [
                'label' => 'Utilisateur dormant ',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_utilisateur_employe_index')
            ],
            [
                'label' => 'Utilisateurs Actifs ',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_utilisateur_utilisateur_index')
            ],
            [
                'label' => 'Liste des profils utilisateur ',
                'icon' => 'bi bi-list',
                'href' => $this->generateUrl('app_utilisateur_groupe_index')
            ],
            

           
            


        ];

        $breadcrumb->addItem([
            [
                'route' => 'app_default',
                'label' => 'Audiances'
            ],
            [
                'label' => 'Paramètres'
            ]
        ]);

        return $this->render('config/group/index.html.twig', [
            'modules' => $modules,
            'breadcrumb' => $breadcrumb,
            'module_name' => self::MODULE_NAME,
            'permition' => $permission
        ]);
    }


    #[Route(path: '/{module}', name: 'app_config_avenir_ls', methods: ['GET', 'POST'])]
    public function liste(Request $request, string $module): Response
    {
        /**
         * @todo: A déplacer dans un service
         */
        $parametes = [

          
        ];


        return $this->render('config/group/liste.html.twig', ['links' => $parametes[$module] ?? []]);
    }
}
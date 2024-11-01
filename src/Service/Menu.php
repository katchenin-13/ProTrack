<?php

namespace App\Service;

use App\Entity\ModuleGroupePermition;
use App\Entity\ConfigApp;
use App\Entity\Prestataire;
use App\Entity\UserFront;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;

use Psr\Container\ContainerInterface;
use function PHPUnit\Framework\isEmpty;

class Menu
{

    private $em;
    private $route;
    private $container;
    private $security;

    private $resp;
    private $tableau = [];
    private  const IN_MENU_PRINCIPAL =1;


    public function __construct(EntityManagerInterface $em, RequestStack $requestStack, RouterInterface $router, Security $security)
    {
        $this->em = $em;
        if ($requestStack->getCurrentRequest()) {
            $this->route = $requestStack->getCurrentRequest()->attributes->get('_route');
            $this->container = $router->getRouteCollection()->all();
            $this->security = $security;
        }
        //dd($this->security->getUser()->getGroupe()->getName());
        //foreach($this->container as $key => $value){

        //  if(str_contains($key,'index')){
        //   $this->tableau [] = [
        // $key => str_replace('_',' ',$key)
        //  ];
        //}

        //  }

        // dd( $this->tableau);
        // if($this->getPermission() == null){
        // dd($this->getPermission());
        // }
        //dd($this->getPermission());
        /* if(!$this->getPermission()){
            dd("rrrr");
        }*/
        //$this->getPermission();
    }
    public function getGroupeName(){
        return $this->security->getUser()->getGroupe()->getName();
    }
    public function getGroupeCode(){
        return $this->security->getUser()->getGroupe()->getCode();
    }
    public function getRoute()
    {
        return $this->route;
    }
    public function getNamePrestataire($reference)
    {
        return $this->em->getRepository(UserFront::class)->findOneBy(['reference' => $reference]);
    }
    public function listeModule()
    {

        return $this->em->getRepository(ModuleGroupePermition::class)->afficheModule($this->security->getUser()->getGroupe()->getId());
    }



    public function listeGroupeModule()
    {
//dd($this->em->getRepository(ModuleGroupePermition::class)->affiche($this->security->getUser()->getGroupe()->getId()));

        return $this->em->getRepository(ModuleGroupePermition::class)->affiche($this->security->getUser()->getGroupe()->getId(),1);
    }

    public function findParametre()
    {

        return $this->em->getRepository(ConfigApp::class)->findConfig();
    }
    public function getTest()
    {
        return "#DDAD59";
    }
    public function getPermission()
    {
        $repo = $this->em->getRepository(ModuleGroupePermition::class)->getPermission($this->security->getUser()->getGroupe()->getId(), $this->route);
        //dd($repo);
        if ($repo != null) {
            return $repo['code'];
        } else {
            return $repo;
        }
    }

    public function getPermissionIfDifferentNull($group, $route)
    {
        $repo = $this->em->getRepository(ModuleGroupePermition::class)->getPermission($group, $route);
        //dd($repo);
        if ($repo != null) {
            return $repo['code'];
        } else {
            return $repo;
        }
    }

    public function liste()
    {


        return  $repo = $this->em->getRepository(Groupe::class)->afficheGroupes();
    }

    public function listeParent()
    {

        return $this->em->getRepository(Groupe::class)->affiche();
    }
    //public function listeModule
    public function listeGroupe()
    {
        $array = [
          
            'module' => 'modules',
            'app_config_parametre_index' => 'Parametrage général',
            'app_utilisateur_groupe_index' => 'Gestion groupe utilisateur',
            'app_utilisateur_utilisateur_index' => 'Gestion des utilisateur',
            'app_utilisateur_permition_index' => 'Gestion des rôles',
            'app_utilisateur_employe_index' => 'Gestion des employés',
            'app_default' => 'Home',
            'app_config_audience_index' => 'Audience',
            'app_config_don_index' => 'Bénéficiaires',
            'app_gestion_contact_index' => 'Contact',
            'app_config_mission_index' => 'Mission et Rapport',
            'app_gestion_mission_index' => 'Mission',
            'app_gestion_rapportmission_index' => 'Rapport de mission',
            'app_config_agenda_index' => 'Evènement',
            'app_gestion_calendrier' => 'Agenda',
            'app_gestion_admin_dashboad' => 'Statistique',
            'app_config_audience_index' => 'Audience avec groupe de personne',
            'app_gestion_audienceaveni_index' => 'Audience avec groupe de personne avenir',
            'app_gestion_demande_index' => 'Audience avec personne unique',
            'app_gestion_demandeavenir_index' => 'Audience avec personne unique avenir',
            'app_gestion_contact_index' => 'Contact',
            'app_gestion_don_index' => 'Don Beneficiaires',
            'app_gestion_fieldon_index' => 'Don Beneficiaires',

            'app_config_promesse_index' => 'Promesse Beneficiaires',
            'app_gestion_fielpromesse_index' => 'Promesses',

        ];

        return $array;
    }
    //    public function verifyanddispatch() {
    //
    //
    //
    //    }
}

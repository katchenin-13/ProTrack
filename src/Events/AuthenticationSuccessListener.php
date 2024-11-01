<?php


namespace App\Events;

use App\Controller\ApiInterface;
use App\Entity\UserFront;
use App\Entity\Utilisateur;
use App\Entity\UtilisateurSimple;
use App\Repository\UserFrontRepository;
use App\Repository\UtilisateurRepository;
use DateTime;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationFailureEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;


class AuthenticationSuccessListener extends ApiInterface
{
    private $utilisateurRepository;
    // private $userFrontRepository;
    public function __construct(UtilisateurRepository $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
        // $this->userFrontRepository = $userFrontRepository;
    }

    /**
     * @param AuthenticationSuccessEvent $event
     */
    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $data = $event->getData();
        $user = $event->getUser();

        //dd($user);
      
         if ($user instanceof Utilisateur) {
            $userData = $this->utilisateurRepository->find($user->getId());
            //dd($user);

            $data['data'] =   [
                'reference' => $user->getId(),
                'username' => $userData->getUsername(),
                //"type" => "user",

            ];
            // dd($data)
            $event->setData($data);
        }

        // if ($user instanceof UtilisateurSimple) {
        //     $userData = $this->userFrontRepository->findOneBy(array('reference' => $user->getReference()));
        //     //dd($user);
        //     //dd($userData["reference"]);$response->getContent();

        //     $type = str_contains($userData->getReference(), 'PR') ? "prestataire" : "simple";


        //     $data['data'] =   [
        //         'reference' =>    $userData->getReference(),
        //         'username' =>    $userData->getUsername(),

        //         "avatar" => "https://fr.web.img6.acsta.net/newsv7/21/02/26/16/13/3979241.jpg",
        //         "id" => $userData->getReference(),
        //         "accessToken" => "ffff",
        //         "expiredAt" => new DateTime(),
        //         "url" => "hhhh",
        //         "type" => $type,

        //     ];
        //     $event->setData($data);
        // }

        /*if($user instanceof Utilisateur ){
            $data['data'] = array(
                'id'=>$user->getId(),
                'nom'=>$user->getNomComplet(),

            );
            $event->setData($data);

        }*/
    }
}

<?php
namespace App\Controller;

use App\Service\Menu;
use Psr\Cache\CacheItemInterface;
use App\Repository\EventRepository;
use App\Repository\DemandeRepository;
use App\Repository\AudienceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ApiInterface extends AbstractController
{
    use FileTrait;

    protected const UPLOAD_PATH = 'media';
    protected $security;
    protected  $hasher;

    private $audienceRepo;
    private $demandeRepo;
    private $eventRepository;
    private $cache;
    private $audienceRepository;

    protected $serializer;

    public function __construct(Security $security,
        AudienceRepository $audienceRepository,
        CacheInterface $cache,
      
        DemandeRepository $demandeRepository,
        EventRepository $eventRepository,
        UserPasswordHasherInterface $hasher,
        SerializerInterface $serializer)
    {

        $this->security = $security;
        $this->hasher = $hasher;

        $this->audienceRepo = $audienceRepository;
        $this->audienceRepo = $demandeRepository;
        $this->eventRepository = $eventRepository;

        $this->cache = $cache;
        $this->audienceRepository = $audienceRepository;
        $this->serializer = $serializer;
       

    }

    

    /**
     * @var integer HTTP status code - 200 (OK) by default
     */
    protected $statusCode = 200;
    protected $message ="Operation effectuée avec succes";

    /**
     * Gets the value of statusCode.
     *
     * @return integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param integer $statusCode the status code
     *
     * @return self
     */
    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }
    protected function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function response($data, $headers = [])
    {
        // On spécifie qu'on utilise l'encodeur JSON
        $encoders = [new JsonEncoder()];

        // On instancie le "normaliseur" pour convertir la collection en tableau
        $normalizers = [new ObjectNormalizer()];

        // On instancie le convertisseur
        $serializer = new Serializer($normalizers, $encoders);
        if($data == null){
            $arrayData = [
                'data'=>null,
                'message'=>$this->getMessage(),
                'status'=>$this->getStatusCode()
            ];
        }
        else{
            $arrayData = [
                'data'=>$data,
                'message'=>$this->getMessage(),
                'status'=>$this->getStatusCode()
            ];
        }

        // On convertit en json
        $jsonContent = $serializer->serialize($arrayData, 'json', [
            'circular_reference_handler' => function ($object) {
                return  $object->getId();
            },

        ]);

        // On instancie la réponse
        $response = new Response($jsonContent);

        // On ajoute l'entête HTTP
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        //return new JsonResponse($response, $this->getStatusCode(), $headers);
    }

    public function getCalendrier()
    {


        $query1 = $this->audienceRepo->getAudienceValider();


        try {
            $result1 = $query1->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $result1 = [];
        }

        $query2 = $this->audienceRepo->getDemandeValider();
        try {
            $result2 = $query2->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            $result2 = [];
        }

        return array_merge($result1, $result2);
    }

    public function responseNew($data = [], $group, $headers = [])
    {
        try {
            if ($data) {
                $context = [AbstractNormalizer ::GROUPS => $group];
                $json = $this->serializer->serialize($data, 'json', $context);
                $response = new JsonResponse(['code' => 200, 'message' => $this->getMessage(), 'data' => json_decode($json)], 200, $headers);
            } else {
                $response = new JsonResponse(['code' => 200, 'message' => $this->getMessage(), 'data' => []], 200, $headers);
            }
        } catch (\Exception $e) {
            $response = new JsonResponse(['code' => 500, 'message' => $e->getMessage(), 'data' => []], 500, $headers);
        }

        return $response;
    }

}
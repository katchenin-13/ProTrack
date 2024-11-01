<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use App\Entity\Utilisateur;
use App\Repository\GroupeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UtilisateurFixtures extends Fixture implements DependentFixtureInterface
{
    public const DEFAULT_USER_REFERENCE = 'default-user';

    private UserPasswordHasherInterface $hasher;
    private $groupe;

    public function __construct(UserPasswordHasherInterface $hasher,GroupeRepository $groupe)
    {
        $this->hasher = $hasher;
        $this->groupe = $groupe;
    }


    public function load(ObjectManager $manager): void
    {
        $utilisateur = new Utilisateur();
        $utilisateur->setGroupe($this->groupe->findOneBy((array("name"=>"Super Administrateur"))));
       // $utilisateur->addGroupe($this->getReference(GroupeFixtures::ADMIN_GROUP_REFERENCE));
        $utilisateur->setUsername('admin');
        $utilisateur->setPassword($this->hasher->hashPassword($utilisateur, 'admin'));
        $utilisateur->setEmploye($this->getReference(EmployeFixtures::ADMIN_EMPLOYE_REFERENCE));
        // $product = new Product();
        // $manager->persist($product);
        $manager->persist($utilisateur);

        $manager->flush();

        $this->addReference(self::DEFAULT_USER_REFERENCE, $utilisateur);
    }


    public function getDependencies()
    {
        return [
            EmployeFixtures::class,
            GroupeFixtures::class,
        ];
    }
}

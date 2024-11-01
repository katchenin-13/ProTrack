<?php

namespace App\DataFixtures;

use App\Entity\Employe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EmployeFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_EMPLOYE_REFERENCE = 'admin-employe';
    public function load(ObjectManager $manager): void
    {
        $employe = new Employe();
        $employe->setNom('Admin');
        $employe->setPrenom('Admin');
       /// $employe->setCivilite($this->getReference(CiviliteFixtures::DEFAULT_CIVILITE_REFERENCE));
        $employe->setFonction($this->getReference(FonctionFixtures::DEFAULT_FONCTION_EMPLOYE));
        $employe->setEntreprise($this->getReference(EntrepriseFixtures::DEFAULT_ENTEPRISE_REFERENCE));
        $employe->setContact('00000000');
        //$employe->setMatricule('00000000');
        $employe->setAdresseMail('admin@knh.com');
      //  $employe->setNumPiece('555');
      //  $employe->setResidence('admin@knh.com');

        $manager->persist($employe);

        $manager->flush();

        $this->addReference(self::ADMIN_EMPLOYE_REFERENCE, $employe);
    }

    public function getDependencies()
    {
        return [
            CiviliteFixtures::class,
            FonctionFixtures::class,
            EntrepriseFixtures::class
        ];
    }
}

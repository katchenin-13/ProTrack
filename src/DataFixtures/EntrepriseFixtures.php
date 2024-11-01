<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixtures extends Fixture
{
    public const DEFAULT_ENTEPRISE_REFERENCE = 'default-entreprise';
    public function load(ObjectManager $manager): void
    {
        $entreprise = new Entreprise();
        $entreprise->setDenomination('Default');
        $entreprise->setSigle('ENT1');
        $entreprise->setAdresse('ENT1');
        $entreprise->setAgrements('ENT1');
        $entreprise->setEmail('ENT1');
        $entreprise->setContacts('ENT1');
        $entreprise->setFax('ENT1');
        $entreprise->setSituationGeo('ENT1');
        $entreprise->setSiteWeb('ENT1');
        $entreprise->setCode('ENT1');
        $entreprise->setMobile('ENT1');
       // $entreprise->setLogo('ENT1');
       // $entreprise->set('ENT1');
        // $product = new Product();
        $manager->persist($entreprise);

        $manager->flush();

        $this->addReference(self::DEFAULT_ENTEPRISE_REFERENCE, $entreprise);
    }
}

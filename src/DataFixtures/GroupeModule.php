<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GroupeModule extends Fixture implements DependentFixtureInterface
{
    public const DEFAULT_GROUPE_MODULE_REFERENCE = 'default-groupe-module';
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $groupeModule = new \App\Entity\GroupeModule();
        $groupeModule->setTitre('Groupe module');
        $groupeModule->setOrdre(2);
        $groupeModule->setLien('app_utilisateur_groupe_index');
        $groupeModule->setIcon($this->getReference(Icon::DEFAULT_ICON));
        $manager->persist($groupeModule);
        /*   }*/

        $manager->flush();

        $this->addReference(self::DEFAULT_GROUPE_MODULE_REFERENCE, $groupeModule);
    }

    public function getDependencies()
    {
        return [
            Icon::class
        ];
    }
}

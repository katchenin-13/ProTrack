<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Module extends Fixture
{
    public const DEFAULT_MODULE_REFERENCE = 'default-module';
    public function load(ObjectManager $manager): void
    {
        $module = new \App\Entity\Module();
        $module->setTitre('Configuration');
        $module->setOrdre(1);
        // $product = new Product();
        $manager->persist($module);

        $manager->flush();

        $this->addReference(self::DEFAULT_MODULE_REFERENCE, $module);
    }
}

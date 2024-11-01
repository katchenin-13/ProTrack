<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Permition extends Fixture
{
    public const DEFAULT_PERMITION_REFERENCE = 'default-permition';
    public function load(ObjectManager $manager): void
    {
        $permition = new \App\Entity\Permition();
        $permition->setLibelle('Tous les droits');
        $permition->setCode('CRUD');
        // $product = new Product();
        $manager->persist($permition);

        $manager->flush();

        $this->addReference(self::DEFAULT_PERMITION_REFERENCE, $permition);
    }
}

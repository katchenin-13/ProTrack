<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Icon extends Fixture
{
    public const DEFAULT_ICON = 'default-icon';
    public function load(ObjectManager $manager): void
    {
        $icon = new \App\Entity\Icon();
        $icon->setLibelle('Icon fleche croissante');
        $icon->setCode('bi bi-arrow-up-right-circle');
        // $product = new Product();
        $manager->persist($icon);

        $manager->flush();

        $this->addReference(self::DEFAULT_ICON, $icon);

    }
}

<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ModuleGroupePermition extends Fixture implements DependentFixtureInterface
{
    public const DEFAULT_GROUPE_PERMITION_REFERENCE = 'default-groupe-permition';
    public function load(ObjectManager $manager): void
    {

        $groupePermition = new \App\Entity\ModuleGroupePermition();
        $groupePermition->setPermition($this->getReference(Permition::DEFAULT_PERMITION_REFERENCE));
        $groupePermition->setGroupeModule($this->getReference(GroupeModule::DEFAULT_GROUPE_MODULE_REFERENCE));
        $groupePermition->setGroupeUser($this->getReference(GroupeFixtures::ADMIN_GROUP_REFERENCE));
        $groupePermition->setModule($this->getReference(Module::DEFAULT_MODULE_REFERENCE));
        $groupePermition->setOrdre(1);
        $groupePermition->setOrdreGroupe(2);
        $groupePermition->setMenuPrincipal(true);

        $manager->persist($groupePermition);

        $manager->flush();

        $this->addReference(self::DEFAULT_GROUPE_PERMITION_REFERENCE, $groupePermition);
    }
    public function getDependencies()
    {
        return [
            Permition::class,
            GroupeModule::class,
            GroupeFixtures::class,
            Module::class,
        ];
    }
}

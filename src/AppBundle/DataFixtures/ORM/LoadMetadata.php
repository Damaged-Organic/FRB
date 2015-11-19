<?php
// src/AppBundle/DataFixtures/ORM/LoadMetadata.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Metadata;

class LoadMetadata extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $metadata = (new Metadata)
            ->setRoute("index")
            ->setRobots("index, follow")
            ->setTitle("Главная")
            ->setDescription("");
        $manager->persist($metadata);
        $manager->flush();

        $metadata->setTitle("Homepage")
            ->setDescription("")
            ->setTranslatableLocale('en');
        $manager->persist($metadata);
        $manager->flush();

        // ---
    }

    public function getOrder()
    {
        return 1;
    }
}
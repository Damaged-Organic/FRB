<?php
// src/AppBundle/DataFixtures/ORM/LoadClient.php
namespace AppBundle\DataFixtures\ORM;

use DateTime;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Client;

class LoadClient extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $client_1 = (new Client)
                ->setName("Botschaft")
                ->setLogoName("botschaft.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_1
                ->setTranslatableLocale("en")
                ->setName("Botschaft")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_2 = (new Client)
                ->setName("Ericsson")
                ->setLogoName("ericsson.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_2
                ->setTranslatableLocale("en")
                ->setName("Ericsson")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_3 = (new Client)
                ->setName("Austria")
                ->setLogoName("austria.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_3
                ->setTranslatableLocale("en")
                ->setName("Austria")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_4 = (new Client)
                ->setName("Iron Mountain")
                ->setLogoName("iron-mountain.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_4
                ->setTranslatableLocale("en")
                ->setName("Iron Mountain")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_5 = (new Client)
                ->setName("Pulse")
                ->setLogoName("pulse.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_5
                ->setTranslatableLocale("en")
                ->setName("Pulse")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_6 = (new Client)
                ->setName("PZU")
                ->setLogoName("pzu.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_6
                ->setTranslatableLocale("en")
                ->setName("PZU")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_7 = (new Client)
                ->setName("Swiss")
                ->setLogoName("swiss.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_7
                ->setTranslatableLocale("en")
                ->setName("Swiss")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_8 = (new Client)
                ->setName("USA Embassy")
                ->setLogoName("usa-embassy.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_8
                ->setTranslatableLocale("en")
                ->setName("USA Embassy")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $client_9 = (new Client)
                ->setName("Воля Кабель")
                ->setLogoName("volia.jpg")
                ->setUpdatedAt(new DateTime)
        );
        $manager->flush();

        $manager->persist
        (
            $client_9
                ->setTranslatableLocale("en")
                ->setName("Volia")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
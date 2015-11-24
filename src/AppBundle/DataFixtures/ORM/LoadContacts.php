<?php
// src/AppBundle/DataFixtures/ORM/LoadContacts.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Contact;

class LoadContacts extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $contact = (new Contact)
                ->setAddress("провулок. Кутузова, 18/7, 4 поверх, 01133, Київ, Україна")
                ->setPhone("+38 (044) 459-70-69")
                ->setFax("+38 (044) 459-06-09")
                ->setEmail("office@frbrokerage.net")
        );
        $manager->flush();

        $manager->persist
        (
            $contact
                ->setTranslatableLocale("en")
                ->setAddress("18/7, Kutuzova Street, 4th floor, 01133, Kyiv, Ukraine")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
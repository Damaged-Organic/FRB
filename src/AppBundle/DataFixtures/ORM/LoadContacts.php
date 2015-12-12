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
                ->setHeadline("Hohol Welcome!")
                ->setIntro("<p>Hohol Teddy Beer</p>")
                ->setList('Hohol test 1' . PHP_EOL . 'Hohol test 2')
                ->setOutro("<p>Hohol Drunk as fuck!</p>")
        );

        $contact
            ->setRawIntro($contact->getIntro("<p>Hohol Teddy Beer</p>"))
            ->setRawOutro($contact->getOutro("<p>Hohol Drunk as fuck!</p>"))
        ;

        $manager->flush();

        $manager->persist
        (
            $contact
                ->setTranslatableLocale("en")
                ->setAddress("18/7, Kutuzova Street, 4th floor, 01133, Kyiv, Ukraine")
                ->setHeadline("Welcome!")
                ->setIntro("<p>Teddy Beer</p>")
                ->setList('test 1' . PHP_EOL . 'test 2')
                ->setOutro("<p>Drunk as fuck!</p>")
        );

        $contact
            ->setRawIntro($contact->getIntro("<p>Teddy Beer</p>"))
            ->setRawOutro($contact->getOutro("<p>Drunk as fuck!</p>"))
        ;

        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}

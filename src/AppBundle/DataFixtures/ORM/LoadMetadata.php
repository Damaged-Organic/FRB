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
        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("index")
                ->setRobots("index, follow")
                ->setTitle("Головна")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Homepage")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("catalog")
                ->setRobots("index, follow")
                ->setTitle("Каталог")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Catalog")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("catalog_proposal")
                ->setRobots("index, follow")
                ->setTitle("Розміщення нерухомості")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Property proposal")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("catalog_item")
                ->setRobots("index, follow")
                ->setTitle("Об’єкт нерухомості")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Estate object")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("services")
                ->setRobots("index, follow")
                ->setTitle("Послуги")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Services")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("staff")
                ->setRobots("index, follow")
                ->setTitle("Про нас")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("About us")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("vacancies")
                ->setRobots("index, follow")
                ->setTitle("Вакансії")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Vacancies")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("news")
                ->setRobots("index, follow")
                ->setTitle("Новини")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("News")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("researches")
                ->setRobots("index, follow")
                ->setTitle("Дослідження")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Researches")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("expats_relocation")
                ->setRobots("index, follow")
                ->setTitle("Релокація експатів")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Expats relocation")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("expats_information")
                ->setRobots("index, follow")
                ->setTitle("Інформація для експатів")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Information for expats")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $metadata = (new Metadata)
                ->setRoute("contacts")
                ->setRobots("index, follow")
                ->setTitle("Контакти")
                ->setDescription("")
        );
        $manager->flush();

        $manager->persist
        (
            $metadata->setTitle("Contacts")
                ->setDescription("")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---
    }

    public function getOrder()
    {
        return 1;
    }
}

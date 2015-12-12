<?php
// src/MenuBundle/DataFixtures/ORM/LoadMenu.php
namespace MenuBundle\DataFixtures;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use MenuBundle\Entity\Menu;

class LoadMenu extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Об’єкти")
                ->setBlock('catalog')
                ->setRoute("catalog")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Objects")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Об’єкт нерухомості")
                ->setBlock(NULL)
                ->setRoute("catalog_item")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Property object")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Пропозиція власної нерухомості")
                ->setBlock(NULL)
                ->setRoute("catalog_proposal")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Own property proposal")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Послуги")
                ->setBlock('services')
                ->setRoute("services")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Services")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Релокація експатів")
                ->setBlock('services')
                ->setRoute("expats_relocation")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Expats relocation")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Інформація для експатів")
                ->setBlock('services')
                ->setRoute("expats_information")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Information for expats")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Про нас")
                ->setBlock('general')
                ->setRoute("staff")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("About us")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Вакансії")
                ->setBlock('general')
                ->setRoute("vacancies")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Vacancies")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Новини")
                ->setBlock('general')
                ->setRoute("news")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("News")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Дослідження")
                ->setBlock('general')
                ->setRoute("researches")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Researches")
                ->setTranslatableLocale('en')
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Контакти")
                ->setBlock('general')
                ->setRoute("contacts")
        );
        $manager->flush();

        $manager->persist
        (
            $menuItem->setTitle("Contacts")
                ->setTranslatableLocale('en')
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}

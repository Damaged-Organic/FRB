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
                ->setTitle("Послуги")
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
                ->setTitle("Про нас")
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

        // $manager->persist
        // (
        //     $menuItem = (new Menu)
        //         ->setTitle("Інформація для експатів")
        //         ->setRoute("expats_information")
        // );
        // $manager->flush();
        //
        // $manager->persist
        // (
        //     $menuItem->setTitle("Information for expats")
        //         ->setTranslatableLocale('en')
        // );
        // $manager->flush();

        // ---

        $manager->persist
        (
            $menuItem = (new Menu)
                ->setTitle("Контакти")
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

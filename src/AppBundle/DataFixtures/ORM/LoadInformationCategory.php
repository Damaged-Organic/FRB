<?php
// src/AppBundle/DataFixtures/ORM/LoadInformationCategory.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Utility\InformationCategoriesListInterface,
    AppBundle\Entity\InformationCategory;

class LoadInformationCategory extends AbstractFixture implements OrderedFixtureInterface, InformationCategoriesListInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $informationCategory_1 = (new InformationCategory)
                ->setAlias(self::CATEGORY_HOSPITAL)
                ->setTitle("Лікарні")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_1
                ->setTranslatableLocale("en")
                ->setTitle("Hospitals")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_2 = (new InformationCategory)
                ->setAlias(self::CATEGORY_SCHOOL)
                ->setTitle("Школи")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_2
                ->setTranslatableLocale("en")
                ->setTitle("Schools")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_3 = (new InformationCategory)
                ->setAlias(self::CATEGORY_ENTERTAINMENT)
                ->setTitle("Розваги")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_3
                ->setTranslatableLocale("en")
                ->setTitle("Entertainment")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_4 = (new InformationCategory)
                ->setAlias(self::CATEGORY_METRO)
                ->setTitle("Метро")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_4
                ->setTranslatableLocale("en")
                ->setTitle("Metro")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_5 = (new InformationCategory)
                ->setAlias(self::CATEGORY_SHOP)
                ->setTitle("Магазини")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_5
                ->setTranslatableLocale("en")
                ->setTitle("Shops")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_6 = (new InformationCategory)
                ->setAlias(self::CATEGORY_GYM)
                ->setTitle("Спортзали")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_6
                ->setTranslatableLocale("en")
                ->setTitle("Gyms")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_7 = (new InformationCategory)
                ->setAlias(self::CATEGORY_CAR_RENT)
                ->setTitle("Оренда авто")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_7
                ->setTranslatableLocale("en")
                ->setTitle("Car rent")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_8 = (new InformationCategory)
                ->setAlias(self::CATEGORY_PRESS)
                ->setTitle("Преса")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_8
                ->setTranslatableLocale("en")
                ->setTitle("Press")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_9 = (new InformationCategory)
                ->setAlias(self::CATEGORY_TAXI)
                ->setTitle("Таксі")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_9
                ->setTranslatableLocale("en")
                ->setTitle("Taxi")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $informationCategory_10 = (new InformationCategory)
                ->setAlias(self::CATEGORY_COMMUNITY)
                ->setTitle("Спільноти")
        );
        $manager->flush();

        $manager->persist
        (
            $informationCategory_10
                ->setTranslatableLocale("en")
                ->setTitle("Communities")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}
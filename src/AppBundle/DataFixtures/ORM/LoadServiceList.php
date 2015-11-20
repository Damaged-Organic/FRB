<?php
// src/AppBundle/DataFixtures/ORM/LoadServiceList.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ServiceList;

class LoadServiceList extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist(
            $list_1_1 = (new ServiceList)
                ->setService($this->getReference('service_commercial'))
                ->setTitle("Типи коммерційних послуг")
                ->setShortDescription("Послуги для комерційної нерухомості включають в себе:")
        );
        $manager->flush();

        $manager->persist(
            $list_1_1
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        $manager->persist(
            $list_1_2 = (new ServiceList)
                ->setService($this->getReference('service_commercial'))
                ->setTitle("Наш процесс роботи")
                ->setShortDescription("Наш процес роботи складається, але не обмежується наступним:")
        );
        $manager->flush();

        $manager->persist(
            $list_1_2
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $list_2_1 = (new ServiceList)
                ->setService($this->getReference('service_residential'))
                ->setTitle("Послуги оренди")
                ->setShortDescription("Послуги довгострокової оренди квартир / будинків представницького класу, що складаються, але не обмежуються наступним:")
        );
        $manager->flush();

        $manager->persist(
            $list_2_1
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        $manager->persist(
            $list_2_2 = (new ServiceList)
                ->setService($this->getReference('service_residential'))
                ->setTitle("Послуги управління")
                ->setShortDescription("Послуги з управління житловою нерухомістю:")
        );
        $manager->flush();

        $manager->persist(
            $list_2_2
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $list_3_1 = (new ServiceList)
                ->setService($this->getReference('service_valuation'))
                ->setTitle("Послуги оцінки")
                ->setShortDescription("First realty brokerage пропонує послуги з оцінки, ринкових досліджень та бізнес-моделювання, у тому числі оцінку, дью-ділідженс для всіх видів нерухомості:")
        );
        $manager->flush();

        $manager->persist(
            $list_3_1
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        $manager->persist(
            $list_3_2 = (new ServiceList)
                ->setService($this->getReference('service_valuation'))
                ->setTitle("Типи складаємих угод")
                ->setShortDescription("Наш досвід та знання ринку служать для нас основою для визначення вартості вашого бізнесу чи нерухомості для:")
        );
        $manager->flush();

        $manager->persist(
            $list_3_2
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $list_4_1 = (new ServiceList)
                ->setService($this->getReference('service_management'))
                ->setTitle("Послуги обслуговування об’єктів")
                ->setShortDescription("Послуги з обслуговування об’єктів комерційної нерухомості:")
        );
        $manager->flush();

        $manager->persist(
            $list_4_1
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        $manager->persist(
            $list_4_2 = (new ServiceList)
                ->setService($this->getReference('service_management'))
                ->setTitle("Управління проектами ремонтних робіт")
                ->setShortDescription("Послуга з управління проектами ремонтних робіт у приміщеннях:")
        );
        $manager->flush();

        $manager->persist(
            $list_4_2
                ->setTranslatableLocale("en")
                ->setTitle("")
                ->setShortDescription("")
        );
        $manager->flush();

        // ---

        $this->addReference('service_list_commercial_1_1', $list_1_1);
        $this->addReference('service_list_commercial_1_2', $list_1_2);

        $this->addReference('service_list_residential_2_1', $list_2_1);
        $this->addReference('service_list_residential_2_2', $list_2_2);

        $this->addReference('service_list_valuation_3_1', $list_3_1);
        $this->addReference('service_list_valuation_3_2', $list_3_2);

        $this->addReference('service_list_management_4_1', $list_4_1);
        $this->addReference('service_list_management_4_2', $list_4_2);
    }

    public function getOrder()
    {
        return 2;
    }
}
<?php
// src/AppBundle/DataFixtures/ORM/LoadService.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Service;

class LoadService extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $service_1 = (new Service)
            ->setTitle("Комерційна нерухомість")
            ->setShortDescription("Комплексні брокерські послуги стосовно оренди / продажу всіх видів комерційної нерухомості як для корпоративних клієнтів так і для власників приміщень")
            ->setAlias("commercial")
            ->setCssPosition("front")
            //->setPhotoName("...")
        ;

        $manager->persist($service_1);
        $manager->flush();

        $service_1
            ->setTranslatableLocale("en")
            ->setTitle("Commercial property")
            ->setShortDescription("Complex agency services regarding office, retail, warehousing real estate, land plots for both corporate accounts and landlords")
        ;

        $manager->persist($service_1);
        $manager->flush();

        // ---

        $service_2 = (new Service)
            ->setTitle("Житлова нерухомість")
            ->setShortDescription("Брокерські послуги з довгострокової оренди квартир та будинків представницького класу для міжнародних компаній та посольств; продаж та купівля житлової нерухомості")
            ->setAlias("private")
            ->setCssPosition("top")
            //->setPhotoName("...")
        ;

        $manager->persist($service_2);
        $manager->flush();

        $service_2
            ->setTranslatableLocale("en")
            ->setTitle("Residential real estate")
            ->setShortDescription("Brokerage services regarding long-term lease of executive apartments and houses for international companies and embassies. Sale/Purchase transactions re residential property")
        ;

        $manager->persist($service_2);
        $manager->flush();

        // ---

        $service_3 = (new Service)
            ->setTitle("Оцінка майна")
            ->setShortDescription("Послуги з оцінки майна для різних бізнес-цілей, що надаються сертифікованими спеціалістами у відповідності до Національних та міжнародних стандартів")
            ->setAlias("evaluation")
            ->setCssPosition("back")
            //->setPhotoName("...")
        ;

        $manager->persist($service_3);
        $manager->flush();

        $service_3
            ->setTranslatableLocale("en")
            ->setTitle("Valuation services")
            ->setShortDescription("Valuation services for different business purposes in accordance to International and Ukrainian standards")
        ;

        $manager->persist($service_3);
        $manager->flush();

        // ---

        $service_4 = (new Service)
            ->setTitle("Управління нерухомістю")
            ->setShortDescription("Послуги з комплексного управління будівлями та приміщеннями об’єктів нерухомості для власників та корпоративних орендарів")
            ->setAlias("management")
            ->setCssPosition("bottom")
            //->setPhotoName("...")
        ;

        $manager->persist($service_4);
        $manager->flush();

        $service_4
            ->setTranslatableLocale("en")
            ->setTitle("Property management")
            ->setShortDescription("Integrated property and facility management services for commercial real estate owners and corporate tenants")
        ;

        $manager->persist($service_4);
        $manager->flush();

        // ---

        $this->addReference('service_commercial', $service_1);
        $this->addReference('service_residential', $service_2);
        $this->addReference('service_valuation', $service_3);
        $this->addReference('service_management', $service_4);
    }

    public function getOrder()
    {
        return 1;
    }
}
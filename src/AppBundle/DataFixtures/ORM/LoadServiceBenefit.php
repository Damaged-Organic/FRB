<?php
// src/AppBundle/DataFixtures/ORM/LoadServiceBenefit.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ServiceBenefit;

class LoadServiceBenefit extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist(
            $benefit_0_1 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-connected")
                ->setThesis("Виконання всіх функцій через одного провайдера")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_1
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_2 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-clock")
                ->setThesis("Oптимізація щоденної роботи з підрядниками. Ми здійснюємо повне управління та контроль за виконанням робіт")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_2
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_3 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-credit-card")
                ->setThesis("Зниження вартості придбання Клієнтом товарів та послуг за рахунок об'єднання об’ємів закупівель з об’ємами інших замовлень")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_3
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_4 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-staff")
                ->setThesis("Залучення як власного висококваліфікованого персоналу і спеціалізованих субпідрядників, так і аут-стафінг персоналу клієнта")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_4
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_5 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-abacus")
                ->setThesis("Зменшення об’ємів роботи бухгалтерії Клієнта - надання послуги списання товарів згідно Акту наданих послуг: кави, продуктів, води тощо")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_5
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_6 = (new ServiceBenefit)
                ->setService(NULL)
                ->setIcon("icon-package")
                ->setThesis("В кінці звітного місяця Клієнт має один консолідований пакет документів - один рахунок/один акт")
        );
        $manager->flush();

        $manager->persist(
            $benefit_0_6
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $benefit_1_1 = (new ServiceBenefit)
                ->setService($this->getReference('service_commercial'))
                ->setIcon("icon-deal")
                ->setThesis("Безліч успішно завершених угод протягом 9 років діяльності")
        );
        $manager->flush();

        $manager->persist(
            $benefit_1_1
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_1_2 = (new ServiceBenefit)
                ->setService($this->getReference('service_commercial'))
                ->setIcon("icon-team")
                ->setThesis("Досвідчена команда професіоналів. Ми представляємо кращі інтереси наших клієнтів в угодах")
        );
        $manager->flush();

        $manager->persist(
            $benefit_1_2
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_1_3 = (new ServiceBenefit)
                ->setService($this->getReference('service_commercial'))
                ->setIcon("icon-performance")
                ->setThesis("Наша глибоке знання ринку забезпечує експертизу високого рівня при консультуванні клієнтів")
        );
        $manager->flush();

        $manager->persist(
            $benefit_1_3
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $benefit_2_1 = (new ServiceBenefit)
                ->setService($this->getReference('service_residential'))
                ->setIcon("icon-globe")
                ->setThesis("Послуги надає команда професіоналів, яка високо володіє англійською мовою")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_1
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_2 = (new ServiceBenefit)
                ->setService($this->getReference('service_residential'))
                ->setIcon("icon-experience")
                ->setThesis("Наш досвід роботи в сфері житлової нерухомості - більше 8 років")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_2
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_3 = (new ServiceBenefit)
                ->setService($this->getReference('service_residential'))
                ->setIcon("icon-client")
                ->setThesis("Наші основні клієнти - це топ-менеджери міжнародних компаній і співробітники посольств інших країн")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_3
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_4 = (new ServiceBenefit)
                ->setService($this->getReference('service_residential'))
                ->setIcon("icon-shield")
                ->setThesis("Основний принцип роботи - це захист інтересів тільки однієї зі сторін - наших клієнтів, які виступають орендарями")
        );
        $manager->flush();

        $manager->persist(
            $benefit_2_4
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        // ---

        $manager->persist(
            $benefit_3_1 = (new ServiceBenefit)
                ->setService($this->getReference('service_valuation'))
                ->setIcon("icon-idea")
                ->setThesis("В основі нашого підходу - постійні інновації та гнучкість при роботі з потребами менеджменту клієнта")
        );
        $manager->flush();

        $manager->persist(
            $benefit_3_1
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_3_2 = (new ServiceBenefit)
                ->setService($this->getReference('service_valuation'))
                ->setIcon("icon-puzzle")
                ->setThesis("Наші професійні судження базуються на власній кваліфікації, великому галузевому досвіді, міжнародних стандартах, поряд з гнучким підходом до будь-яких випробувань")
        );
        $manager->flush();

        $manager->persist(
            $benefit_3_2
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();

        $manager->persist(
            $benefit_3_3 = (new ServiceBenefit)
                ->setService($this->getReference('service_valuation'))
                ->setIcon("icon-thought")
                ->setThesis("Ви отримаєте обґрунтовану думку, засновану на глибокому знанні галузевих та інвестиційних ринків і підготовлену досвідченою командою фахівців, в узгоджені терміни за конкурентоспроможною ціною")
        );
        $manager->flush();

        $manager->persist(
            $benefit_3_3
                ->setTranslatableLocale("en")
                ->setThesis("")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
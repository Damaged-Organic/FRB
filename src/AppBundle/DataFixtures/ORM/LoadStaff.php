<?php
// src/AppBundle/DataFixtures/ORM/LoadStaff.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\Staff;

class LoadStaff extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $staff_1 = (new Staff)
            ->addService($this->getReference("service_commercial"))
            ->addService($this->getReference("service_residential"))
            ->addService($this->getReference("service_valuation"))
            ->addService($this->getReference("service_management"))
            ->setName("Вадим Лівшиц")
            ->setPosition("Керуючий партнер")
            ->setEducation("EMBA (Lancaster University, UK)")
            ->setDegree("PhD")
            ->setPhone("+38 (050) 310 1010")
            ->setEmail("v.livshyts@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_1);
        $manager->flush();

        $staff_1
            ->setTranslatableLocale("en")
            ->setName("Vadim Livshyts")
            ->setPosition("Managing Partner")
            ->setEducation("EMBA (Lancaster University, UK)")
            ->setDegree("PhD")
        ;

        $manager->persist($staff_1);
        $manager->flush();

        // ---

        $staff_2 = (new Staff)
            ->addService($this->getReference("service_commercial"))
            ->addService($this->getReference("service_residential"))
            ->setName("Тетяна Кліменчук")
            ->setPosition("Голова департаменту агентських послуг")
            ->setPhone("+38 (050) 353 7100")
            ->setEmail("t.klimenchuk@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_2);
        $manager->flush();

        $staff_2
            ->setTranslatableLocale("en")
            ->setName("Tatiana Klimenchuk")
            ->setPosition("Head of Agency services department")
        ;

        $manager->persist($staff_2);
        $manager->flush();

        // ---

        $staff_3 = (new Staff)
            ->addService($this->getReference("service_commercial"))
            ->addService($this->getReference("service_residential"))
            ->setName("Яна Борисова")
            ->setPosition("Консультант департаменту агентських послуг")
            ->setPhone("+38 (050) 332 5838")
            ->setEmail("y.borisova@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_3);
        $manager->flush();

        $staff_3
            ->setTranslatableLocale("en")
            ->setName("Yana Borisova")
            ->setPosition("Consultant of Agency services department ")
        ;

        $manager->persist($staff_3);
        $manager->flush();

        // ---

        $staff_4 = (new Staff)
            ->addService($this->getReference("service_valuation"))
            ->setName("Ірина Трунова")
            ->setPosition("Провідний спеціаліст департаменту оцінки та ринкових досліджень")
            ->setPhone("+38 (050) 356 40 01")
            ->setEmail("i.trunova@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_4);
        $manager->flush();

        $staff_4
            ->setTranslatableLocale("en")
            ->setName("Iryna Trunova")
            ->setPosition("Leading specialist of Valuation&Research Department")
        ;

        $manager->persist($staff_4);
        $manager->flush();

        // ---

        $staff_5 = (new Staff)
            ->addService($this->getReference("service_valuation"))
            ->setName("Марина Кравченко")
            ->setPosition("Консультант департаменту оцінки та ринкових досліджень")
            ->setPhone("+38 (050) 438 2525")
            ->setEmail("m.kravchenko@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_5);
        $manager->flush();

        $staff_5
            ->setTranslatableLocale("en")
            ->setName("Marina Kravchenko")
            ->setPosition("Consultant of Valuation&Research Department")
        ;

        $manager->persist($staff_5);
        $manager->flush();

        // ---

        $staff_6 = (new Staff)
            ->addService($this->getReference("service_management"))
            ->setName("Зураб Мелуа")
            ->setPosition("Провідний спеціаліст з експлуатації нерухомості")
            ->setPhone("+38 (050) 356 4177")
            ->setEmail("z.melua@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_6);
        $manager->flush();

        $staff_6
            ->setTranslatableLocale("en")
            ->setName("Zurab Melua")
            ->setPosition("Leading Facility management specialist")
        ;

        $manager->persist($staff_6);
        $manager->flush();

        // ---

        $staff_7 = (new Staff)
            ->addService($this->getReference("service_management"))
            ->setName("Олена Медведєва")
            ->setPosition("Спеціаліст з експлуатації нерухомості")
            ->setPhone("+38 (050) 483 30 30")
            ->setEmail("e.medvedeva@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_7);
        $manager->flush();

        $staff_7
            ->setTranslatableLocale("en")
            ->setName("Olena Medvedeva")
            ->setPosition("Facility Management specialist")
        ;

        $manager->persist($staff_7);
        $manager->flush();

        // ---

        $staff_8 = (new Staff)
            ->addService($this->getReference("service_management"))
            ->setName("Наталія Лобур")
            ->setPosition("Адміністратор департаменту експлуатації нерухомості")
            ->setPhone("+38 (050) 446 82 27")
            ->setEmail("n.lobur@frbrokerage.net")
            ->setPhotoName("...")
        ;

        $manager->persist($staff_8);
        $manager->flush();

        $staff_8
            ->setTranslatableLocale("en")
            ->setName("Nataliia Lobur")
            ->setPosition("FM department administrator")
        ;

        $manager->persist($staff_8);
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
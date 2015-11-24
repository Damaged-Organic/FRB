<?php
// src/AppBundle/DataFixtures/ORM/LoadRelocationStep.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\RelocationStep;

class LoadRelocationStep extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $relocation_step_1 = (new RelocationStep)
                ->setIcon("icon-documents")
                ->setTitle("Базова організація поїздки")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_1
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_2 = (new RelocationStep)
                ->setIcon("icon-passport")
                ->setTitle("Переміщення через кордон")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_2
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_3 = (new RelocationStep)
                ->setIcon("icon-certificate")
                ->setTitle("Імміграційні послуги")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_3
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_4 = (new RelocationStep)
                ->setIcon("icon-library")
                ->setTitle("Ознайомчий тур та поселення")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_4
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_5 = (new RelocationStep)
                ->setIcon("icon-house")
                ->setTitle("Пошук квартир та домів для довгострокової оренди")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_5
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_6 = (new RelocationStep)
                ->setIcon("icon-support")
                ->setTitle("Підтримка на протязі терміну оренди житла")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_6
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();

        // ---

        $manager->persist
        (
            $relocation_step_7 = (new RelocationStep)
                ->setIcon("icon-departure")
                ->setTitle("Підтримка при виїзді")
        );
        $manager->flush();

        $manager->persist
        (
            $relocation_step_7
                ->setTranslatableLocale("en")
                ->setTitle("")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
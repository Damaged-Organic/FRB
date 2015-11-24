<?php
// src/AppBundle/DataFixtures/ORM/LoadResearchCategory.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\ResearchCategory;

class LoadResearchCategory extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $research_category_1 = (new ResearchCategory)
                ->setTitle("Огляд ринку офісної нерухомості")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_1
                ->setTranslatableLocale('en')
                ->setDescription("")
                ->setTitle("")
        );
        $manager->flush();

        $this->addReference('research_category_1', $research_category_1);

        // ---

        $manager->persist
        (
            $research_category_2 = (new ResearchCategory)
                ->setTitle("Огляд ринку торгівельної нерухомості")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_2
                ->setTranslatableLocale('en')
                ->setTitle("")
                ->setDescription("")
        );
        $manager->flush();

        $this->addReference('research_category_2', $research_category_2);

        // ---

        $manager->persist
        (
            $research_category_3 = (new ResearchCategory)
                ->setTitle("Огляд ринку складської нерухомості")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_3
                ->setTranslatableLocale('en')
                ->setTitle("")
                ->setDescription("")
        );
        $manager->flush();

        $this->addReference('research_category_3', $research_category_3);

        // ---

        $manager->persist
        (
            $research_category_4 = (new ResearchCategory)
                ->setTitle("Огляд ринку готельної нерухомості")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_4
                ->setTranslatableLocale('en')
                ->setTitle("")
                ->setDescription("")
        );
        $manager->flush();

        $this->addReference('research_category_4', $research_category_4);

        // ---

        $manager->persist
        (
            $research_category_5 = (new ResearchCategory)
                ->setTitle("Огляд ринку житлової нерухомості")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_5
                ->setTranslatableLocale('en')
                ->setTitle("")
                ->setDescription("")
        );
        $manager->flush();

        $this->addReference('research_category_5', $research_category_5);

        // ---

        $manager->persist
        (
            $research_category_6 = (new ResearchCategory)
                ->setTitle("Ринок нерухомості України")
                ->setDescription("")
                ->setPhotoName("")
        );
        $manager->flush();

        $manager->persist
        (
            $research_category_6
                ->setTranslatableLocale('en')
                ->setTitle("")
                ->setDescription("")
        );
        $manager->flush();

        $this->addReference('research_category_6', $research_category_6);
    }

    public function getOrder()
    {
        return 1;
    }
}
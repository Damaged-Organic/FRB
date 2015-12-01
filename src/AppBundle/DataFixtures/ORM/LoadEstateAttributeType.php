<?php
// src/AppBundle/DataFixtures/ORM/LoadEstateAttributeType.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\EstateAttributeType;

class LoadEstateAttributeType extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estateAttributeType_1 = (new EstateAttributeType)
            ->setIcon("icon-floors")
            ->setTitle("Кількість поверхів")
            ->setPostfix("floors")
        ;

        $manager->persist($estateAttributeType_1);
        $manager->flush();

        $estateAttributeType_1
            ->setTranslatableLocale("en")
            ->setTitle("Number of floors")
        ;

        $manager->persist($estateAttributeType_1);
        $manager->flush();

        $this->addReference('number_floors', $estateAttributeType_1);

        // ---

        $estateAttributeType_2 = (new EstateAttributeType)
            ->setIcon("icon-rooms")
            ->setTitle("Кількість кімнат")
            ->setPostfix("room")
        ;

        $manager->persist($estateAttributeType_2);
        $manager->flush();

        $estateAttributeType_2
            ->setTranslatableLocale("en")
            ->setTitle("Number of rooms")
        ;

        $manager->persist($estateAttributeType_2);
        $manager->flush();

        $this->addReference('number_rooms', $estateAttributeType_2);

        // ---

        $estateAttributeType_3 = (new EstateAttributeType)
            ->setIcon("icon-bathroom")
            ->setTitle("Кількість санвузлів")
            ->setPostfix("bathroom")
        ;

        $manager->persist($estateAttributeType_3);
        $manager->flush();

        $estateAttributeType_3
            ->setTranslatableLocale("en")
            ->setTitle("Number of bathrooms")
        ;

        $manager->persist($estateAttributeType_3);
        $manager->flush();

        $this->addReference('number_bathrooms', $estateAttributeType_3);

        // ---

        $estateAttributeType_4 = (new EstateAttributeType)
            ->setIcon("icon-bedroom")
            ->setTitle("Кількість спальних кімнат")
            ->setPostfix("bedroom")
        ;

        $manager->persist($estateAttributeType_4);
        $manager->flush();

        $estateAttributeType_4
            ->setTranslatableLocale("en")
            ->setTitle("Number of bedrooms")
        ;

        $manager->persist($estateAttributeType_4);
        $manager->flush();

        $this->addReference('number_bedrooms', $estateAttributeType_4);

        // ---

        $estateAttributeType_5 = (new EstateAttributeType)
            ->setIcon("icon-floor")
            ->setTitle("Поверх")
            ->setPostfix("floor")
        ;

        $manager->persist($estateAttributeType_5);
        $manager->flush();

        $estateAttributeType_5
            ->setTranslatableLocale("en")
            ->setTitle("Floor")
        ;

        $manager->persist($estateAttributeType_5);
        $manager->flush();

        $this->addReference('floor', $estateAttributeType_5);

        // ---

        $estateAttributeType_6 = (new EstateAttributeType)
            ->setIcon("icon-building")
            ->setTitle("Клас будівлі")
            ->setPostfix("class")
        ;

        $manager->persist($estateAttributeType_6);
        $manager->flush();

        $estateAttributeType_6
            ->setTranslatableLocale("en")
            ->setTitle("Building class")
        ;

        $manager->persist($estateAttributeType_6);
        $manager->flush();

        $this->addReference('building_class', $estateAttributeType_6);

        // ---

        $estateAttributeType_7 = (new EstateAttributeType)
            ->setIcon("icon-cash")
            ->setTitle("Експлуатаційні витрати")
            ->setPostfix(NULL)
        ;

        $manager->persist($estateAttributeType_7);
        $manager->flush();

        $estateAttributeType_7
            ->setTranslatableLocale("en")
            ->setTitle("Running cost")
        ;

        $manager->persist($estateAttributeType_7);
        $manager->flush();

        $this->addReference('running_cost', $estateAttributeType_7);

        // ---

        $estateAttributeType_8 = (new EstateAttributeType)
            ->setIcon("icon-plan")
            ->setTitle("Тип планування")
            ->setPostfix(NULL)
        ;

        $manager->persist($estateAttributeType_8);
        $manager->flush();

        $estateAttributeType_8
            ->setTranslatableLocale("en")
            ->setTitle("Layout type")
        ;

        $manager->persist($estateAttributeType_8);
        $manager->flush();

        $this->addReference('layout_type', $estateAttributeType_8);

        // ---

        $estateAttributeType_9 = (new EstateAttributeType)
            ->setIcon("icon-wall")
            ->setTitle("Тип оздоблення")
            ->setPostfix(NULL)
        ;

        $manager->persist($estateAttributeType_9);
        $manager->flush();

        $estateAttributeType_9
            ->setTranslatableLocale("en")
            ->setTitle("Decoration type")
        ;

        $manager->persist($estateAttributeType_9);
        $manager->flush();

        $this->addReference('decoration_type', $estateAttributeType_9);

        // ---
    }

    public function getOrder()
    {
        return 1;
    }
}
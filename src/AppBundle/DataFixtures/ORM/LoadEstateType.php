<?php
// src/AppBundle/DataFixtures/ORM/LoadEstateType.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\EstateType;

class LoadEstateType extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $estateType_1 = (new EstateType)
            ->setStringId("residential")
            ->setTitle("Житлова нерухомість")
        ;

        $manager->persist($estateType_1);
        $manager->flush();

        $estateType_1
            ->setTranslatableLocale("en")
            ->setTitle("Residential real estate")
        ;

        $manager->persist($estateType_1);
        $manager->flush();

        $this->addReference('residential', $estateType_1);

        // ---

        $estateType_2 = (new EstateType)
            ->setStringId("commercial")
            ->setTitle("Комерційна нерухомість")
        ;

        $manager->persist($estateType_2);
        $manager->flush();

        $estateType_2
            ->setTranslatableLocale("en")
            ->setTitle("Commercial real estate")
        ;

        $manager->persist($estateType_2);
        $manager->flush();

        $this->addReference('commercial', $estateType_2);

        // ---

        $estateType_1_1 = (new EstateType)
            ->setParent($this->getReference('residential'))
            ->setStringId("apartment")
            ->setTitle("Квартири")
        ;

        $manager->persist($estateType_1_1);
        $manager->flush();

        $estateType_1_1
            ->setTranslatableLocale("en")
            ->setTitle("Apartments")
        ;

        $manager->persist($estateType_1_1);
        $manager->flush();

        // ---

        $estateType_1_2 = (new EstateType)
            ->setParent($this->getReference('residential'))
            ->setStringId("house")
            ->setTitle("Будинки")
        ;

        $manager->persist($estateType_1_2);
        $manager->flush();

        $estateType_1_2
            ->setTranslatableLocale("en")
            ->setTitle("Houses")
        ;

        $manager->persist($estateType_1_2);
        $manager->flush();

        // ---

        $estateType_2_1 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("office")
            ->setTitle("Офісні приміщення")
        ;

        $manager->persist($estateType_2_1);
        $manager->flush();

        $estateType_2_1
            ->setTranslatableLocale("en")
            ->setTitle("Offices")
        ;

        $manager->persist($estateType_2_1);
        $manager->flush();

        // ---

        $estateType_2_2 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("retail")
            ->setTitle("Торгові приміщення")
        ;

        $manager->persist($estateType_2_2);
        $manager->flush();

        $estateType_2_2
            ->setTranslatableLocale("en")
            ->setTitle("Retail")
        ;

        $manager->persist($estateType_2_2);
        $manager->flush();

        // ---

        $estateType_2_3 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("warehouse")
            ->setTitle("Складські приміщення")
        ;

        $manager->persist($estateType_2_3);
        $manager->flush();

        $estateType_2_3
            ->setTranslatableLocale("en")
            ->setTitle("Warehouses")
        ;

        $manager->persist($estateType_2_3);
        $manager->flush();

        // ---

        $estateType_2_4 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("buildings")
            ->setTitle("Будівлі")
        ;

        $manager->persist($estateType_2_4);
        $manager->flush();

        $estateType_2_4
            ->setTranslatableLocale("en")
            ->setTitle("Buildings")
        ;

        $manager->persist($estateType_2_4);
        $manager->flush();

        // ---

        $estateType_2_5 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("premises")
            ->setTitle("Інші приміщення")
        ;

        $manager->persist($estateType_2_5);
        $manager->flush();

        $estateType_2_5
            ->setTranslatableLocale("en")
            ->setTitle("Other premises")
        ;

        $manager->persist($estateType_2_5);
        $manager->flush();

        // ---

        $estateType_2_6 = (new EstateType)
            ->setParent($this->getReference('commercial'))
            ->setStringId("allotment")
            ->setTitle("Земельна ділянка")
        ;

        $manager->persist($estateType_2_6);
        $manager->flush();

        $estateType_2_6
            ->setTranslatableLocale("en")
            ->setTitle("Allotment")
        ;

        $manager->persist($estateType_2_6);
        $manager->flush();

        // ---
    }

    public function getOrder()
    {
        return 1;
    }
}

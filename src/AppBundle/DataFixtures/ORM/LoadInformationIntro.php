<?php
// src/AppBundle/DataFixtures/ORM/LoadInformationIntro.php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture,
    Doctrine\Common\DataFixtures\OrderedFixtureInterface,
    Doctrine\Common\Persistence\ObjectManager;

use AppBundle\Entity\InformationIntro;

class LoadInformationIntro extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $manager->persist
        (
            $informationIntro = (new InformationIntro)
                ->setTitle("Інформація для експатів")
                ->setText("Ми, можливо, не плануємо змінювати місце проживання, але життя завжди рухається та переносе нас в нові місця... Так, після переїзду до Києва, перші кілька днів можуть бути цікавими, розчаровувати, чи все відразу. Бажаючи Вам приємного відпочинку в Києві, ми склали перелік порад, які допоможуть вам адаптуватися до життя в новому місті. У цьому розділі Ви можете знайти корисну інформацію про міжнародних співтовариства, охорону здоров'я, розваги та інші важливі питання для експатріантів в Києві.")
        );
        $manager->flush();

        $manager->persist
        (
            $informationIntro
                ->setTranslatableLocale("en")
                ->setTitle("Information for expats")
                ->setText("We might not be relocating, but life is always on the move, taking us to new places… So, after moving to Kiev, the first few days can be exciting, frustrating and overwhelming, all at once. Wishing You a comfortable stay in Kiev, we have compiled a list of tips to help You to adapt to living in a new city. In this section You could find a useful information about international communities, health care, entertainment and other significant issues for expatriates in Kiev.")
        );
        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }
}

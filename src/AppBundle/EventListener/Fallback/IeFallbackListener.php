<?php
// AppBundle/EventListener/Fallback/IeFallbackListener.php
namespace AppBundle\EventListener\Fallback;

use DateTime;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

use AppBundle\Entity\ConversionTime;

class IeFallbackListener
{
    private $_ieFallbackController;
    private $_manager;
    private $_currencyConverter;

    public function setIeFallbackController($ieFallbackController)
    {
        $this->_ieFallbackController = $ieFallbackController;
    }

    public function setManager($manager)
    {
        $this->_manager = $manager;
    }

    public function setCurrencyConverter($currencyConverter)
    {
        $this->_currencyConverter = $currencyConverter;
    }

    public function onKernelRequest($event)
    {
        if( $event->isMasterRequest() )
        {
            if( preg_match('/(?i)msie [5-8]/',$_SERVER['HTTP_USER_AGENT']) )
                $event->setResponse($this->_ieFallbackController->ieFallbackAction());

            # BIG FAT KLUDGE
            $conversionTime = $this->_manager->getRepository('AppBundle:ConversionTime')->findOneBy([], [], 1);

            if( $conversionTime )
            {
                if( !$conversionTime->getLastConversionTime() || ($conversionTime->getLastConversionTime() < (new DateTime('now'))->modify('midnight')) )
                {
                    $estates = $this->_manager->getRepository('AppBundle:Estate')->findAll();

                    foreach( $estates as $estate )
                    {
                        if( $estate->getPriceUSD() )
                        {
                            if( ($priceUAH = $this->_currencyConverter->USD_UAH()->convert($estate->getPriceUSD())) )
                            {
                                $estate->setPriceUAH($priceUAH);
                            }
                        }

                        if( $estate->getPricePerSquareUSD() )
                        {
                            if( ($priceUAH = $this->_currencyConverter->USD_UAH()->convert($estate->getPricePerSquareUSD())) )
                            {
                                $estate->setPricePerSquareUAH($priceUAH);
                            }
                        }

                        $this->_manager->persist($estate);
                    }

                    $conversionTime->setLastConversionTime((new DateTime('now')));
                    $this->_manager->persist($conversionTime);

                    $this->_manager->flush();
                }
            } else {
                $this->_manager->persist(
                    (new ConversionTime())->setLastConversionTime((new DateTime('now')))
                );

                $this->_manager->flush();
            }

            # KLUDGES NEVER END
        }
    }
}

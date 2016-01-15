<?php
// src/AppBundle/Entity/ConversionTime.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="conversion_time")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ConversionTimeRepository")
 */
class ConversionTime
{
    use IdMapper;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    protected $lastConversionTime;

    /**
     * Set lastConversionTime
     *
     * @param \DateTime $lastConversionTime
     * @return ConversionTime
     */
    public function setLastConversionTime($lastConversionTime)
    {
        $this->lastConversionTime = $lastConversionTime;

        return $this;
    }

    /**
     * Get lastConversionTime
     *
     * @return \DateTime 
     */
    public function getLastConversionTime()
    {
        return $this->lastConversionTime;
    }
}

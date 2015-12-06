<?php
// src/AppBundle/Entity/EstateFeatures.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Table(name="estate_features")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateFeaturesRepository")
 */
class EstateFeatures
{
    use IdMapper;

    /**
     * @ORM\OneToOne(targetEntity="Estate", inversedBy="estateFeatures")
     * @ORM\JoinColumn(name="estate_id", referencedColumnName="id")
     */
    protected $estate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $isCashless;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $isNewBuilding;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasElevator;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasParking;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasFurniture;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasRegistration;

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->id ) ? $this->id : "";
    }

    /**
     * Set isCashless
     *
     * @param boolean $isCashless
     * @return EstateFeatures
     */
    public function setIsCashless($isCashless)
    {
        $this->isCashless = $isCashless;

        return $this;
    }

    /**
     * Get isCashless
     *
     * @return boolean
     */
    public function getIsCashless()
    {
        return $this->isCashless;
    }

    /**
     * Set isNewBuilding
     *
     * @param boolean $isNewBuilding
     * @return EstateFeatures
     */
    public function setIsNewBuilding($isNewBuilding)
    {
        $this->isNewBuilding = $isNewBuilding;

        return $this;
    }

    /**
     * Get isNewBuilding
     *
     * @return boolean
     */
    public function getIsNewBuilding()
    {
        return $this->isNewBuilding;
    }

    /**
     * Set hasElevator
     *
     * @param boolean $hasElevator
     * @return EstateFeatures
     */
    public function setHasElevator($hasElevator)
    {
        $this->hasElevator = $hasElevator;

        return $this;
    }

    /**
     * Get hasElevator
     *
     * @return boolean
     */
    public function getHasElevator()
    {
        return $this->hasElevator;
    }

    /**
     * Set hasParking
     *
     * @param boolean $hasParking
     * @return EstateFeatures
     */
    public function setHasParking($hasParking)
    {
        $this->hasParking = $hasParking;

        return $this;
    }

    /**
     * Get hasParking
     *
     * @return boolean
     */
    public function getHasParking()
    {
        return $this->hasParking;
    }

    /**
     * Set hasFurniture
     *
     * @param boolean $hasFurniture
     * @return EstateFeatures
     */
    public function setHasFurniture($hasFurniture)
    {
        $this->hasFurniture = $hasFurniture;

        return $this;
    }

    /**
     * Get hasFurniture
     *
     * @return boolean
     */
    public function getHasFurniture()
    {
        return $this->hasFurniture;
    }

    /**
     * Set hasRegistration
     *
     * @param boolean $hasRegistration
     * @return EstateFeatures
     */
    public function setHasRegistration($hasRegistration)
    {
        $this->hasRegistration = $hasRegistration;

        return $this;
    }

    /**
     * Get hasRegistration
     *
     * @return boolean
     */
    public function getHasRegistration()
    {
        return $this->hasRegistration;
    }

    /**
     * Set estate
     *
     * @param \AppBundle\Entity\Estate $estate
     * @return EstateFeatures
     */
    public function setEstate(\AppBundle\Entity\Estate $estate = null)
    {
        $this->estate = $estate;

        return $this;
    }

    /**
     * Get estate
     *
     * @return \AppBundle\Entity\Estate
     */
    public function getEstate()
    {
        return $this->estate;
    }

    public function getFeatureByName($featureName)
    {
        if( !in_array($featureName, self::getEstateFeatures(), TRUE) )
            return NULL;

        // Warning! Getting variable value by another string variable
        return $this->{$featureName};
    }

    static public function getEstateFeatures()
    {
        return [
            'isCashless',
            'isNewBuilding',
            'hasElevator',
            'hasParking',
            'hasFurniture',
            'hasRegistration'
        ];
    }
}

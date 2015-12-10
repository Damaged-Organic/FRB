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
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $ownerPhysical;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $ownerLegal;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasSecurity;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasUtility;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasCommunications;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasHeatingSystem;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasPool;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $isRenovated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasGarage;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $isOperational;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $isJustRenovated;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     **/
    protected $hasBalcony;

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
     * Set ownerPhysical
     *
     * @param boolean $ownerPhysical
     * @return EstateFeatures
     */
    public function setOwnerPhysical($ownerPhysical)
    {
        $this->ownerPhysical = $ownerPhysical;

        return $this;
    }

    /**
     * Get ownerPhysical
     *
     * @return boolean
     */
    public function getOwnerPhysical()
    {
        return $this->ownerPhysical;
    }

    /**
     * Set ownerLegal
     *
     * @param boolean $ownerLegal
     * @return EstateFeatures
     */
    public function setOwnerLegal($ownerLegal)
    {
        $this->ownerLegal = $ownerLegal;

        return $this;
    }

    /**
     * Get ownerLegal
     *
     * @return boolean
     */
    public function getOwnerLegal()
    {
        return $this->ownerLegal;
    }

    /**
     * Set hasSecurity
     *
     * @param boolean $hasSecurity
     * @return EstateFeatures
     */
    public function setHasSecurity($hasSecurity)
    {
        $this->hasSecurity = $hasSecurity;

        return $this;
    }

    /**
     * Get hasSecurity
     *
     * @return boolean
     */
    public function getHasSecurity()
    {
        return $this->hasSecurity;
    }

    /**
     * Set hasUtility
     *
     * @param boolean $hasUtility
     * @return EstateFeatures
     */
    public function setHasUtility($hasUtility)
    {
        $this->hasUtility = $hasUtility;

        return $this;
    }

    /**
     * Get hasUtility
     *
     * @return boolean
     */
    public function getHasUtility()
    {
        return $this->hasUtility;
    }

    /**
     * Set hasCommunications
     *
     * @param boolean $hasCommunications
     * @return EstateFeatures
     */
    public function setHasCommunications($hasCommunications)
    {
        $this->hasCommunications = $hasCommunications;

        return $this;
    }

    /**
     * Get hasCommunications
     *
     * @return boolean
     */
    public function getHasCommunications()
    {
        return $this->hasCommunications;
    }

    /**
     * Set hasHeatingSystem
     *
     * @param boolean $hasHeatingSystem
     * @return EstateFeatures
     */
    public function setHasHeatingSystem($hasHeatingSystem)
    {
        $this->hasHeatingSystem = $hasHeatingSystem;

        return $this;
    }

    /**
     * Get hasHeatingSystem
     *
     * @return boolean
     */
    public function getHasHeatingSystem()
    {
        return $this->hasHeatingSystem;
    }

    /**
     * Set hasPool
     *
     * @param boolean $hasPool
     * @return EstateFeatures
     */
    public function setHasPool($hasPool)
    {
        $this->hasPool = $hasPool;

        return $this;
    }

    /**
     * Get hasPool
     *
     * @return boolean
     */
    public function getHasPool()
    {
        return $this->hasPool;
    }

    /**
     * Set isRenovated
     *
     * @param boolean $isRenovated
     * @return EstateFeatures
     */
    public function setIsRenovated($isRenovated)
    {
        $this->isRenovated = $isRenovated;

        return $this;
    }

    /**
     * Get isRenovated
     *
     * @return boolean
     */
    public function getIsRenovated()
    {
        return $this->isRenovated;
    }

    /**
     * Set hasGarage
     *
     * @param boolean $hasGarage
     * @return EstateFeatures
     */
    public function setHasGarage($hasGarage)
    {
        $this->hasGarage = $hasGarage;

        return $this;
    }

    /**
     * Get hasGarage
     *
     * @return boolean
     */
    public function getHasGarage()
    {
        return $this->hasGarage;
    }

    /**
     * Set isOperational
     *
     * @param boolean $isOperational
     * @return EstateFeatures
     */
    public function setIsOperational($isOperational)
    {
        $this->isOperational = $isOperational;

        return $this;
    }

    /**
     * Get isOperational
     *
     * @return boolean
     */
    public function getIsOperational()
    {
        return $this->isOperational;
    }

    /**
     * Set isJustRenovated
     *
     * @param boolean $isJustRenovated
     * @return EstateFeatures
     */
    public function setIsJustRenovated($isJustRenovated)
    {
        $this->isJustRenovated = $isJustRenovated;

        return $this;
    }

    /**
     * Get isJustRenovated
     *
     * @return boolean
     */
    public function getIsJustRenovated()
    {
        return $this->isJustRenovated;
    }

    /**
     * Set hasBalcony
     *
     * @param boolean $hasBalcony
     * @return EstateFeatures
     */
    public function setHasBalcony($hasBalcony)
    {
        $this->hasBalcony = $hasBalcony;

        return $this;
    }

    /**
     * Get hasBalcony
     *
     * @return boolean
     */
    public function getHasBalcony()
    {
        return $this->hasBalcony;
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

    public function getFeatureByName($featureName, $isCatalogItem = FALSE)
    {
        if( !in_array($featureName, self::getEstateFeatures($isCatalogItem), TRUE) )
            return NULL;

        // Warning! Getting variable value by another string variable
        return $this->{$featureName};
    }

    static public function getEstateFeatures($isCatalogItem = FALSE)
    {
        return ( $isCatalogItem )
            ? [
                'isCashless',
                'isNewBuilding',
                'hasElevator',
                'hasParking',
                'hasFurniture',
                'hasRegistration',
                'ownerPhysical',
                'ownerLegal',
                'hasSecurity',
                'hasUtility',
                'hasCommunications',
                'hasHeatingSystem',
                'hasPool',
                'isRenovated',
                'hasGarage',
                'isOperational',
                'isJustRenovated',
                'hasBalcony',
            ]
            : [
                'isNewBuilding',
                'hasFurniture',
                'hasRegistration',
                'isRenovated',
                'hasGarage',
                'isOperational',
            ]
        ;
    }
}

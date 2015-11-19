<?php
// src/AppBundle/Entity/Estate.php
namespace AppBundle\Entity;

use InvalidArgumentException;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper,
    AppBundle\Entity\Utility\DoctrineMapping\SlugMapper,
    AppBundle\Entity\Utility\TradeTypesListInterface,
    AppBundle\Entity\Utility\DistrictsListInterface;

/**
 * @ORM\Table(name="estate")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\EstateTranslation")
 */
class Estate implements Translatable, TradeTypesListInterface, DistrictsListInterface
{
    use IdMapper, TranslationMapper, SlugMapper;

    /**
     * @ORM\OneToMany(targetEntity="EstateTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="EstatePhoto", mappedBy="estate", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $estatePhoto;

    /**
     * @ORM\ManyToOne(targetEntity="EstateType", inversedBy="estate")
     * @ORM\JoinColumn(name="estate_type_id", referencedColumnName="id")
     **/
    protected $estateType;

    /**
     * @ORM\OneToMany(targetEntity="EstateAttribute", mappedBy="estate", cascade={"persist", "remove"})
     **/
    protected $estateAttribute;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     **/
    protected $tradeType;

    /**
     * @ORM\Column(type="string", length=12, nullable=false)
     **/
    protected $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $address;

    /**
     * @ORM\Column(type="string", length=15, nullable=false)
     */
    protected $district;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $descriptionFormatter;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     **/
    protected $space;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     **/
    protected $price;

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
     * @ORM\Column(type="string", length=20, nullable=false)
     **/
    protected $latitude;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     **/
    protected $longitude;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /**
     * Get tradeTypes
     *
     * @return array
     */
    static public function getTradeTypes()
    {
        return [
            self::TRADE_TYPE_RENT => "rent",
            self::TRADE_TYPE_SALE => "sale"
        ];
    }

    /**
     * Get districts
     *
     * @return array
     */
    static public function getDistricts()
    {
        return [
            self::DISTRICT_HO => "holosiivskyi",
            self::DISTRICT_DA => "darnytskyi",
            self::DISTRICT_DE => "desnianskyi",
            self::DISTRICT_DN => "dniprovskyi",
            self::DISTRICT_OB => "obolonskyi",
            self::DISTRICT_PE => "pecherskyi",
            self::DISTRICT_PO => "podilskyi",
            self::DISTRICT_SV => "sviatoshynskyi",
            self::DISTRICT_SO => "solomianskyi",
            self::DISTRICT_SH => "shevchenkivskyi",
            self::DISTRICT_KO => "kiev_oblast",
            self::DISTRICT_OTHER => "other"
        ];
    }

    /**
     * Set tradeType
     *
     * @param boolean $tradeType
     * @return Estate
     */
    public function setTradeType($tradeType)
    {
        if( !in_array($tradeType, array_keys(self::getTradeTypes())) )
            throw new InvalidArgumentException("Wrong tradeType parameter");

        $this->tradeType = $tradeType;

        return $this;
    }

    /**
     * Get tradeType
     *
     * @return boolean 
     */
    public function getTradeType()
    {
        return $this->tradeType;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return Estate
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Estate
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Estate
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rawDescription
     *
     * @param string $rawDescription
     * @return Estate
     */
    public function setRawDescription($rawDescription)
    {
        $this->rawDescription = $rawDescription;

        return $this;
    }

    /**
     * Get rawDescription
     *
     * @return string 
     */
    public function getRawDescription()
    {
        return $this->rawDescription;
    }

    /**
     * Set descriptionFormatter
     *
     * @param string $descriptionFormatter
     * @return Estate
     */
    public function setDescriptionFormatter($descriptionFormatter)
    {
        $this->descriptionFormatter = $descriptionFormatter;

        return $this;
    }

    /**
     * Get descriptionFormatter
     *
     * @return string 
     */
    public function getDescriptionFormatter()
    {
        return $this->descriptionFormatter;
    }

    /**
     * Set district
     *
     * @param string $district
     * @return Estate
     */
    public function setDistrict($district)
    {
        $this->district = $district;

        return $this;
    }

    /**
     * Get district
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * Set space
     *
     * @param string $space
     * @return Estate
     */
    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Get space
     *
     * @return string 
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Estate
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Add estatePhoto
     *
     * @param \AppBundle\Entity\EstatePhoto $estatePhoto
     * @return Estate
     */
    public function addEstatePhoto(\AppBundle\Entity\EstatePhoto $estatePhoto)
    {
        $estatePhoto->setEstate($this);
        $this->estatePhoto[] = $estatePhoto;

        return $this;
    }

    /**
     * Remove estatePhoto
     *
     * @param \AppBundle\Entity\EstatePhoto $estatePhoto
     */
    public function removeEstatePhoto(\AppBundle\Entity\EstatePhoto $estatePhoto)
    {
        $this->estatePhoto->removeElement($estatePhoto);
    }

    /**
     * Get estatePhoto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstatePhoto()
    {
        return $this->estatePhoto;
    }

    /**
     * Set estateType
     *
     * @param \AppBundle\Entity\EstateType $estateType
     * @return Estate
     */
    public function setEstateType(\AppBundle\Entity\EstateType $estateType = null)
    {
        $this->estateType = $estateType;

        return $this;
    }

    /**
     * Get estateType
     *
     * @return \AppBundle\Entity\EstateType 
     */
    public function getEstateType()
    {
        return $this->estateType;
    }

    /**
     * Add estateAttribute
     *
     * @param \AppBundle\Entity\EstateAttribute $estateAttribute
     * @return Estate
     */
    public function addEstateAttribute(\AppBundle\Entity\EstateAttribute $estateAttribute)
    {
        $this->estateAttribute[] = $estateAttribute;

        return $this;
    }

    /**
     * Remove estateAttribute
     *
     * @param \AppBundle\Entity\EstateAttribute $estateAttribute
     */
    public function removeEstateAttribute(\AppBundle\Entity\EstateAttribute $estateAttribute)
    {
        $this->estateAttribute->removeElement($estateAttribute);
    }

    /**
     * Get estateAttribute
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstateAttribute()
    {
        return $this->estateAttribute;
    }

    /**
     * Set isCashless
     *
     * @param boolean $isCashless
     * @return Estate
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
     * @return Estate
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
     * @return Estate
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
     * @return Estate
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
     * @return Estate
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
     * @return Estate
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
     * Set latitude
     *
     * @param string $latitude
     * @return Estate
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return Estate
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Estate
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
}
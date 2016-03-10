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
    AppBundle\Entity\Utility\DistrictsListInterface,
    AppBundle\Entity\Utility\TradeTypesListInterface,
    AppBundle\Entity\Utility\FitOutTypeListInterface,
    AppBundle\Entity\Utility\LayoutTypeListInterface;

/**
 * @ORM\Table(name="estate")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\EstateTranslation")
 */
class Estate implements
    Translatable,
    DistrictsListInterface,
    TradeTypesListInterface,
    FitOutTypeListInterface,
    LayoutTypeListInterface
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="EstateTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="EstatePhoto", mappedBy="estate", cascade={"persist", "remove"}, orphanRemoval=true)
     * @ORM\OrderBy({"position" = "ASC"})
     **/
    protected $estatePhoto;

    /**
     * @ORM\ManyToOne(targetEntity="EstateType", inversedBy="estate")
     * @ORM\JoinColumn(name="estate_type_id", referencedColumnName="id")
     **/
    protected $estateType;

    /**
     * @ORM\OneToMany(targetEntity="EstateAttribute", mappedBy="estate", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $estateAttribute;

    /**
     * @ORM\OneToOne(targetEntity="EstateFeatures", mappedBy="estate", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $estateFeatures;

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
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     **/
    protected $spacePlot;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     **/
    protected $priceUAH;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=false)
     **/
    protected $priceUSD;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     **/
    protected $pricePerSquareUAH;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     **/
    protected $pricePerSquareUSD;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $coordinates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $coordinatesManualLat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $coordinatesManualLng;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations    = new ArrayCollection;
        $this->estateAttribute = new ArrayCollection;
        $this->estatePhoto     = new ArrayCollection;

        $this->isActive = TRUE;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /**
     * Get districts
     *
     * @return array
     */
    static public function getDistricts()
    {
        return [
            self::DISTRICT_HO    => "holosiivskyi",
            self::DISTRICT_DA    => "darnytskyi",
            self::DISTRICT_DE    => "desnianskyi",
            self::DISTRICT_DN    => "dniprovskyi",
            self::DISTRICT_OB    => "obolonskyi",
            self::DISTRICT_PE    => "pecherskyi",
            self::DISTRICT_PO    => "podilskyi",
            self::DISTRICT_SV    => "sviatoshynskyi",
            self::DISTRICT_SO    => "solomianskyi",
            self::DISTRICT_SH    => "shevchenkivskyi",
            self::DISTRICT_KO    => "kiev_oblast",
            self::DISTRICT_OTHER => "other"
        ];
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
     * Get fitOutTypes
     *
     * @return array
     */
    static public function getFitOutTypes()
    {
        return [
            self::FIT_OUT_TYPE_SHELL_AND_CORE => "shell_and_core",
            self::FIT_OUT_TYPE_AFTER_TENANT   => "after_tenant",
            self::FIT_OUT_TYPE_RENOVATED      => "renovated"
        ];
    }

    /**
     * Set fitOutType
     *
     * @param boolean $fitOutType
     * @return Estate
     */
    public function setFitOutType($fitOutType)
    {
        if( !in_array($fitOutType, array_keys(self::getFitOutTypes())) )
            throw new InvalidArgumentException("Wrong fitOutType parameter");

        $this->fitOutType = $fitOutType;

        return $this;
    }

    /**
     * Get fitOutType
     *
     * @return boolean
     */
    public function getFitOutType()
    {
        return $this->fitOutType;
    }

    /**
     * Get layoutTypes
     *
     * @return array
     */
    static public function getLayoutTypes()
    {
        return [
            self::LAYOUT_TYPE_CABINETS   => "cabinets",
            self::LAYOUT_TYPE_OPEN_SPACE => "open_space",
        ];
    }

    /**
     * Set layoutType
     *
     * @param boolean $layoutType
     * @return Estate
     */
    public function setLayoutType($layoutType)
    {
        if( !in_array($layoutType, array_keys(self::getLayoutTypes())) )
            throw new InvalidArgumentException("Wrong layoutType parameter");

        $this->layoutType = $layoutType;

        return $this;
    }

    /**
     * Get layoutType
     *
     * @return boolean
     */
    public function getLayoutType()
    {
        return $this->layoutType;
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
     * Set spacePlot
     *
     * @param string $spacePlot
     * @return Estate
     */
    public function setSpacePlot($spacePlot)
    {
        $this->spacePlot = $spacePlot;

        return $this;
    }

    /**
     * Get spacePlot
     *
     * @return string
     */
    public function getSpacePlot()
    {
        return $this->spacePlot;
    }

    /**
     * Set priceUAH
     *
     * @param string $priceUAH
     * @return Estate
     */
    public function setPriceUAH($priceUAH)
    {
        $this->priceUAH = $priceUAH;

        return $this;
    }

    /**
     * Get priceUAH
     *
     * @return string
     */
    public function getPriceUAH()
    {
        return $this->priceUAH;
    }

    /**
     * Set priceUSD
     *
     * @param string $priceUSD
     * @return Estate
     */
    public function setPriceUSD($priceUSD)
    {
        $this->priceUSD = $priceUSD;

        return $this;
    }

    /**
     * Get priceUSD
     *
     * @return string
     */
    public function getPriceUSD()
    {
        return $this->priceUSD;
    }

    /**
     * Set pricePerSquareUAH
     *
     * @param string $pricePerSquareUAH
     * @return Estate
     */
    public function setPricePerSquareUAH($pricePerSquareUAH)
    {
        $this->pricePerSquareUAH = $pricePerSquareUAH;

        return $this;
    }

    /**
     * Get pricePerSquareUAH
     *
     * @return string
     */
    public function getPricePerSquareUAH()
    {
        return $this->pricePerSquareUAH;
    }

    /**
     * Set pricePerSquareUSD
     *
     * @param string $pricePerSquareUSD
     * @return Estate
     */
    public function setPricePerSquareUSD($pricePerSquareUSD)
    {
        $this->pricePerSquareUSD = $pricePerSquareUSD;

        return $this;
    }

    /**
     * Get pricePerSquareUSD
     *
     * @return string
     */
    public function getPricePerSquareUSD()
    {
        return $this->pricePerSquareUSD;
    }

    /**
     * Set coordinates
     *
     * @param string $coordinates
     * @return Information
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    /**
     * Get coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * Set coordinatesManualLat
     *
     * @param string $coordinatesManualLat
     * @return Estate
     */
    public function setCoordinatesManualLat($coordinatesManualLat)
    {
        $this->coordinatesManualLat = $coordinatesManualLat;

        return $this;
    }

    /**
     * Get coordinatesManualLat
     *
     * @return string
     */
    public function getCoordinatesManualLat()
    {
        return $this->coordinatesManualLat;
    }

    /**
     * Set coordinatesManualLng
     *
     * @param string $coordinatesManualLng
     * @return Estate
     */
    public function setCoordinatesManualLng($coordinatesManualLng)
    {
        $this->coordinatesManualLng = $coordinatesManualLng;

        return $this;
    }

    /**
     * Get coordinatesManualLng
     *
     * @return string
     */
    public function getCoordinatesManualLng()
    {
        return $this->coordinatesManualLng;
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

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Estate
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Add estatePhoto
     *
     * @param \AppBundle\Entity\EstatePhoto $estatePhoto
     * @return Estate
     */
    public function addEstatePhoto(\AppBundle\Entity\EstatePhoto $estatePhoto)
    {
        $estatePhoto
            ->setEstate($this)
            ->setCategory($this->getId()
        );

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
        $estateAttribute->setEstate($this);
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
     * Set estateFeatures
     *
     * @param \AppBundle\Entity\EstateFeatures $estateFeatures
     * @return Estate
     */
    public function setEstateFeatures(\AppBundle\Entity\EstateFeatures $estateFeatures = null)
    {
        if( $estateFeatures instanceof EstateFeatures )
            $estateFeatures->setEstate($this);

        $this->estateFeatures = $estateFeatures;

        return $this;
    }

    /**
     * Get estateFeatures
     *
     * @return \AppBundle\Entity\EstateFeatures
     */
    public function getEstateFeatures()
    {
        return $this->estateFeatures;
    }

    // Setting slug manually due to evil technical assignment

    /**
     * @ORM\Column(length=255, unique=true)
     */
    protected $slug;

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $slug;
    }
}

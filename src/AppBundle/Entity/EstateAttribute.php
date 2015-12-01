<?php
// src/AppBundle/Entity/EstateAttribute.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="estate_attributes")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateAttributeRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\EstateAttributeTranslation")
 */
class EstateAttribute implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="EstateAttributeTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="EstateAttributeType", inversedBy="estateAttribute")
     * @ORM\JoinColumn(name="estate_attribute_type_id", referencedColumnName="id")
     **/
    protected $estateAttributeType;

    /**
     * @ORM\ManyToOne(targetEntity="Estate", inversedBy="estateAttribute")
     * @ORM\JoinColumn(name="estate_id", referencedColumnName="id")
     **/
    protected $estate;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $value;

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
        return ( $this->value ) ? $this->value : "";
    }

    /**
     * Set value
     *
     * @param string $value
     * @return EstateAttribute
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set estateAttributeType
     *
     * @param \AppBundle\Entity\EstateAttributeType $estateAttributeType
     * @return EstateAttribute
     */
    public function setEstateAttributeType(\AppBundle\Entity\EstateAttributeType $estateAttributeType = null)
    {
        $this->estateAttributeType = $estateAttributeType;

        return $this;
    }

    /**
     * Get estateAttributeType
     *
     * @return \AppBundle\Entity\EstateAttributeType 
     */
    public function getEstateAttributeType()
    {
        return $this->estateAttributeType;
    }

    /**
     * Set estate
     *
     * @param \AppBundle\Entity\Estate $estate
     * @return EstateAttribute
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
}
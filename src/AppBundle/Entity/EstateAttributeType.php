<?php
// src/AppBundle/Entity/EstateAttributeType.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="estate_attribute_types")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateAttributeTypeRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\EstateAttributeTypeTranslation")
 */
class EstateAttributeType implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="EstateAttributeTypeTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="EstateAttribute", mappedBy="estateAttributeType", cascade={"persist"}, orphanRemoval=true)
     **/
    protected $estateAttribute;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     **/
    protected $icon;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $postfix;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations    = new ArrayCollection;
        $this->estateAttribute = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EstateAttributeType
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
     * Set icon
     *
     * @param string $icon
     * @return EstateAttributeType
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set postfix
     *
     * @param string $postfix
     * @return EstateAttributeType
     */
    public function setPostfix($postfix)
    {
        $this->postfix = $postfix;

        return $this;
    }

    /**
     * Get postfix
     *
     * @return string
     */
    public function getPostfix()
    {
        return $this->postfix;
    }

    /**
     * Add estateAttribute
     *
     * @param \AppBundle\Entity\EstateAttribute $estateAttribute
     * @return EstateAttributeType
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
}
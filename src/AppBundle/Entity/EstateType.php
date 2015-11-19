<?php
// src/AppBundle/Entity/EstateType.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="estate_types")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\EstateTypeRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\EstateTypeTranslation")
 */
class EstateType implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="EstateTypeTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="Estate", mappedBy="estateType")
     **/
    protected $estate;

    /**
     * @ORM\ManyToOne(targetEntity="EstateType", inversedBy="child")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     **/
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="EstateType", mappedBy="parent")
     **/
    protected $child;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     */
    protected $stringId;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
        $this->child        = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /**
     * Set stringId
     *
     * @param string $stringId
     * @return EstateType
     */
    public function setStringId($stringId)
    {
        $this->stringId = $stringId;

        return $this;
    }

    /**
     * Get stringId
     *
     * @return string 
     */
    public function getStringId()
    {
        return $this->stringId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EstateType
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
     * Add estate
     *
     * @param \AppBundle\Entity\Estate $estate
     * @return EstateType
     */
    public function addEstate(\AppBundle\Entity\Estate $estate)
    {
        $this->estate[] = $estate;

        return $this;
    }

    /**
     * Remove estate
     *
     * @param \AppBundle\Entity\Estate $estate
     */
    public function removeEstate(\AppBundle\Entity\Estate $estate)
    {
        $this->estate->removeElement($estate);
    }

    /**
     * Get estate
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEstate()
    {
        return $this->estate;
    }

    /**
     * Set parent
     *
     * @param \AppBundle\Entity\EstateType $parent
     * @return EstateType
     */
    public function setParent(\AppBundle\Entity\EstateType $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \AppBundle\Entity\EstateType 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add child
     *
     * @param \AppBundle\Entity\EstateType $child
     * @return EstateType
     */
    public function addChild(\AppBundle\Entity\EstateType $child)
    {
        $this->child[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \AppBundle\Entity\EstateType $child
     */
    public function removeChild(\AppBundle\Entity\EstateType $child)
    {
        $this->child->removeElement($child);
    }

    /**
     * Get child
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChild()
    {
        return $this->child;
    }
}
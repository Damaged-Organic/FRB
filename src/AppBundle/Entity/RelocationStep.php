<?php
// src/AppBundle/Entity/RelocationStep.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="relocation_steps")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RelocationStepRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\RelocationStepTranslation")
 */
class RelocationStep implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="RelocationStepTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="RelocationStepItem", mappedBy="relocationStep", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $relocationStepItems;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     **/
    protected $icon;

    /**
     * @ORM\Column(type="string", length=150, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations        = new ArrayCollection;
        $this->relocationStepItems = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : '';
    }

    /**
     * Set icon
     *
     * @param string $icon
     * @return RelocationStep
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
     * Set title
     *
     * @param string $title
     * @return RelocationStep
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
     * Add relocationStepItem
     *
     * @param \AppBundle\Entity\RelocationStepItem $relocationStepItem
     * @return RelocationStep
     */
    public function addRelocationStepItem(\AppBundle\Entity\RelocationStepItem $relocationStepItem)
    {
        $relocationStepItem->setRelocationStep($this);
        $this->relocationStepItems[] = $relocationStepItem;

        return $this;
    }

    /**
     * Remove relocationStepItems
     *
     * @param \AppBundle\Entity\RelocationStepItem $relocationStepItems
     */
    public function removeRelocationStepItem(\AppBundle\Entity\RelocationStepItem $relocationStepItems)
    {
        $this->relocationStepItems->removeElement($relocationStepItems);
    }

    /**
     * Get relocationStepItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRelocationStepItems()
    {
        return $this->relocationStepItems;
    }
}
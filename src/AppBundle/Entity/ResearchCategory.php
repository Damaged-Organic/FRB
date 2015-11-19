<?php
// src/AppBundle/Entity/ResearchCategory.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="researches_categories")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ResearchCategoryRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ResearchCategoryTranslation")
 */
class ResearchCategory implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="ResearchCategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="Research", mappedBy="object", cascade={"persist"})
     */
    protected $research;

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
     * @return ResearchCategory
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
     * Add research
     *
     * @param \AppBundle\Entity\Research $research
     * @return ResearchCategory
     */
    public function addResearch(\AppBundle\Entity\Research $research)
    {
        $this->research[] = $research;

        return $this;
    }

    /**
     * Remove research
     *
     * @param \AppBundle\Entity\Research $research
     */
    public function removeResearch(\AppBundle\Entity\Research $research)
    {
        $this->research->removeElement($research);
    }

    /**
     * Get research
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResearch()
    {
        return $this->research;
    }
}
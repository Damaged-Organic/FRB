<?php
// src/AppBundle/Entity/InformationCategory.php
namespace AppBundle\Entity;

use ReflectionClass;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\InformationCategoriesListInterface,
    AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="information_categories")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InformationCategoryRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\InformationCategoryTranslation")
 */
class InformationCategory implements Translatable, InformationCategoriesListInterface
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="InformationCategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="Information", mappedBy="informationCategory", cascade={"persist"})
     */
    protected $information;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     **/
    protected $alias;

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
        $this->information  = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : '';
    }

    /**
     * Set alias
     *
     * @param string $alias
     * @return InformationCategory
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;

        return $this;
    }

    /**
     * Get alias
     *
     * @return string 
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return InformationCategory
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
     * Add information
     *
     * @param \AppBundle\Entity\Information $information
     * @return InformationCategory
     */
    public function addInformation(\AppBundle\Entity\Information $information)
    {
        $information->setInformationCategory($this);
        $this->information[] = $information;

        return $this;
    }

    /**
     * Remove information
     *
     * @param \AppBundle\Entity\Information $information
     */
    public function removeInformation(\AppBundle\Entity\Information $information)
    {
        $this->information->removeElement($information);
    }

    /**
     * Get information
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getInformation()
    {
        return $this->information;
    }

    static public function getInformationCategories()
    {
        return (new ReflectionClass('AppBundle\Entity\Utility\InformationCategoriesListInterface'))->getConstants();
    }
}
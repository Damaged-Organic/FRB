<?php
// src/AppBundle/Entity/Vacancy.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="vacancies")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VacancyRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\VacancyTranslation")
 */
class Vacancy implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="VacancyTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $requirements;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawRequirements;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $requirementsFormatter;

    /**
     * @ORM\Column(type="text", nullable=true)
     *
     * @Gedmo\Translatable
     **/
    protected $additional;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawAdditional;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $additionalFormatter;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     **/
    protected $isActive;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;

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
     * Set title
     *
     * @param string $title
     * @return Vacancy
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
     * Set requirements
     *
     * @param string $requirements
     * @return Vacancy
     */
    public function setRequirements($requirements)
    {
        $this->requirements = $requirements;

        return $this;
    }

    /**
     * Get requirements
     *
     * @return string 
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Set rawRequirements
     *
     * @param string $rawRequirements
     * @return Vacancy
     */
    public function setRawRequirements($rawRequirements)
    {
        $this->rawRequirements = $rawRequirements;

        return $this;
    }

    /**
     * Get rawRequirements
     *
     * @return string 
     */
    public function getRawRequirements()
    {
        return $this->rawRequirements;
    }

    /**
     * Set requirementsFormatter
     *
     * @param string $requirementsFormatter
     * @return Vacancy
     */
    public function setRequirementsFormatter($requirementsFormatter)
    {
        $this->requirementsFormatter = $requirementsFormatter;

        return $this;
    }

    /**
     * Get requirementsFormatter
     *
     * @return string 
     */
    public function getRequirementsFormatter()
    {
        return $this->requirementsFormatter;
    }

    /**
     * Set additional
     *
     * @param string $additional
     * @return Vacancy
     */
    public function setAdditional($additional)
    {
        $this->additional = $additional;

        return $this;
    }

    /**
     * Get additional
     *
     * @return string 
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Set rawAdditional
     *
     * @param string $rawAdditional
     * @return Vacancy
     */
    public function setRawAdditional($rawAdditional)
    {
        $this->rawAdditional = $rawAdditional;

        return $this;
    }

    /**
     * Get rawAdditional
     *
     * @return string 
     */
    public function getRawAdditional()
    {
        return $this->rawAdditional;
    }

    /**
     * Set additionalFormatter
     *
     * @param string $additionalFormatter
     * @return Vacancy
     */
    public function setAdditionalFormatter($additionalFormatter)
    {
        $this->additionalFormatter = $additionalFormatter;

        return $this;
    }

    /**
     * Get additionalFormatter
     *
     * @return string 
     */
    public function getAdditionalFormatter()
    {
        return $this->additionalFormatter;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Vacancy
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
}
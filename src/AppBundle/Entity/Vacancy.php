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
     * @ORM\OneToMany(targetEntity="VacancyList", mappedBy="vacancyRequirement", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $listRequirements;

    /**
     * @ORM\OneToMany(targetEntity="VacancyList", mappedBy="vacancyTask", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $listTasks;

    /**
     * @ORM\OneToMany(targetEntity="VacancyList", mappedBy="vacancyAdvantage", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $listAdvantages;

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
    protected $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawShortDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $shortDescriptionFormatter;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     **/
    protected $isActive = TRUE;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations     = new ArrayCollection;
        $this->listRequirements = new ArrayCollection;
        $this->listTasks        = new ArrayCollection;
        $this->listAdvantages   = new ArrayCollection;
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
     * Set shortDescription
     *
     * @param string $shortDescription
     * @return Vacancy
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;

        return $this;
    }

    /**
     * Get shortDescription
     *
     * @return string 
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * Set rawShortDescription
     *
     * @param string $rawShortDescription
     * @return Vacancy
     */
    public function setRawShortDescription($rawShortDescription)
    {
        $this->rawShortDescription = $rawShortDescription;

        return $this;
    }

    /**
     * Get rawShortDescription
     *
     * @return string 
     */
    public function getRawShortDescription()
    {
        return $this->rawShortDescription;
    }

    /**
     * Set shortDescriptionFormatter
     *
     * @param string $shortDescriptionFormatter
     * @return Vacancy
     */
    public function setShortDescriptionFormatter($shortDescriptionFormatter)
    {
        $this->shortDescriptionFormatter = $shortDescriptionFormatter;

        return $this;
    }

    /**
     * Get shortDescriptionFormatter
     *
     * @return string 
     */
    public function getShortDescriptionFormatter()
    {
        return $this->shortDescriptionFormatter;
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

    /**
     * Add listRequirement
     *
     * @param \AppBundle\Entity\VacancyList $listRequirement
     * @return Vacancy
     */
    public function addListRequirement(\AppBundle\Entity\VacancyList $listRequirement)
    {
        $listRequirement->setVacancyRequirement($this);
        $this->listRequirements[] = $listRequirement;

        return $this;
    }

    /**
     * Remove listRequirements
     *
     * @param \AppBundle\Entity\VacancyList $listRequirements
     */
    public function removeListRequirement(\AppBundle\Entity\VacancyList $listRequirements)
    {
        $this->listRequirements->removeElement($listRequirements);
    }

    /**
     * Get listRequirements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListRequirements()
    {
        return $this->listRequirements;
    }

    /**
     * Add listTask
     *
     * @param \AppBundle\Entity\VacancyList $listTask
     * @return Vacancy
     */
    public function addListTask(\AppBundle\Entity\VacancyList $listTask)
    {
        $listTask->setVacancyTask($this);
        $this->listTasks[] = $listTask;

        return $this;
    }

    /**
     * Remove listTasks
     *
     * @param \AppBundle\Entity\VacancyList $listTasks
     */
    public function removeListTask(\AppBundle\Entity\VacancyList $listTasks)
    {
        $this->listTasks->removeElement($listTasks);
    }

    /**
     * Get listTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListTasks()
    {
        return $this->listTasks;
    }

    /**
     * Add listAdvantage
     *
     * @param \AppBundle\Entity\VacancyList $listAdvantage
     * @return Vacancy
     */
    public function addListAdvantage(\AppBundle\Entity\VacancyList $listAdvantage)
    {
        $listAdvantage->setVacancyAdvantage($this);
        $this->listAdvantages[] = $listAdvantage;

        return $this;
    }

    /**
     * Remove listAdvantages
     *
     * @param \AppBundle\Entity\VacancyList $listAdvantages
     */
    public function removeListAdvantage(\AppBundle\Entity\VacancyList $listAdvantages)
    {
        $this->listAdvantages->removeElement($listAdvantages);
    }

    /**
     * Get listAdvantages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getListAdvantages()
    {
        return $this->listAdvantages;
    }
}
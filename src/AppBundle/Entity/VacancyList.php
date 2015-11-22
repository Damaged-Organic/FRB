<?php
// src/AppBundle/Entity/VacancyList.php
namespace  AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="vacancies_lists")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\VacancyListRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\VacancyListTranslation")
 */
class VacancyList implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="VacancyListTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Vacancy", inversedBy="listRequirements")
     * @ORM\JoinColumn(name="vacancy_requirement_id", referencedColumnName="id")
     */
    protected $vacancyRequirement;

    /**
     * @ORM\ManyToOne(targetEntity="Vacancy", inversedBy="listTasks")
     * @ORM\JoinColumn(name="vacancy_task_id", referencedColumnName="id")
     */
    protected $vacancyTask;

    /**
     * @ORM\ManyToOne(targetEntity="Vacancy", inversedBy="listAdvantages")
     * @ORM\JoinColumn(name="vacancy_advantages_id", referencedColumnName="id")
     */
    protected $vacancyAdvantage;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $listItem;

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
        return ( $this->listItem ) ? $this->listItem : "";
    }

    /**
     * Set listItem
     *
     * @param string $listItem
     * @return VacancyList
     */
    public function setListItem($listItem)
    {
        $this->listItem = $listItem;

        return $this;
    }

    /**
     * Get listItem
     *
     * @return string 
     */
    public function getListItem()
    {
        return $this->listItem;
    }

    /**
     * Set vacancyRequirement
     *
     * @param \AppBundle\Entity\Vacancy $vacancyRequirement
     * @return VacancyList
     */
    public function setVacancyRequirement(\AppBundle\Entity\Vacancy $vacancyRequirement = null)
    {
        $this->vacancyRequirement = $vacancyRequirement;

        return $this;
    }

    /**
     * Get vacancyRequirement
     *
     * @return \AppBundle\Entity\Vacancy 
     */
    public function getVacancyRequirement()
    {
        return $this->vacancyRequirement;
    }

    /**
     * Set vacancyTask
     *
     * @param \AppBundle\Entity\Vacancy $vacancyTask
     * @return VacancyList
     */
    public function setVacancyTask(\AppBundle\Entity\Vacancy $vacancyTask = null)
    {
        $this->vacancyTask = $vacancyTask;

        return $this;
    }

    /**
     * Get vacancyTask
     *
     * @return \AppBundle\Entity\Vacancy 
     */
    public function getVacancyTask()
    {
        return $this->vacancyTask;
    }

    /**
     * Set vacancyAdvantage
     *
     * @param \AppBundle\Entity\Vacancy $vacancyAdvantage
     * @return VacancyList
     */
    public function setVacancyAdvantage(\AppBundle\Entity\Vacancy $vacancyAdvantage = null)
    {
        $this->vacancyAdvantage = $vacancyAdvantage;

        return $this;
    }

    /**
     * Get vacancyAdvantage
     *
     * @return \AppBundle\Entity\Vacancy 
     */
    public function getVacancyAdvantage()
    {
        return $this->vacancyAdvantage;
    }
}
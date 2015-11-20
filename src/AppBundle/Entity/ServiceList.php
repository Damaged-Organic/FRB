<?php
// src/AppBundle/Entity/ServiceList.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="services_lists")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ServiceListRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ServiceListTranslation")
 */
class ServiceList implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="ServiceListTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="Service", inversedBy="serviceLists")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     */
    protected $service;

    /**
     * @ORM\OneToMany(targetEntity="ServiceListItem", mappedBy="serviceList", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $serviceListItems;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * @ORM\Column(type="string", length=1023, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $shortDescription;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations     = new ArrayCollection;
        $this->serviceListItems = new ArrayCollection;
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
     * @return ServiceList
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
     * @return ServiceList
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
     * Set service
     *
     * @param \AppBundle\Entity\Service $service
     * @return ServiceList
     */
    public function setService(\AppBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\Service 
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add serviceListItem
     *
     * @param \AppBundle\Entity\ServiceListItem $serviceListItem
     * @return ServiceList
     */
    public function addServiceListItem(\AppBundle\Entity\ServiceListItem $serviceListItem)
    {
        $serviceListItem->setServiceList($this);
        $this->serviceListItems[] = $serviceListItem;

        return $this;
    }

    /**
     * Remove serviceListItems
     *
     * @param \AppBundle\Entity\ServiceListItem $serviceListItems
     */
    public function removeServiceListItem(\AppBundle\Entity\ServiceListItem $serviceListItems)
    {
        $this->serviceListItems->removeElement($serviceListItems);
    }

    /**
     * Get serviceListItems
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceListItems()
    {
        return $this->serviceListItems;
    }
}
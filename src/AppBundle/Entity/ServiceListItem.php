<?php
// src/AppBundle/Entity/ServiceListItem.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="services_lists_items")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ServiceListItemRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ServiceListItemTranslation")
 */
class ServiceListItem implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="ServiceListItemTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceList", inversedBy="serviceListItems")
     * @ORM\JoinColumn(name="service_list_id", referencedColumnName="id")
     */
    protected $serviceList;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $text;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return ServiceListItem
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set serviceList
     *
     * @param \AppBundle\Entity\ServiceList $serviceList
     * @return ServiceListItem
     */
    public function setServiceList(\AppBundle\Entity\ServiceList $serviceList = null)
    {
        $this->serviceList = $serviceList;

        return $this;
    }

    /**
     * Get serviceList
     *
     * @return \AppBundle\Entity\ServiceList 
     */
    public function getServiceList()
    {
        return $this->serviceList;
    }
}
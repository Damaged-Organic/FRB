<?php
// src/AppBundle/Entity/Service.php
namespace AppBundle\Entity;

use DateTime;

use Symfony\Component\HttpFoundation\File\File,
    Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="services")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ServiceRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ServiceTranslation")
 *
 * @Vich\Uploadable
 */
class Service implements Translatable
{
    use IdMapper, TranslationMapper;

    //const WEB_PATH = "/uploads/service/photos/";

    /**
     * @ORM\OneToMany(targetEntity="ServiceTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="ServiceBenefit", mappedBy="service", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $serviceBenefits;

    /**
     * @ORM\OneToMany(targetEntity="ServiceList", mappedBy="service", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $serviceLists;

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
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $alias;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    protected $cssPosition;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="service_photo", fileNameProperty="photoName")
     */
    //protected $photoFile;

    /**
     * @ORM\Column(type="string", length=255)
     **/
    //protected $photoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     **/
    //protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations    = new ArrayCollection;
        $this->serviceBenefits = new ArrayCollection;
        $this->serviceLists    = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
    }

    /* Vich uploadable methods */

    /*public function setPhotoFile($photoFile = NULL)
    {
        $this->photoFile = $photoFile;

        if( $photoFile instanceof File )
            $this->updatedAt = new DateTime;
    }

    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    public function getPhotoPath()
    {
        return ( $this->photoName )
            ? self::WEB_PATH.$this->photoName
            : FALSE;
    }*/

    /* END Vich uploadable methods */

    /**
     * Set title
     *
     * @param string $title
     * @return Service
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
     * @return Service
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
     * Set photoName
     *
     * @param string $photoName
     * @return Service
     */
    /*public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;

        return $this;
    }*/

    /**
     * Get photoName
     *
     * @return string 
     */
    /*public function getPhotoName()
    {
        return $this->photoName;
    }*/

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Service
     */
    /*public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }*/

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    /*public function getUpdatedAt()
    {
        return $this->updatedAt;
    }*/

    /**
     * Set alias
     *
     * @param string $alias
     * @return Service
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
     * Set cssPosition
     *
     * @param string $cssPosition
     * @return Service
     */
    public function setCssPosition($cssPosition)
    {
        $this->cssPosition = $cssPosition;

        return $this;
    }

    /**
     * Get cssPosition
     *
     * @return string 
     */
    public function getCssPosition()
    {
        return $this->cssPosition;
    }

    /**
     * Add serviceBenefit
     *
     * @param \AppBundle\Entity\ServiceBenefit $serviceBenefit
     * @return Service
     */
    public function addServiceBenefit(\AppBundle\Entity\ServiceBenefit $serviceBenefit)
    {
        $serviceBenefit->setService($this);
        $this->serviceBenefits[] = $serviceBenefit;

        return $this;
    }

    /**
     * Remove serviceBenefits
     *
     * @param \AppBundle\Entity\ServiceBenefit $serviceBenefits
     */
    public function removeServiceBenefit(\AppBundle\Entity\ServiceBenefit $serviceBenefits)
    {
        $this->serviceBenefits->removeElement($serviceBenefits);
    }

    /**
     * Get serviceBenefits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceBenefits()
    {
        return $this->serviceBenefits;
    }

    /**
     * Add serviceList
     *
     * @param \AppBundle\Entity\ServiceList $serviceList
     * @return Service
     */
    public function addServiceList(\AppBundle\Entity\ServiceList $serviceList)
    {
        $serviceList->setService($this);
        $this->serviceLists[] = $serviceList;

        return $this;
    }

    /**
     * Remove serviceLists
     *
     * @param \AppBundle\Entity\ServiceList $serviceLists
     */
    public function removeServiceList(\AppBundle\Entity\ServiceList $serviceLists)
    {
        $this->serviceLists->removeElement($serviceLists);
    }

    /**
     * Get serviceLists
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getServiceLists()
    {
        return $this->serviceLists;
    }
}
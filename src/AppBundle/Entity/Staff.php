<?php
// src/AppBundle/Entity/Staff.php
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
 * @ORM\Table(name="staff")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\StaffRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\StaffTranslation")
 *
 * @Vich\Uploadable
 */
class Staff implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PATH = "/uploads/staff/photos/";

    /**
     * @ORM\OneToMany(targetEntity="StaffTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToMany(targetEntity="Service")
     * @ORM\JoinTable(name="staff_services",
     *      joinColumns={
     *          @ORM\JoinColumn(name="staff_id", referencedColumnName="id")
     *      },
     *      inverseJoinColumns={
     *          @ORM\JoinColumn(name="service_id", referencedColumnName="id")
     *      }
     * )
     **/
    protected $services;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     **/
    protected $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $education;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     **/
    protected $degree;

    /**
     * @ORM\Column(type="string", length=20, nullable=false)
     **/
    protected $phone;

    /**
     * @ORM\Column(type="string", length=127, nullable=false)
     **/
    protected $email;

    /**
     * @ORM\Column(type="string", length=127, nullable=true)
     **/
    protected $skype;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="staff_photo", fileNameProperty="photoName")
     */
    protected $photoFile;

    /**
     * @ORM\Column(type="string", length=255)
     **/
    protected $photoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     **/
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
        $this->services     = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->name ) ? $this->name : "";
    }

    /* Vich uploadable methods */

    public function setPhotoFile($photoFile = NULL)
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
    }

    /* END Vich uploadable methods */

    /**
     * Set name
     *
     * @param string $name
     * @return Staff
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set position
     *
     * @param string $position
     * @return Staff
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return string
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set education
     *
     * @param string $education
     * @return Staff
     */
    public function setEducation($education)
    {
        $this->education = $education;

        return $this;
    }

    /**
     * Get education
     *
     * @return string
     */
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set degree
     *
     * @param string $degree
     * @return Staff
     */
    public function setDegree($degree)
    {
        $this->degree = $degree;

        return $this;
    }

    /**
     * Get degree
     *
     * @return string
     */
    public function getDegree()
    {
        return $this->degree;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Staff
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Staff
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set skype
     *
     * @param string $skype
     * @return Staff
     */
    public function setSkype($skype)
    {
        $this->skype = $skype;

        return $this;
    }

    /**
     * Get skype
     *
     * @return string
     */
    public function getSkype()
    {
        return $this->skype;
    }

    /**
     * Set photoName
     *
     * @param string $photoName
     * @return Staff
     */
    public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;

        return $this;
    }

    /**
     * Get photoName
     *
     * @return string
     */
    public function getPhotoName()
    {
        return $this->photoName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Staff
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add services
     *
     * @param \AppBundle\Entity\Service $services
     * @return Staff
     */
    public function addService(\AppBundle\Entity\Service $services)
    {
        $this->services[] = $services;

        return $this;
    }

    /**
     * Remove services
     *
     * @param \AppBundle\Entity\Service $services
     */
    public function removeService(\AppBundle\Entity\Service $services)
    {
        $this->services->removeElement($services);
    }

    /**
     * Get services
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServices()
    {
        return $this->services;
    }
}
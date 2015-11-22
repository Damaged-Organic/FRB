<?php
// src/AppBundle/Entity/Client.php
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
 * @ORM\Table(name="clients")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ClientRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ClientTranslation")
 *
 * @Vich\Uploadable
 */
class Client implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PATH = "/uploads/clients/logos/";

    /**
     * @ORM\OneToMany(targetEntity="ClientTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="ClientChit", mappedBy="client", cascade={"persist", "remove"}, orphanRemoval=true)
     **/
    protected $clientChits;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $name;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="client_logo", fileNameProperty="logoName")
     */
    protected $logoFile;

    /**
     * @ORM\Column(type="string", length=255)
     **/
    protected $logoName;

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
        $this->clientChits  = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->name ) ? $this->name : "";
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Client
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

    /* Vich uploadable methods */

    public function setLogoFile($logoFile = NULL)
    {
        $this->logoFile = $logoFile;

        if( $logoFile instanceof File )
            $this->updatedAt = new DateTime;
    }

    public function getLogoFile()
    {
        return $this->logoFile;
    }

    public function getLogoPath()
    {
        return ( $this->logoName )
            ? self::WEB_PATH.$this->logoName
            : FALSE;
    }

    /* END Vich uploadable methods */

    /**
     * Set logoName
     *
     * @param string $logoName
     * @return Client
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get logoName
     *
     * @return string 
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Client
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
     * Add clientChit
     *
     * @param \AppBundle\Entity\ClientChit $clientChit
     * @return Client
     */
    public function addClientChit(\AppBundle\Entity\ClientChit $clientChit)
    {
        $clientChit->setClient($this);
        $this->clientChits[] = $clientChit;

        return $this;
    }

    /**
     * Remove clientChits
     *
     * @param \AppBundle\Entity\ClientChit $clientChits
     */
    public function removeClientChit(\AppBundle\Entity\ClientChit $clientChits)
    {
        $this->clientChits->removeElement($clientChits);
    }

    /**
     * Get clientChits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getClientChits()
    {
        return $this->clientChits;
    }
}
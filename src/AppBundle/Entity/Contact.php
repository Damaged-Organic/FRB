<?php
// src/AppBundle/Entity/Contact.php
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
 * @ORM\Table(name="contacts")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ContactRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ContactTranslation")
 *
 * @Vich\Uploadable
 */
class Contact implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PDF_PREVIEW_PATH = "/uploads/contacts/pdf/";

    /**
     * @ORM\OneToMany(targetEntity="ContactTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\Column(type="string", length=500, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $address;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     **/
    protected $phone;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     **/
    protected $fax;

    /**
     * @ORM\Column(type="string", length=200, nullable=false)
     **/
    protected $email;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={"application/pdf"}
     * )
     *
     * @Vich\UploadableField(mapping="contacts_pdf", fileNameProperty="pdfPreviewName")
     */
    protected $pdfPreviewFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $pdfPreviewName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

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
        return ( $this->address ) ? $this->address : '';
    }

    /**
     * Vich set $pdfPreviewFile
     */
    public function setPdfPreviewFile($pdfPreviewFile = NULL)
    {
        $this->pdfPreviewFile = $pdfPreviewFile;

        if( $pdfPreviewFile instanceof File )
            $this->updatedAt = new DateTime;
    }

    /**
     * Vich get $pdfPreviewFile
     */
    public function getPdfPreviewFile()
    {
        return $this->pdfPreviewFile;
    }

    /**
     * Vich get pdfPreviewPath
     */
    public function getPdfPreviewPath()
    {
        return ( $this->pdfPreviewName )
            ? self::WEB_PDF_PREVIEW_PATH.$this->pdfPreviewName
            : FALSE;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Contact
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Contact
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
     * Set fax
     *
     * @param string $fax
     * @return Contact
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contact
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
     * Set pdfPreviewName
     *
     * @param string $pdfPreviewName
     * @return Contact
     */
    public function setPdfPreviewName($pdfPreviewName)
    {
        $this->pdfPreviewName = $pdfPreviewName;

        return $this;
    }

    /**
     * Get pdfPreviewName
     *
     * @return string 
     */
    public function getPdfPreviewName()
    {
        return $this->pdfPreviewName;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Contact
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
}
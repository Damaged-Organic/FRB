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
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $headline;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $intro;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawIntro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $introFormatter;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $list;

    /**
     * @ORM\Column(type="text", nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $outro;

    /**
     * @ORM\Column(type="text", nullable=true)
     **/
    protected $rawOutro;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     **/
    protected $outroFormatter;

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

    /**
     * Set intro
     *
     * @param string $intro
     * @return Contact
     */
    public function setIntro($intro)
    {
        $this->intro = $intro;

        return $this;
    }

    /**
     * Get intro
     *
     * @return string
     */
    public function getIntro()
    {
        return $this->intro;
    }

    /**
     * Set rawIntro
     *
     * @param string $rawIntro
     * @return Contact
     */
    public function setRawIntro($rawIntro)
    {
        $this->rawIntro = $rawIntro;

        return $this;
    }

    /**
     * Get rawIntro
     *
     * @return string
     */
    public function getRawIntro()
    {
        return $this->rawIntro;
    }

    /**
     * Set introFormatter
     *
     * @param string $introFormatter
     * @return Contact
     */
    public function setIntroFormatter($introFormatter)
    {
        $this->introFormatter = $introFormatter;

        return $this;
    }

    /**
     * Get introFormatter
     *
     * @return string
     */
    public function getIntroFormatter()
    {
        return $this->introFormatter;
    }

    /**
     * Set list
     *
     * @param string $list
     * @return Contact
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get list
     *
     * @return string
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set outro
     *
     * @param string $outro
     * @return Contact
     */
    public function setOutro($outro)
    {
        $this->outro = $outro;

        return $this;
    }

    /**
     * Get outro
     *
     * @return string
     */
    public function getOutro()
    {
        return $this->outro;
    }

    /**
     * Set rawOutro
     *
     * @param string $rawOutro
     * @return Contact
     */
    public function setRawOutro($rawOutro)
    {
        $this->rawOutro = $rawOutro;

        return $this;
    }

    /**
     * Get rawOutro
     *
     * @return string
     */
    public function getRawOutro()
    {
        return $this->rawOutro;
    }

    /**
     * Set outroFormatter
     *
     * @param string $outroFormatter
     * @return Contact
     */
    public function setOutroFormatter($outroFormatter)
    {
        $this->outroFormatter = $outroFormatter;

        return $this;
    }

    /**
     * Get outroFormatter
     *
     * @return string
     */
    public function getOutroFormatter()
    {
        return $this->outroFormatter;
    }

    /**
     * Set headline
     *
     * @param string $headline
     * @return Contact
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;

        return $this;
    }

    /**
     * Get headline
     *
     * @return string 
     */
    public function getHeadline()
    {
        return $this->headline;
    }
}

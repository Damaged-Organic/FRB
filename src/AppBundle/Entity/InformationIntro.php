<?php
// src/AppBundle/Entity/InformationIntro.php
namespace AppBundle\Entity;

use DateTime;

use Symfony\Component\Validator\Constraints as Assert,
    Symfony\Component\HttpFoundation\File\File;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="information_intro")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InformationIntroRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\InformationIntroTranslation")
 *
 * @Vich\Uploadable
 */
class InformationIntro implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_FILE_PATH = "/uploads/information_intro/guide/";

    /**
     * @ORM\OneToMany(targetEntity="InformationIntroTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
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
     */
    protected $text;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={
     *           "image/jpeg",
     *           "image/png",
     *           "text/plain",
     *           "application/msword",
     *           "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *           "application/pdf",
     *           "application/vnd.oasis.opendocument.text",
     *           "application/x-iwork-pages-sffpages"
     *     }
     * )
     *
     * @Vich\UploadableField(mapping="information_intro_guide", fileNameProperty="fileNameUA")
     */
    protected $fileUA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fileNameUA;

    /**
     * @Assert\File(
     *     maxSize="5M",
     *     mimeTypes={
     *           "image/jpeg",
     *           "image/png",
     *           "text/plain",
     *           "application/msword",
     *           "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
     *           "application/pdf",
     *           "application/vnd.oasis.opendocument.text",
     *           "application/x-iwork-pages-sffpages"
     *     }
     * )
     *
     * @Vich\UploadableField(mapping="information_intro_guide", fileNameProperty="fileNameEN")
     */
    protected $fileEN;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $fileNameEN;

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
        return ( $this->title ) ? $this->title : "";
    }

    /**
     * Vich set $fileUA
     */
    public function setFileUA($fileUA = NULL)
    {
        $this->fileUA = $fileUA;

        if( $fileUA instanceof File )
            $this->updatedAt = new DateTime;
    }

    /**
     * Vich get $fileUA
     */
    public function getFileUA()
    {
        return $this->fileUA;
    }

    /**
     * Vich get filePathUA
     */
    public function getFilePathUA()
    {
        return ( $this->fileNameUA )
            ? self::WEB_FILE_PATH.$this->fileNameUA
            : FALSE;
    }

    /**
     * Vich set $fileEN
     */
    public function setFileEN($fileEN = NULL)
    {
        $this->fileEN = $fileEN;

        if( $fileEN instanceof File )
            $this->updatedAt = new DateTime;
    }

    /**
     * Vich get $fileEN
     */
    public function getFileEN()
    {
        return $this->fileEN;
    }

    /**
     * Vich get filePathEN
     */
    public function getFilePathEN()
    {
        return ( $this->fileNameEN )
            ? self::WEB_FILE_PATH.$this->fileNameEN
            : FALSE;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return InformationIntro
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
     * Set text
     *
     * @param string $text
     * @return InformationIntro
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
     * Set fileNameUA
     *
     * @param string $fileNameUA
     * @return InformationIntro
     */
    public function setFileNameUA($fileNameUA)
    {
        $this->fileNameUA = $fileNameUA;

        return $this;
    }

    /**
     * Get fileNameUA
     *
     * @return string
     */
    public function getFileNameUA()
    {
        return $this->fileNameUA;
    }

    /**
     * Set fileNameEN
     *
     * @param string $fileNameEN
     * @return InformationIntro
     */
    public function setFileNameEN($fileNameEN)
    {
        $this->fileNameEN = $fileNameEN;

        return $this;
    }

    /**
     * Get fileNameEN
     *
     * @return string
     */
    public function getFileNameEN()
    {
        return $this->fileNameEN;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return InformationIntro
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

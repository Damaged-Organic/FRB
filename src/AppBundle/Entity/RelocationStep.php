<?php
// src/AppBundle/Entity/RelocationStep.php
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
 * @ORM\Table(name="relocation_steps")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RelocationStepRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\RelocationStepTranslation")
 *
 * @Vich\Uploadable
 */
class RelocationStep implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_FILE_PATH = "/uploads/relocation_steps/files/";

    /**
     * @ORM\OneToMany(targetEntity="RelocationStepTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="RelocationStepItem", mappedBy="relocationStep", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $relocationStepItems;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     **/
    protected $icon;

    /**
     * @ORM\Column(type="string", length=150, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

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
     * @Vich\UploadableField(mapping="relocation_step_file", fileNameProperty="fileNameUA")
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
     * @Vich\UploadableField(mapping="relocation_step_file", fileNameProperty="fileNameEN")
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
        $this->translations        = new ArrayCollection;
        $this->relocationStepItems = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : '';
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
     * Set icon
     *
     * @param string $icon
     * @return RelocationStep
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return RelocationStep
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
     * Add relocationStepItem
     *
     * @param \AppBundle\Entity\RelocationStepItem $relocationStepItem
     * @return RelocationStep
     */
    public function addRelocationStepItem(\AppBundle\Entity\RelocationStepItem $relocationStepItem)
    {
        $relocationStepItem->setRelocationStep($this);
        $this->relocationStepItems[] = $relocationStepItem;

        return $this;
    }

    /**
     * Remove relocationStepItems
     *
     * @param \AppBundle\Entity\RelocationStepItem $relocationStepItems
     */
    public function removeRelocationStepItem(\AppBundle\Entity\RelocationStepItem $relocationStepItems)
    {
        $this->relocationStepItems->removeElement($relocationStepItems);
    }

    /**
     * Get relocationStepItems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelocationStepItems()
    {
        return $this->relocationStepItems;
    }

    /**
     * Set fileNameUA
     *
     * @param string $fileNameUA
     * @return RelocationStep
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
     * @return RelocationStep
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
     * @return RelocationStep
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

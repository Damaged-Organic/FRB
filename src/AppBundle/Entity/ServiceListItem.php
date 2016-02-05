<?php
// src/AppBundle/Entity/ServiceListItem.php
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
 * @ORM\Table(name="services_lists_items")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ServiceListItemRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ServiceListItemTranslation")
 *
 * @Vich\Uploadable
 */
class ServiceListItem implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_FILE_PATH = "/uploads/services_lists_items/files/";

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
     * @Vich\UploadableField(mapping="service_list_item_file", fileNameProperty="fileNameUA")
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
     * @Vich\UploadableField(mapping="service_list_item_file", fileNameProperty="fileNameEN")
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

    /**
     * Set fileNameUA
     *
     * @param string $fileNameUA
     * @return ServiceListItem
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
     * @return ServiceListItem
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
     * @return ServiceListItem
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

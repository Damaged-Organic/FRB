<?php
// src/AppBundle/Entity/EstatePhoto.php
namespace AppBundle\Entity;

use DateTime;

use Symfony\Component\HttpFoundation\File\File,
    Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper;

/**
 * @ORM\Entity(repositoryClass="Gedmo\Sortable\Entity\Repository\SortableRepository")
 * @ORM\Table(name="estate_photos")
 *
 * @Vich\Uploadable
 */
class EstatePhoto
{
    use IdMapper;

    const WEB_PATH = "/uploads/estate/photos/";

    /**
     * @Gedmo\SortableGroup
     * @ORM\ManyToOne(targetEntity="Estate", inversedBy="estatePhoto")
     * @ORM\JoinColumn(name="estate_id", referencedColumnName="id")
     */
    protected $estate;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="estate_photo", fileNameProperty="photoName")
     */
    protected $photoFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $photoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @Gedmo\SortablePosition
     * @ORM\Column(name="position", type="integer")
     */
    private $position;

    /**
     * @Gedmo\SortableGroup
     * @ORM\Column(length=128)
     */
    private $category;

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->photoName ) ? $this->photoName : "";
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
     * Set photoName
     *
     * @param string $photoName
     * @return EstatePhoto
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
     * @return EstatePhoto
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

    public function setPosition($position)
    {
        $this->position = $position;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set estate
     *
     * @param \AppBundle\Entity\Estate $estate
     * @return EstatePhoto
     */
    public function setEstate(\AppBundle\Entity\Estate $estate = null)
    {
        $this->estate = $estate;

        return $this;
    }

    /**
     * Get estate
     *
     * @return \AppBundle\Entity\Estate
     */
    public function getEstate()
    {
        return $this->estate;
    }
}

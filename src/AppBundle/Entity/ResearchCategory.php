<?php
// src/AppBundle/Entity/ResearchCategory.php
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
 * @ORM\Table(name="researches_categories")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ResearchCategoryRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ResearchCategoryTranslation")
 *
 * @Vich\Uploadable
 */
class ResearchCategory implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PATH = "/uploads/researches/photos/";

    /**
     * @ORM\OneToMany(targetEntity="ResearchCategoryTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\OneToMany(targetEntity="Research", mappedBy="object", cascade={"persist"})
     */
    protected $research;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=1000)
     *
     * @Gedmo\Translatable
     */
    protected $description;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="researches_photo", fileNameProperty="photoName")
     */
    protected $photoFile;

    /**
     * @ORM\Column(type="string", length=255)
     **/
    protected $photoName;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
        $this->research     = new ArrayCollection;
    }

    /**
     * To string
     */
    public function __toString()
    {
        return ( $this->title ) ? $this->title : "";
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
     * Set title
     *
     * @param string $title
     * @return ResearchCategory
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
     * Set description
     *
     * @param string $description
     * @return ResearchCategory
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add research
     *
     * @param \AppBundle\Entity\Research $research
     * @return ResearchCategory
     */
    public function addResearch(\AppBundle\Entity\Research $research)
    {
        $research->setResearchCategory($this);
        $this->research[] = $research;

        return $this;
    }

    /**
     * Remove research
     *
     * @param \AppBundle\Entity\Research $research
     */
    public function removeResearch(\AppBundle\Entity\Research $research)
    {
        $this->research->removeElement($research);
    }

    /**
     * Get research
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getResearch()
    {
        return $this->research;
    }

    /**
     * Set photoName
     *
     * @param string $photoName
     * @return ResearchCategory
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
}
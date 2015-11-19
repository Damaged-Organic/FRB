<?php
// src/AppBundle/Entity/Research.php
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
 * @ORM\Table(name="researches")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ResearchRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\ResearchTranslation")
 *
 * @Vich\Uploadable
 */
class Research implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PDF_PREVIEW_PATH = "/uploads/researches/pdf/";

    /**
     * @ORM\OneToMany(targetEntity="ResearchTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="ResearchCategory", inversedBy="research")
     * @ORM\JoinColumn(name="research_category_id", referencedColumnName="id")
     */
    protected $researchCategory;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $year;

    /**
     * @ORM\Column(type="smallint", nullable=false)
     */
    protected $quarter;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"application/pdf"}
     * )
     *
     * @Vich\UploadableField(mapping="researches_pdf", fileNameProperty="pdfPreviewName")
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
        return ( $this->year && $this->quarter ) ? "{$this->year} {$this->quarter}" : "";
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
     * Set year
     *
     * @param integer $year
     * @return Research
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set quarter
     *
     * @param integer $quarter
     * @return Research
     */
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return integer 
     */
    public function getQuarter()
    {
        return $this->quarter;
    }

    /**
     * Set pdfPreviewName
     *
     * @param string $pdfPreviewName
     * @return Research
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
     * @return Research
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
     * Set researchCategory
     *
     * @param \AppBundle\Entity\ResearchCategory $researchCategory
     * @return Research
     */
    public function setResearchCategory(\AppBundle\Entity\ResearchCategory $researchCategory = null)
    {
        $this->researchCategory = $researchCategory;

        return $this;
    }

    /**
     * Get researchCategory
     *
     * @return \AppBundle\Entity\ResearchCategory 
     */
    public function getResearchCategory()
    {
        return $this->researchCategory;
    }
}
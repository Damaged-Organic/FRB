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
     * @Vich\UploadableField(mapping="researches_pdf", fileNameProperty="pdfPreviewNameUA")
     */
    protected $pdfPreviewFileUA;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $pdfPreviewNameUA;

    /**
     * @Assert\File(
     *     maxSize="10M",
     *     mimeTypes={"application/pdf"}
     * )
     *
     * @Vich\UploadableField(mapping="researches_pdf", fileNameProperty="pdfPreviewNameEN")
     */
    protected $pdfPreviewFileEN;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $pdfPreviewNameEN;

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
     * Vich set $pdfPreviewFileUA
     */
    public function setPdfPreviewFileUA($pdfPreviewFileUA = NULL)
    {
        $this->pdfPreviewFileUA = $pdfPreviewFileUA;

        if( $pdfPreviewFileUA instanceof File )
            $this->updatedAt = new DateTime;
    }

    /**
     * Vich get $pdfPreviewFileUA
     */
    public function getPdfPreviewFileUA()
    {
        return $this->pdfPreviewFileUA;
    }

    /**
     * Vich get pdfPreviewPathUA
     */
    public function getPdfPreviewPathUA()
    {
        return ( $this->pdfPreviewNameUA )
            ? self::WEB_PDF_PREVIEW_PATH.$this->pdfPreviewNameUA
            : FALSE;
    }

    /**
     * Vich set $pdfPreviewFileEN
     */
    public function setPdfPreviewFileEN($pdfPreviewFileEN = NULL)
    {
        $this->pdfPreviewFileEN = $pdfPreviewFileEN;

        if( $pdfPreviewFileEN instanceof File )
            $this->updatedAt = new DateTime;
    }

    /**
     * Vich get $pdfPreviewFileEN
     */
    public function getPdfPreviewFileEN()
    {
        return $this->pdfPreviewFileEN;
    }

    /**
     * Vich get pdfPreviewPathEN
     */
    public function getPdfPreviewPathEN()
    {
        return ( $this->pdfPreviewNameEN )
            ? self::WEB_PDF_PREVIEW_PATH.$this->pdfPreviewNameEN
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
     * Set pdfPreviewNameUA
     *
     * @param string $pdfPreviewNameUA
     * @return Research
     */
    public function setPdfPreviewNameUA($pdfPreviewNameUA)
    {
        $this->pdfPreviewNameUA = $pdfPreviewNameUA;

        return $this;
    }

    /**
     * Get pdfPreviewNameUA
     *
     * @return string
     */
    public function getPdfPreviewNameUA()
    {
        return $this->pdfPreviewNameUA;
    }

    /**
     * Set pdfPreviewNameEN
     *
     * @param string $pdfPreviewNameEN
     * @return Research
     */
    public function setPdfPreviewNameEN($pdfPreviewNameEN)
    {
        $this->pdfPreviewNameEN = $pdfPreviewNameEN;

        return $this;
    }

    /**
     * Get pdfPreviewNameEN
     *
     * @return string
     */
    public function getPdfPreviewNameEN()
    {
        return $this->pdfPreviewNameEN;
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

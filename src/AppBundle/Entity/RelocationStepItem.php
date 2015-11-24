<?php
// src/AppBundle/Entity/RelocationStepItem.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="relocation_steps_items")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RelocationStepItemRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\RelocationStepItemTranslation")
 */
class RelocationStepItem implements Translatable
{
    use IdMapper, TranslationMapper;

    /**
     * @ORM\OneToMany(targetEntity="RelocationStepItemTranslation", mappedBy="object", cascade={"persist", "remove"})
     */
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="RelocationStep", inversedBy="relocationStepItems")
     * @ORM\JoinColumn(name="relocation_step_id", referencedColumnName="id")
     */
    protected $relocationStep;

    /**
     * @ORM\Column(type="string", length=1000, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $text;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return RelocationStepItem
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
     * Set relocationStep
     *
     * @param \AppBundle\Entity\RelocationStep $relocationStep
     * @return RelocationStepItem
     */
    public function setRelocationStep(\AppBundle\Entity\RelocationStep $relocationStep = null)
    {
        $this->relocationStep = $relocationStep;

        return $this;
    }

    /**
     * Get relocationStep
     *
     * @return \AppBundle\Entity\RelocationStep 
     */
    public function getRelocationStep()
    {
        return $this->relocationStep;
    }
}
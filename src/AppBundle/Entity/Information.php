<?php
// src/AppBundle/Entity/Information.php
namespace AppBundle\Entity;

use DateTime;

use Doctrine\ORM\PersistentCollection;
use Symfony\Component\HttpFoundation\File\File,
    Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM,
    Doctrine\Common\Collections\ArrayCollection;

use Gedmo\Mapping\Annotation as Gedmo,
    Gedmo\Translatable\Translatable;

use Symfony\Component\Translation\TranslatorInterface;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

use AppBundle\Entity\Utility\DoctrineMapping\IdMapper,
    AppBundle\Entity\Utility\DoctrineMapping\TranslationMapper;

/**
 * @ORM\Table(name="information")
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\InformationRepository")
 *
 * @Gedmo\TranslationEntity(class="AppBundle\Entity\InformationTranslation")
 *
 * @Vich\Uploadable
 */
class Information implements Translatable
{
    use IdMapper, TranslationMapper;

    const WEB_PATH_LOGOS  = "/uploads/information/logos/";
    const WEB_PATH_PHOTOS = "/uploads/information/photos/";

    /**
     * @ORM\OneToMany(targetEntity="InformationTranslation", mappedBy="object", cascade={"persist", "remove"})
     **/
    protected $translations;

    /**
     * @ORM\ManyToOne(targetEntity="InformationCategory", inversedBy="information")
     * @ORM\JoinColumn(name="information_category_id", referencedColumnName="id")
     */
    protected $informationCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     *
     * @Gedmo\Translatable
     **/
    protected $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $description;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="information_logo", fileNameProperty="logoName")
     */
    protected $logoFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $logoName;

    /**
     * @Assert\File(
     *     maxSize="2M",
     *     mimeTypes={"image/png", "image/jpeg", "image/pjpeg", "image/gif"}
     * )
     *
     * @Vich\UploadableField(mapping="information_photo", fileNameProperty="photoName")
     */
    //protected $photoFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    //protected $photoName;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\Column(type="string", length=511, nullable=true)
     */
    protected $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $emails;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $phones;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $addresses;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $coordinates;

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

    /* Vich uploadable methods */

    public function setLogoFile($logoFile = NULL)
    {
        $this->logoFile = $logoFile;

        if( $logoFile instanceof File )
            $this->updatedAt = new DateTime;
    }

    public function getLogoFile()
    {
        return $this->logoFile;
    }

    public function getLogoPath()
    {
        return ( $this->logoName )
            ? self::WEB_PATH_LOGOS.$this->logoName
            : FALSE;
    }

    /*public function setPhotoFile($photoFile = NULL)
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
            ? self::WEB_PATH_PHOTOS.$this->photoName
            : FALSE;
    }*/

    /* END Vich uploadable methods */

    /**
     * Set title
     *
     * @param string $title
     * @return Information
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
     * @return Information
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
     * Set logoName
     *
     * @param string $logoName
     * @return Information
     */
    public function setLogoName($logoName)
    {
        $this->logoName = $logoName;

        return $this;
    }

    /**
     * Get logoName
     *
     * @return string
     */
    public function getLogoName()
    {
        return $this->logoName;
    }

    /**
     * Set photoName
     *
     * @param string $photoName
     * @return Information
     */
    /*public function setPhotoName($photoName)
    {
        $this->photoName = $photoName;

        return $this;
    }*/

    /**
     * Get photoName
     *
     * @return string
     */
    /*public function getPhotoName()
    {
        return $this->photoName;
    }*/

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Information
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
     * Set link
     *
     * @param string $link
     * @return Information
     */
    public function setLink($link)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link
     *
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set emails
     *
     * @param string $emails
     * @return Information
     */
    public function setEmails($emails)
    {
        $this->emails = $emails;

        return $this;
    }

    /**
     * Get emails
     *
     * @return string
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Set phones
     *
     * @param string $phones
     * @return Information
     */
    public function setPhones($phones)
    {
        $this->phones = $phones;

        return $this;
    }

    /**
     * Get phones
     *
     * @return string
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Set addresses
     *
     * @param string $addresses
     * @return Information
     */
    public function setAddresses($addresses)
    {
        $this->addresses = $addresses;

        return $this;
    }

    /**
     * Get addresses
     *
     * @return string
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set coordinates
     *
     * @param array $coordinates
     * @return Information
     */
    public function setCoordinates(array $coordinates)
    {
        $this->coordinates = implode(PHP_EOL, $coordinates);

        return $this;
    }

    /**
     * Get coordinates
     *
     * @return array
     */
    public function getCoordinates()
    {
        return explode(PHP_EOL, $this->coordinates);
    }

    /**
     * Set informationCategory
     *
     * @param \AppBundle\Entity\InformationCategory $informationCategory
     * @return Information
     */
    public function setInformationCategory(\AppBundle\Entity\InformationCategory $informationCategory = null)
    {
        $this->informationCategory = $informationCategory;

        return $this;
    }

    /**
     * Get informationCategory
     *
     * @return \AppBundle\Entity\InformationCategory
     */
    public function getInformationCategory()
    {
        return $this->informationCategory;
    }

    static public function getTransformedCategories(array $information, TranslatorInterface $translator)
    {
        $categorize = function(array $information)
        {
            $categorized = [];

            foreach($information as $location)
            {
                if( $location instanceof Information && $location->getInformationCategory() )
                    $categorized[$location->getInformationCategory()->getId()][] = $location;
            }

            return $categorized;
        };

        $categories = [];

        foreach($categorize($information) as $locations)
        {
            $places = [];

            foreach($locations as $location)
            {
                $phones = ( $location->getPhones() )
                    ? explode(PHP_EOL, $location->getPhones())
                    : $translator->trans('state.expats_information.empty.phones');

                $address = ( $location->getAddresses() )
                    ? str_replace(PHP_EOL, '; ', $location->getAddresses())
                    : $translator->trans('state.expats_information.empty.addresses');

                $text = ( $location->getDescription() )
                    ? $location->getDescription()
                    : $translator->trans('state.expats_information.empty.description');

                $places[] = [
                    'title'         => $location->getTitle(),
                    'photo'         => $location->getLogoName(),
                    'phone_label'   => $translator->trans('state.expats_information.block.phones'),
                    'phones'        => $phones,
                    'address_label' => $translator->trans('state.expats_information.block.addresses'),
                    'address'       => $address,
                    'text'          => $text
                ];
            }

            if( $places )
            {
                $categories[] = [
                    'title'  => $locations[0]->getInformationCategory()->getTitle(),
                    'icon'   => $locations[0]->getInformationCategory()->getAlias(),
                    'places' => $places
                ];
            }
        }

        return $categories;
    }

    static public function getTransformedLocations(array $information)
    {
        $locations = [];

        foreach($information as $location)
        {
            if( $location instanceof Information && $location->getInformationCategory() )
            {
                $coordinates = $location->getCoordinates();

                foreach($coordinates as $coordinate)
                {
                    $coordinate = explode(';', $coordinate);

                    $locations[] = [
                        'title' => $location->getTitle(),
                        'icon'  => $location->getInformationCategory()->getAlias(),
                        'lat'   => $coordinate[0],
                        'lng'   => $coordinate[1]
                    ];
                }
            }
        }

        return $locations;
    }
}

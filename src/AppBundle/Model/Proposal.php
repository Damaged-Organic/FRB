<?php
// src/AppBundle/Model/Proposal.php
namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

use AppBundle\Validator\Constraints as CustomAssert;

class Proposal
{
    /**
     * @Assert\NotBlank(
     *      message="proposal.name.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "proposal.name.length.min",
     *      maxMessage = "proposal.name.length.max"
     * )
     */
    protected $name;

    /**
     * @Assert\NotBlank(
     *      message="proposal.phone.not_blank"
     * )
     *
     * @CustomAssert\IsPhoneConstraint
     */
    protected $phone;

    /**
     * @Assert\NotBlank(
     *      message="proposal.email.not_blank"
     * )
     *
     * @Assert\Email(
     *      message="proposal.email.valid",
     *      checkMX=true
     * )
     */
    protected $email;

    /**
     * @Assert\NotBlank(
     *      message="proposal.type.not_blank"
     * )
     *
     * @CustomAssert\IsTypeValidConstraint
     */
    protected $type;

    /**
     * @Assert\NotBlank(
     *      message="proposal.price_value.not_blank"
     * )
     *
     * @Assert\Range(
     *      min = 1,
     *      minMessage="proposal.price_value.range.min"
     * )
     */
    protected $priceValue;

    /**
     * @Assert\NotBlank(
     *      message="proposal.price_currency.not_blank"
     * )
     *
     * @Assert\Choice(
     *      choices = {"USD", "UAH"},
     *      message = "proposal.price_currency.valid"
     * )
     */
    protected $priceCurrency;

    /**
     * @Assert\NotBlank(
     *      message="proposal.address.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 5,
     *      max = 500,
     *      minMessage = "proposal.address.length.min",
     *      maxMessage = "proposal.address.length.max"
     * )
     */
    protected $address;

    /**
     * @Assert\NotBlank(
     *      message="proposal.space.not_blank"
     * )
     *
     * @Assert\Range(
     *      min = 1,
     *      max = 1000000,
     *      minMessage="proposal.space.range.min",
     *      maxMessage="proposal.space.range.max"
     * )
     */
    protected $space;

    /**
     * @Assert\Range(
     *      min = 1,
     *      max = 1000000,
     *      minMessage="proposal.space_plot.range.min",
     *      maxMessage="proposal.space_plot.range.max"
     * )
     */
    protected $spacePlot;

    /**
     * @Assert\NotBlank(
     *      message="proposal.rooms_number.not_blank"
     * )
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     *      minMessage="proposal.rooms_number.range.min",
     *      maxMessage="proposal.rooms_number.range.max"
     * )
     */
    protected $roomsNumber;

    /**
     * @Assert\NotBlank(
     *      message="proposal.bathrooms_number.not_blank"
     * )
     *
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     *      minMessage="proposal.bathrooms_number.range.min",
     *      maxMessage="proposal.bathrooms_number.range.max"
     * )
     */
    protected $bathroomsNumber;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     *      minMessage="proposal.bedrooms_number.range.min",
     *      maxMessage="proposal.bedrooms_number.range.max"
     * )
     */
    protected $bedroomsNumber;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     *      minMessage="proposal.floor.range.min",
     *      maxMessage="proposal.floor.range.max"
     * )
     */
    protected $floor;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 1000,
     *      minMessage="proposal.floors_number.range.min",
     *      maxMessage="proposal.floors_number.range.max"
     * )
     */
    protected $floorsNumber;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $isCashless;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $isNewBuilding;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $hasElevator;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $hasParking;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $hasFurniture;

    /**
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.checkbox"
     * )
     */
    protected $hasRegistration;

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setPriceValue($priceValue)
    {
        $this->priceValue = $priceValue;

        return $this;
    }

    public function getPriceValue()
    {
        return $this->priceValue;
    }

    public function setPriceCurrency($priceCurrency)
    {
        $this->priceCurrency = $priceCurrency;

        return $this;
    }

    public function getPriceCurrency()
    {
        return $this->priceCurrency;
    }

    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    public function getSpace()
    {
        return $this->space;
    }

    public function setSpacePlot($spacePlot)
    {
        $this->spacePlot = $spacePlot;

        return $this;
    }

    public function getSpacePlot()
    {
        return $this->spacePlot;
    }

    public function setFloor($floor)
    {
        $this->floor = $floor;

        return $this;
    }

    public function getFloor()
    {
        return $this->floor;
    }

    public function setFloorsNumber($floorsNumber)
    {
        $this->floorsNumber = $floorsNumber;

        return $this;
    }

    public function getFloorsNumber()
    {
        return $this->floorsNumber;
    }

    public function setRoomsNumber($roomsNumber)
    {
        $this->roomsNumber = $roomsNumber;

        return $this;
    }

    public function getRoomsNumber()
    {
        return $this->roomsNumber;
    }

    public function setBathroomsNumber($bathroomsNumber)
    {
        $this->bathroomsNumber = $bathroomsNumber;

        return $this;
    }

    public function getBathroomsNumber()
    {
        return $this->bathroomsNumber;
    }

    public function setBedroomsNumber($bedroomsNumber)
    {
        $this->bedroomsNumber = $bedroomsNumber;

        return $this;
    }

    public function getBedroomsNumber()
    {
        return $this->bedroomsNumber;
    }

    public function setIsCashless($isCashless)
    {
        $this->isCashless = $isCashless;

        return $this;
    }

    public function getIsCashless()
    {
        return $this->isCashless;
    }

    public function setIsNewBuilding($isNewBuilding)
    {
        $this->isNewBuilding = $isNewBuilding;

        return $this;
    }

    public function getIsNewBuilding()
    {
        return $this->isNewBuilding;
    }

    public function setHasElevator($hasElevator)
    {
        $this->hasElevator = $hasElevator;

        return $this;
    }

    public function getHasElevator()
    {
        return $this->hasElevator;
    }

    public function setHasParking($hasParking)
    {
        $this->hasParking = $hasParking;

        return $this;
    }

    public function getHasParking()
    {
        return $this->hasParking;
    }

    public function setHasFurniture($hasFurniture)
    {
        $this->hasFurniture = $hasFurniture;

        return $this;
    }

    public function getHasFurniture()
    {
        return $this->hasFurniture;
    }

    public function setHasRegistration($hasRegistration)
    {
        $this->hasRegistration = $hasRegistration;

        return $this;
    }

    public function getHasRegistration()
    {
        return $this->hasRegistration;
    }
}

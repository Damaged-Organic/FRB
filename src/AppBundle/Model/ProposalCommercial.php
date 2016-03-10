<?php
// src/AppBundle/Model/ProposalCommercial.php
namespace AppBundle\Model;

use Symfony\Component\Validator\Constraints as Assert;

use AppBundle\Validator\Constraints as CustomAssert;

class ProposalCommercial
{
    /**
     * @Assert\NotBlank(
     *      message="proposal.common.name.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 2,
     *      max = 200,
     *      minMessage = "proposal.common.name.length.min",
     *      maxMessage = "proposal.common.name.length.max"
     * )
     */
    protected $name;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.phone.not_blank"
     * )
     *
     * @CustomAssert\IsPhoneConstraint
     */
    protected $phone;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.email.not_blank"
     * )
     *
     * @Assert\Email(
     *      message="proposal.common.email.valid",
     *      checkMX=true
     * )
     */
    protected $email;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.type.not_blank"
     * )
     *
     * @CustomAssert\IsTypeCommercialValidConstraint
     */
    protected $type;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.city.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 250,
     *      minMessage = "proposal.common.city.length.min",
     *      maxMessage = "proposal.common.city.length.max"
     * )
     */
    protected $city;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.street.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 250,
     *      minMessage = "proposal.common.street.length.min",
     *      maxMessage = "proposal.common.street.length.max"
     * )
     */
    protected $street;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.house.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 250,
     *      minMessage = "proposal.common.house.length.min",
     *      maxMessage = "proposal.common.house.length.max"
     * )
     */
    protected $house;

    /**
     * @Assert\NotBlank(
     *      message="proposal.commercial.space.not_blank"
     * )
     *
     * @Assert\Length(
     *      min = 1,
     *      max = 1000,
     *      minMessage="proposal.common.space.length.min",
     *      maxMessage="proposal.common.space.length.max"
     * )
     */
    protected $space;

    /**
     * @Assert\NotBlank(
     *      message="proposal.commercial.layout_type.not_blank"
     * )
     *
     * @CustomAssert\IsLayoutTypeValidConstraint
     */
    protected $layoutType;

    /**
     * @Assert\NotBlank(
     *      message="proposal.commercial.fit_out_type.not_blank"
     * )
     *
     * @CustomAssert\IsFitOutTypeValidConstraint
     */
    protected $fitOutType;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.trade_type.not_blank"
     * )
     *
     * @CustomAssert\IsTradeTypeValidConstraint
     */
    protected $tradeType;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.price_currency.not_blank"
     * )
     *
     * @Assert\Choice(
     *      choices = {"USD", "UAH"},
     *      message = "proposal.common.price_currency.valid"
     * )
     */
    protected $priceCurrency;

    /**
     * @Assert\Range(
     *      min = 1,
     *      minMessage="proposal.common.price_rent_value.range.min"
     * )
     */
    protected $priceRentValue;

    /**
     * @Assert\Range(
     *      min = 1,
     *      minMessage="proposal.common.price_sale_value.range.min"
     * )
     */
    protected $priceSaleValue;

    /**
     * @Assert\Range(
     *      min = 1,
     *      minMessage="proposal.commercial.operating_expense_value.range.min"
     * )
     */
    protected $operatingExpenseValue;

    /**
     * @Assert\Range(
     *      min = 0,
     *      max = 10000,
     *      minMessage="proposal.commercial.parking_bay_number.range.min",
     *      maxMessage="proposal.commercial.parking_bay_number.range.max"
     * )
     */
    protected $parkingBayNumber;

    /**
     * @Assert\Range(
     *      min = 1,
     *      minMessage="proposal.commercial.parking_bay_price_value.range.min"
     * )
     */
    protected $parkingBayPriceValue;

    /**
     * @Assert\Length(
     *      min = 2,
     *      max = 1000,
     *      minMessage = "proposal.common.description.length.min",
     *      maxMessage = "proposal.common.description.length.max"
     * )
     */
    protected $description;

    /**
     * @Assert\NotBlank(
     *      message="proposal.common.wasted.checked"
     * )
     *
     * @Assert\Type(
     *     type="bool",
     *     message="proposal.common.checkbox"
     * )
     */
    protected $wasted;

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

    public function setTradeType($tradeType)
    {
        $this->tradeType = $tradeType;

        return $this;
    }

    public function getTradeType()
    {
        return $this->tradeType;
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

    public function setPriceRentValue($priceRentValue)
    {
        $this->priceRentValue = $priceRentValue;

        return $this;
    }

    public function getPriceRentValue()
    {
        return $this->priceRentValue;
    }

    public function setPriceSaleValue($priceSaleValue)
    {
        $this->priceSaleValue = $priceSaleValue;

        return $this;
    }

    public function getPriceSaleValue()
    {
        return $this->priceSaleValue;
    }

    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setHouse($house)
    {
        $this->house = $house;

        return $this;
    }

    public function getHouse()
    {
        return $this->house;
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

    public function setLayoutType($layoutType)
    {
        $this->layoutType = $layoutType;

        return $this;
    }

    public function getLayoutType()
    {
        return $this->layoutType;
    }

    public function setFitOutType($fitOutType)
    {
        $this->fitOutType = $fitOutType;

        return $this;
    }

    public function getFitOutType()
    {
        return $this->fitOutType;
    }

    public function setOperatingExpenseValue($operatingExpenseValue)
    {
        $this->operatingExpenseValue = $operatingExpenseValue;

        return $this;
    }

    public function getOperatingExpenseValue()
    {
        return $this->operatingExpenseValue;
    }

    public function setParkingBayNumber($parkingBayNumber)
    {
        $this->parkingBayNumber = $parkingBayNumber;

        return $this;
    }

    public function getParkingBayNumber()
    {
        return $this->parkingBayNumber;
    }

    public function setParkingBayPriceValue($parkingBayPriceValue)
    {
        $this->parkingBayPriceValue = $parkingBayPriceValue;

        return $this;
    }

    public function getParkingBayPriceValue()
    {
        return $this->parkingBayPriceValue;
    }

    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setWasted($wasted)
    {
        $this->wasted = $wasted;

        return $this;
    }

    public function getWasted()
    {
        return $this->wasted;
    }
}

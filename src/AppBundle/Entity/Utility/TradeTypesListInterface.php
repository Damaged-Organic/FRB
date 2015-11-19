<?php
// src/AppBundle/Entity/Utility/TradeTypesListInterface.php
namespace AppBundle\Entity\Utility;

interface TradeTypesListInterface
{
    const TRADE_TYPE_RENT = "trade_type_rent";
    const TRADE_TYPE_SALE = "trade_type_sale";

    static public function getTradeTypes();
}
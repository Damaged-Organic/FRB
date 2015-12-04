<?php
// src/AppBundle/Service/Filter/Utility/Interfaces/FilterArgumentsInterface.php
namespace AppBundle\Service\Filter\Utility\Interfaces;

interface FilterArgumentsInterface
{
    const FILTER_ROOT = 'filter_arguments';

    const FILTER_DISTRICTS   = 'districts';
    const FILTER_ESTATE_TYPE = 'estate_type';
    const FILTER_TRADE_TYPE  = 'trade_type';
    const FILTER_CURRENCY    = 'currency';
    const FILTER_PRICE       = 'price';
    const FILTER_SPACE       = 'space';
}

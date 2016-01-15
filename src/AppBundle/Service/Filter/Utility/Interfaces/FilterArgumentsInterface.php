<?php
// src/AppBundle/Service/Filter/Utility/Interfaces/FilterArgumentsInterface.php
namespace AppBundle\Service\Filter\Utility\Interfaces;

interface FilterArgumentsInterface
{
    const FILTER_ROOT = 'filter_arguments';

    const FILTER_DISTRICTS        = 'districts';
    const FILTER_ESTATE_TYPE      = 'estate_type';
    const FILTER_TRADE_TYPE       = 'trade_type';
    const FILTER_CURRENCY         = 'currency';
    const FILTER_PRICE            = 'price';
    const FILTER_PRICE_PER_SQUARE = 'price_per_square';
    const FILTER_SPACE            = 'space';
    const FILTER_SPACE_PLOT       = 'space_plot';
    const FILTER_FEATURES         = 'features';
    const FILTER_ATTRIBUTES       = 'attributes';

    const FILTER_SEARCH = 'search';
}

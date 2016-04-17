<?php
// src/AppBundle/Entity/Repository/EstateRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\Query,
    Doctrine\ORM\Tools\Pagination\Paginator;

use AppBundle\Service\Filter\Utility\Interfaces\FilterArgumentsInterface,
    AppBundle\Entity\Repository\Contract\CustomEntityRepository,
    AppBundle\Entity\EstateType,
    AppBundle\Service\Filter\Utility\Currency;

class EstateRepository extends CustomEntityRepository implements FilterArgumentsInterface
{
    public function find($id)
    {
        //TODO: This is kludge for Sonata
        $id = ( is_array($id) ) ? $id['id'] : $id;

        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ea, eat, ef')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('e.estateFeatures', 'ef')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('e.id = :id')
            ->setParameter('id', $id)
            ->getQuery()
        ;

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getOneOrNullResult();
    }

    public function findActive($id)
    {
        //TODO: This is kludge for Sonata
        $id = ( is_array($id) ) ? $id['id'] : $id;

        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ea, eat, ef')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('e.estateFeatures', 'ef')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('e.id = :id')
            ->andWhere('e.isActive = :isActive')
            ->setParameters([
                'id'       => $id,
                'isActive' => TRUE
            ])
            ->getQuery()
        ;

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getOneOrNullResult();
    }

    public function getNearestEstates($id)
    {
        $previous = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.id < :id')
            ->andWhere('e.isActive = :isActive')
            ->setParameters([
                'id'       => $id,
                'isActive' => TRUE
            ])
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $next = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.id > :id')
            ->andWhere('e.isActive = :isActive')
            ->setParameters([
                'id'       => $id,
                'isActive' => TRUE
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return [
            'previous' => $previous,
            'next'     => $next
        ];
    }

    public function findByType(EstateType $estateType, $page = NULL, $results_per_page = NULL)
    {
        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ea, eat, ef')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('e.estateFeatures', 'ef')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('et.parent = :estateType')
            ->andWhere('e.isActive = :isActive')
            ->setParameter('estateType', $estateType)
            ->setParameter('isActive', TRUE)
        ;

        if( $page && $results_per_page )
        {
            $first_record = ($page * $results_per_page) - $results_per_page;

            $query
                ->setFirstResult($first_record)
                ->setMaxResults($results_per_page)
            ;
        }

        $query = $query->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        if( $page && $results_per_page ) {
            return new Paginator($query);
        } else {
            return $query->getResult();
        }
    }

    public function findByTypeAndFilterArguments(EstateType $estateType, array $filterArguments, $currency, $page, $results_per_page)
    {
        $first_record = ($page * $results_per_page) - $results_per_page;

        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ef, ea, eat')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateFeatures', 'ef')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('et.parent = :estateType')
            ->andWhere('e.isActive = :isActive')
            ->setParameter('estateType', $estateType)
            ->setParameter('isActive', TRUE)
        ;

        if( !empty($filterArguments[self::FILTER_SEARCH]) ) {
            $query = $this->filterArgumentsSearch($query, $filterArguments);
        } else {
            $query = $this->filterArgumentsEstateType($query, $filterArguments);
            $query = $this->filterArgumentsTradeType($query, $filterArguments);
            $query = $this->filterArgumentsPrice($query, $filterArguments, $currency);
            $query = $this->filterArgumentsPricePerSquareRange($query, $filterArguments, $currency);
            $query = $this->filterArgumentsSpace($query, $filterArguments);
            $query = $this->filterArgumentsSpacePlot($query, $filterArguments);
            $query = $this->filterArgumentsFeatures($query, $filterArguments);
            $query = $this->filterArgumentsAttributes($query, $filterArguments);
            $query = $this->filterArgumentsDistricts($query, $filterArguments);
        }

        $query = $query
            ->setFirstResult($first_record)
            ->setMaxResults($results_per_page)
            ->getQuery()
        ;

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return new Paginator($query);
    }

    private function filterArgumentsEstateType($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_ESTATE_TYPE]) )
        {
            $query
                ->andWhere('et.id = :estateTypeId')
                ->setParameter('estateTypeId', $filterArguments[self::FILTER_ESTATE_TYPE])
            ;
        }

        return $query;
    }

    private function filterArgumentsTradeType($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_TRADE_TYPE]) )
        {
            $query
                ->andWhere('e.tradeType = :tradeType')
                ->setParameter('tradeType', $filterArguments[self::FILTER_TRADE_TYPE])
            ;
        }

        return $query;
    }

    private function filterArgumentsPrice($query, $filterArguments, $currency)
    {
        if( !empty($filterArguments[self::FILTER_PRICE]) )
        {
            if( $currency == Currency::CURRENCY_CODE_USD ) {
                $field = 'priceUSD';
            } else {
                $field = 'priceUAH';
            }

            $query
                ->andWhere("e.{$field} >= :price_min")
                ->andWhere("e.{$field} <= :price_max")
                ->setParameter('price_min', $filterArguments[self::FILTER_PRICE]['min'])
                ->setParameter('price_max', $filterArguments[self::FILTER_PRICE]['max'])
            ;
        }

        return $query;
    }

    private function filterArgumentsPricePerSquareRange($query, $filterArguments, $currency)
    {
        if( !empty($filterArguments[self::FILTER_PRICE_PER_SQUARE]) )
        {
            if( $currency == Currency::CURRENCY_CODE_USD ) {
                $field = 'pricePerSquareUSD';
            } else {
                $field = 'pricePerSquareUAH';
            }

            $query
                ->andWhere("e.{$field} >= :price_per_square_min")
                ->andWhere("e.{$field} <= :price_per_square_max")
                ->setParameter('price_per_square_min', $filterArguments[self::FILTER_PRICE_PER_SQUARE]['min'])
                ->setParameter('price_per_square_max', $filterArguments[self::FILTER_PRICE_PER_SQUARE]['max'])
            ;
        }

        return $query;
    }

    private function filterArgumentsSpace($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_SPACE]) )
        {
            $query
                ->andWhere('e.space >= :space_min')
                ->andWhere('e.space <= :space_max')
                ->setParameter('space_min', $filterArguments[self::FILTER_SPACE]['min'])
                ->setParameter('space_max', $filterArguments[self::FILTER_SPACE]['max'])
            ;
        }

        return $query;
    }

    private function filterArgumentsSpacePlot($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_SPACE_PLOT]) )
        {
            $query
                ->andWhere('e.spacePlot >= :space_plot_min')
                ->andWhere('e.spacePlot <= :space_plot_max')
                ->setParameter('space_plot_min', $filterArguments[self::FILTER_SPACE_PLOT]['min'])
                ->setParameter('space_plot_max', $filterArguments[self::FILTER_SPACE_PLOT]['max'])
            ;
        }

        return $query;
    }

    private function filterArgumentsFeatures($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_FEATURES]) )
        {
            $index = 0;

            foreach( $filterArguments[self::FILTER_FEATURES] as $feature => $value )
            {
                $value = ( $value == 'yes' ) ? TRUE : FALSE;

                $query
                    ->andWhere("ef.{$feature} = :value_{$index}")
                    ->setParameter("value_{$index}", $value)
                ;

                $index++;
            }
        }

        return $query;
    }

    private function filterArgumentsAttributes($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_ATTRIBUTES]) )
        {
            $estateIdsDirty = [];

            $index = 0;

            foreach( $filterArguments[self::FILTER_ATTRIBUTES] as $attribute => $range )
            {
                $qb = $this->_em->createQueryBuilder();

                $subQuery = $qb
                    ->select("IDENTITY(ea.estate) as estate_id")
                    ->from('AppBundle\Entity\EstateAttribute', "ea")
                    ->leftJoin('AppBundle\Entity\Estate', 'e', 'WITH', 'e.id = ea.estate')
                    ->where('e.isActive = :isActive')
                    ->andWhere(
                        $qb->expr()->andX(
                            $qb->expr()->eq("ea.estateAttributeType", ":attribute"),
                            $qb->expr()->gte("ea.value", ":value_min"),
                            $qb->expr()->lte("ea.value", ":value_max")
                        )
                    )
                    ->groupBy('estate_id')
                    ->setParameters([
                        "isActive"  => TRUE,
                        "attribute" => (int)$attribute,
                        "value_min" => (int)$range['min'],
                        "value_max" => (int)$range['max']
                    ])
                    ->getQuery()
                ;

                // KLUDGY!
                $estateIdsDirty[] = ( $subQuery->getScalarResult() ) ?: [0 => ['estate_id' => 0]];
            }

            if( $estateIdsDirty )
            {
                $estateIds = [];

                foreach( $estateIdsDirty as $index => $scalarResult )
                {
                    foreach( $scalarResult as $estateAttribute )
                        $estateIds[$index][] = $estateAttribute['estate_id'];
                }

                if( $estateIds )
                {
                    // KLUDGY!
                    if( count($estateIds) > 1 )
                        $estateIds = call_user_func_array('array_intersect', $estateIds);
                    else
                        $estateIds = $estateIds[0];

                    $query
                        ->andWhere('e.id IN (:estateIds)')
                        ->setParameter('estateIds', $estateIds)
                    ;
                }
            }
        }

        return $query;
    }

    private function filterArgumentsDistricts($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_DISTRICTS]) )
        {
            $query
                ->andWhere('e.district IN (:districts)')
                ->setParameter('districts', $filterArguments[self::FILTER_DISTRICTS])
            ;
        }

        return $query;
    }

    private function filterArgumentsSearch($query, $filterArguments)
    {
        if( !empty($filterArguments[self::FILTER_SEARCH]) )
        {
            $query
                ->andWhere('e.code LIKE :code')
                ->setParameter('code', '%' . $filterArguments[self::FILTER_SEARCH] . '%')
            ;
        }

        return $query;
    }
}

<?php
// src/AppBundle/Entity/Repository/EstateRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\Query;

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
            ->select('e, ep, et, ea, eat')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
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

    public function findByType(EstateType $estateType)
    {
        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ea, eat')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('et.parent = :estateType')
            ->setParameter('estateType', $estateType)
            ->getQuery()
        ;

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }

    public function findByTypeAndFilterArguments(EstateType $estateType, array $filterArguments, $currency)
    {
        $query = $this->createQueryBuilder('e')
            ->select('e, ep, et, ea, eat')
            ->leftJoin('e.estatePhoto', 'ep')
            ->leftJoin('e.estateType', 'et')
            ->leftJoin('e.estateAttribute', 'ea')
            ->leftJoin('ea.estateAttributeType', 'eat')
            ->where('et.parent = :estateType')
            ->setParameter('estateType', $estateType);
        ;

        if( !empty($filterArguments[self::FILTER_DISTRICTS]) )
        {
            $query
                ->andWhere('e.district IN (:districts)')
                ->setParameter('districts', $filterArguments[self::FILTER_DISTRICTS])
            ;
        }

        if( !empty($filterArguments[self::FILTER_ESTATE_TYPE]) )
        {
            $query
                ->andWhere('et.id = :estateTypeId')
                ->setParameter('estateTypeId', $filterArguments[self::FILTER_ESTATE_TYPE])
            ;
        }

        if( !empty($filterArguments[self::FILTER_TRADE_TYPE]) )
        {
            $query
                ->andWhere('e.tradeType = :tradeType')
                ->setParameter('tradeType', $filterArguments[self::FILTER_TRADE_TYPE])
            ;
        }

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

        if( !empty($filterArguments[self::FILTER_SPACE]) )
        {
            $query
                ->andWhere('e.space >= :space_min')
                ->andWhere('e.space <= :space_max')
                ->setParameter('space_min', $filterArguments[self::FILTER_SPACE]['min'])
                ->setParameter('space_max', $filterArguments[self::FILTER_SPACE]['max'])
            ;
        }

        $query = $query->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }

    public function getNearestEstates($id)
    {
        $previous = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.id < :id')
            ->setParameter('id', $id)
            ->orderBy('e.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $next = $this->createQueryBuilder('e')
            ->select('e')
            ->where('e.id > :id')
            ->setParameter('id', $id)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        return [
            'previous' => $previous,
            'next'     => $next
        ];
    }
}

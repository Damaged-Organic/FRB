<?php
// src/AppBundle/Entity/Repository/EstateRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\Query;

use AppBundle\Entity\Repository\Contract\CustomEntityRepository,
    AppBundle\Entity\EstateType;

class EstateRepository extends CustomEntityRepository
{
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
}
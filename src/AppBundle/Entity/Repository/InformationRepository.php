<?php
// src/AppBundle/Entity/Repository/InformationRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\Query;

use AppBundle\Entity\Repository\Contract\CustomEntityRepository;

class InformationRepository extends CustomEntityRepository
{
    public function findByCategories(array $categories)
    {
        $query = $this->createQueryBuilder('i')
            ->select('i, ic')
            ->leftJoin('i.informationCategory', 'ic')
            ->where('ic.alias IN (:categories)')
            ->setParameter(':categories', $categories)
            ->getQuery()
        ;

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }
}
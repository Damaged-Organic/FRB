<?php
// src/AppBundle/Entity/Repository/ArticleRepository.php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Repository\Contract\CustomEntityRepository;

class ArticleRepository extends CustomEntityRepository
{
    public function count()
    {
        $query = $this
            ->createQueryBuilder('a')
            ->select('count(a.id)')
            ->getQuery();

        return $query->getSingleScalarResult();
    }
}
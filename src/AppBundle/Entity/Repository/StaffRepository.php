<?php
// src/AppBundle/Entity/Repository/StaffRepository.php
namespace AppBundle\Entity\Repository;

use AppBundle\Entity\Repository\Contract\CustomEntityRepository;

class StaffRepository extends CustomEntityRepository
{
    public function findByServices(array $services)
    {
        $query = $this->createQueryBuilder('st')
            ->select('st, sr')
            ->leftJoin('st.services', 'sr')
            ->where('sr.alias IN (:services)')
            ->setParameter('services', $services)
            ->getQuery();

        return $query->getResult();
    }
}
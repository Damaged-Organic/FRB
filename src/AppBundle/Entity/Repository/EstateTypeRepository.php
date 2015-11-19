<?php
// src/AppBundle/Entity/Repository/EstateTypeRepository.php
namespace AppBundle\Entity\Repository;

use Doctrine\ORM\Query;

use AppBundle\Entity\Repository\Contract\CustomEntityRepository;

class EstateTypeRepository extends CustomEntityRepository
{
    public function findMajorTypes()
    {
        $query = $this->createQueryBuilder("estateType")
            ->select("estateType")
            ->where("estateType.parent = :parent")
            ->setParameter("parent", NULL)
            ->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }

    public function findMinorTypes()
    {
        $query = $this->createQueryBuilder("estateType")
            ->select("estateType")
            ->where("estateType.parent <> :parent")
            ->setParameter("parent", NULL)
            ->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }

    public function findSpecificType($parentId)
    {
        $query = $this->createQueryBuilder("estateType")
            ->select("estateType.stringId, estateType.title")
            ->where("estateType.parent = :parent")
            ->setParameter("parent", $parentId)
            ->getQuery();

        $query->setHint(
            Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        return $query->getResult();
    }
}
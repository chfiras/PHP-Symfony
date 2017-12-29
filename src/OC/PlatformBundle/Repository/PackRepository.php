<?php
// src/OC/PlatformBundle/Repository/AdvertRepository.php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

class PackRepository extends EntityRepository
{
    public function getPacks()
    {
        $qb = $this->createQueryBuilder('a')
            ->addSelect('a')
            ->getQuery()
            ->getResult()
            ;
        return $qb;

    }
}

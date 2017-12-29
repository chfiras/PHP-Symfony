<?php
namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;


class NomDeDomaineRepository extends EntityRepository
{

    public function getLikeQueryBuilder($pattern)
    {
        return $this
            ->createQueryBuilder('c')
            ->where('c.DateDExpiration LIKE :pattern')
            ->setParameter('pattern', $pattern)
            ;
    }

    public function findNomDeDomaine()
    {

        $query = $this->createQueryBuilder('n')
            //->innerJoin('Advert', 'a')
            ->addSelect('n')
            //->orderBy('a.date', 'ASC')
            ->getQuery();

        return new Paginator($query, true);
    }
}

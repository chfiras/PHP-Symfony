<?php
// src/OC/PlatformBundle/Repository/FacturationRepository.php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;

class FacturationRepository extends EntityRepository
{


  public function getFactures()
  {
      $query = $this->createQueryBuilder('a')
          ->leftJoin('a.blocFacture','b')
          ->addSelect('b')
          ->getQuery()
          //->getResult()
      ;
      return new Paginator($query, true);
  }





}

<?php
// src/OC/PlatformBundle/Repository/SiteWebRepository.php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class SiteWebRepository extends EntityRepository
{
  public function getLikeQueryBuilder($pattern)
  {
    return $this
      ->createQueryBuilder('c')
      ->where('c.name LIKE :pattern')
      ->setParameter('pattern', $pattern)
    ;
  }
}

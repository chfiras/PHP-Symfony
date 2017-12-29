<?php
// src/OC/PlatformBundle/Repository/TelFaxRepository.php

namespace OC\PlatformBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TelFaxRepository extends EntityRepository
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

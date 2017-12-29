<?php
// src/OC/PlatformBundle/Entity/TelFax.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_TelFax")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\TelFaxRepository")
 */
class TelFax
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="name", type="string", length=255)
   */
  private $name;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getName()
  {
    return $this->name;
  }
}

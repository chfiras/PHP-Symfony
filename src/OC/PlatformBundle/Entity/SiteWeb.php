<?php
// src/OC/PlatformBundle/Entity/SiteWeb.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_SiteWeb")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\SiteWebRepository")
 */
class SiteWeb
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
   * @ORM\Column(name="Param", type="string", length=255)
   */
  private $Param;

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

    /**
     * @param string $Param
     */
    public function setParam($Param)
    {
        $this->Param = $Param;
    }

    /**
     * @return string
     */
    public function getParam()
    {
        return $this->Param;
    }
}

<?php
// src/OC/PlatformBundle/Entity/BaseDeDonnee.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_BaseDeDonnee")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\BaseDeDonneeRepository")
 */
class BaseDeDonnee
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="Identifiant", type="string", length=255)
   */
  private $Identifiant;

  /**
   * @ORM\Column(name="Password", type="string", length=255)
   */
  private $Password;

  /**
   * @ORM\Column(name="NomBase", type="string", length=255)
   */
  private $NomBase;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $Identifiant
   */
  public function setIdentifiant($Identifiant)
  {
    $this->Identifiant = $Identifiant;
  }

  /**
   * @return string
   */
  public function getIdentifiant()
  {
    return $this->Identifiant;
  }

  /**
   * @param string $Password
   */
  public function setPassword($Password)
  {
    $this->Password = $Password;
  }

  /**
   * @return string
   */
  public function getPassword()
  {
    return $this->Password;
  }

  /**
   * @param string $NomBase
   */
  public function setNomBase($NomBase)
  {
    $this->NomBase = $NomBase;
  }

  /**
   * @return string
   */
  public function getNomBase()
  {
    return $this->NomBase;
  }
}

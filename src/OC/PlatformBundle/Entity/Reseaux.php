<?php
// src/OC/PlatformBundle/Entity/Reseaux.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_Reseaux")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ReseauxRepository")
 */
class Reseaux
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="TypeRes", type="string", length=255)
   */
  private $TypeRes;

  /**
   * @ORM\Column(name="NomUtilisateur", type="string", length=255)
   */
  private $NomUtilisateur;

  /**
   * @ORM\Column(name="Password", type="string", length=255)
   */
  private $Password;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $TypeRes
   */
  public function setTypeRes($TypeRes)
  {
    $this->TypeRes = $TypeRes;
  }

  /**
   * @return string
   */
  public function getTypeRes()
  {
    return $this->TypeRes;
  }

  /**
   * @param string $NomUtilisateur
   */
  public function setNomUtilisateur($NomUtilisateur)
  {
    $this->NomUtilisateur = $NomUtilisateur;
  }

  /**
   * @return string
   */
  public function getNomUtilisateur()
  {
    return $this->NomUtilisateur;
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
}

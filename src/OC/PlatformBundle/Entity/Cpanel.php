<?php
// src/OC/PlatformBundle/Entity/Cpanel.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_Cpanel")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\CpanelRepository")
 */
class Cpanel
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="NomUtilisateur", type="string", length=255)
   */
  private $NomUtilisateur;

  /**
   * @ORM\Column(name="Password", type="string", length=255)
   */
  private $Password;

  /**
   * @ORM\Column(name="Chemin", type="string", length=255)
   */
  private $Chemin;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
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

  /**
   * @param string $Chemin
   */
  public function setChemin($Chemin)
  {
    $this->Chemin = $Chemin;
  }

  /**
   * @return string
   */
  public function getChemin()
  {
    return $this->Chemin;
  }
}

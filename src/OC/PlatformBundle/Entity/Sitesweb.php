<?php
// src/OC/PlatformBundle/Entity/Sitesweb.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_Sitesweb")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\SiteswebRepository")
 */
class Sitesweb
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="URL", type="string", length=255)
   */
  private $URL;

  /**
   * @ORM\Column(name="user", type="string", length=255)
   */
  private $user;

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
   * @param string $URL
   */
  public function setURL($URL)
  {
    $this->URL = $URL;
  }

  /**
   * @return string
   */
  public function getURL()
  {
    return $this->URL;
  }

  /**
   * @param string $user
   */
  public function setuser($user)
  {
    $this->user = $user;
  }

  /**
   * @return string
   */
  public function getuser()
  {
    return $this->user;
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

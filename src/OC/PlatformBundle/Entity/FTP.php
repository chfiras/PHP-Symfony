<?php
// src/OC/PlatformBundle/Entity/FTP.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_FTP")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\FTPRepository")
 */
class FTP
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="user", type="string", length=255)
   */
  private $user;

  /**
   * @ORM\Column(name="Password", type="string", length=255)
   */
  private $Password;

  /**
   * @ORM\Column(name="host", type="string", length=255)
   */
  private $host;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
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

  /**
   * @param string $host
   */
  public function sethost($host)
  {
    $this->host = $host;
  }

  /**
   * @return string
   */
  public function gethost()
  {
    return $this->host;
  }
}

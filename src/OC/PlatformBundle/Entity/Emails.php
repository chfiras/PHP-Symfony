<?php
// src/OC/PlatformBundle/Entity/Emails.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_Emails")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\EmailsRepository")
 */
class Emails
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @ORM\Column(name="Email", type="string", length=255)
   */
  private $Email;

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
   * @param string $Email
   */
  public function setEmail($Email)
  {
    $this->Email = $Email;
  }

  /**
   * @return string
   */
  public function getEmail()
  {
    return $this->Email;
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

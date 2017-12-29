<?php
// src/OC/PlatformBundle/Entity/NomDeDomaine.php

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Context\ExecutionContextInterface;



/**
 * @ORM\Table(name="oc_NomDeDomaine")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\NomDeDomaineRepository")
 */
class NomDeDomaine
{
  /**
   * @ORM\Column(name="id", type="integer")
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  private $id;

  /**
   * @Assert\Date()
   * @ORM\Column(name="DateDeCreation", type="date", length=255)
   */
  public $DateDeCreation;

  /**
   * @Assert\Date()
   * @ORM\Column(name="DateDExpiration", type="date", length=255)
   */
  public $DateDExpiration;

  /**
   * @var string
   *
   * @ORM\Column(name="Remarque", type="string", length=255)
   */
  private $Remarque;

    /**
     * @var string
     *
     * @ORM\Column(name="Domaine", type="string", length=255)
     */
    private $Domaine;

  /**
   * @var integer
   * @ORM\Column(name="etat",type="integer")
   */
  private $etat = 1;

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param string $DateDeCreation
   */
  public function setDateDeCreation($DateDeCreation)
  {
    $this->DateDeCreation = $DateDeCreation;
  }

  /**
   * @return string
   */
  public function getDateDeCreation()
  {
    return $this->DateDeCreation;
  }

  /**
   * @param string $DateDExpiration
   */
  public function setDateDExpiration($DateDExpiration)
  {
    $this->DateDExpiration = $DateDExpiration;
  }

  /**
   * @return string
   */
  public function getDateDExpiration()
  {
    return $this->DateDExpiration;
  }

  /**
   * @param string $Remarque
   */
  public function setRemarque($Remarque)
  {
    $this->Remarque = $Remarque;
  }

  /**
   * @return string
   */
  public function getRemarque()
  {
    return $this->Remarque;
  }


    /**
     * @param string $Remarque
     */
    public function setDomaine($Domaine)
    {
        $this->Domaine = $Domaine;
    }

    /**
     * @return string
     */
    public function getDomaine()
    {
        return $this->Domaine;
    }


    /**
     * @param integer $etat
     */
    public function setetat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return integer
     */
    public function getetat()
    {
        return $this->etat;
    }





    /**
     * @Assert\Callback
     */
    public function validate(ExecutionContextInterface $context)
    {
        // Do your checks
        if ( ($this->DateDExpiration != '') &&
               ($this->DateDExpiration < $this->DateDeCreation) ) {

            $context->buildViolation('La date d\'expiration doit être supérieure à la date de création')
            ->atPath('DateDExpiration')
            ->addViolation();

        }
    }

}

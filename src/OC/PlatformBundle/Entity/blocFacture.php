<?php

namespace OC\PlatformBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="oc_blocFacture")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\blocFactureRepository")
 */
class blocFacture
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @Assert\Type("numeric",message="Le montant ne doit contenir que des chiffres")
     * @ORM\Column(name="montant", type="string", length=255)
     */
    private $montant;

    /**
     * @ORM\Column(name="DateFin", type="date", length=255)
     */
    private $DateFin;

    /**
     * @ORM\Column(name="note", type="string", length=255,nullable = true)
     */
    private $note;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $categorie
     */
    public function setcategorie($categorie)
    {
        $this->categorie = $categorie;
    }

    /**
     * @return string
     */
    public function getcategorie()
    {
        return $this->categorie;
    }

    /**
     * @param string $montant
     */
    public function setmontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return string
     */
    public function getmontant()
    {
        return $this->montant;
    }

    /**
     * @param string $note
     */
    public function setnote($note)
    {
        $this->note = $note;
    }

    /**
     * @return string
     */
    public function getnote()
    {
        return $this->note;
    }

    /**
     * @param string $DateFin
     */
    public function setDateFin($DateFin)
    {
        $this->DateFin = $DateFin;
    }

    /**
     * @return string
     */
    public function getDateFin()
    {
        return $this->DateFin;
    }

}
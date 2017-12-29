<?php


namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Table(name="oc_facturation")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\FacturationRepository")
 * @UniqueEntity("Periode", message="Il existe déjà une facture pendant cette période !")
 * @ORM\HasLifecycleCallbacks()
 */


class Facturation
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\blocFacture", cascade={"persist"})
     * @ORM\JoinTable(name="oc_Facturation_blocFacture")
     */
    private $blocFacture;

    /**
     * @ORM\Column(name="Periode", type="date", length=255)
     */
    private $Periode;


    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;




    public function __construct()
    {

        $this->date = new \Datetime();
        $this->blocFacture = new ArrayCollection();

    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param blocFacture $blocFacture
     */
    public function addblocFacture(blocFacture $blocFacture)
    {
        $this->blocFacture[] = $blocFacture;
    }

    /**
     * @param blocFacture $blocFacture
     */
    public function removeblocFacture(blocFacture $blocFacture)
    {
        $this->blocFacture->removeElement($blocFacture);
    }

    /**
     * @return ArrayCollection
     */
    public function getblocFacture()
    {
        return $this->blocFacture;
    }

    /**
     * @param string $Periode
     */
    public function setPeriode($Periode)
    {
        $this->Periode = $Periode;
    }

    /**
     * @return string
     */
    public function getPeriode()
    {
        return $this->Periode;
    }



}
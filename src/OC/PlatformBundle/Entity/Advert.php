<?php

namespace OC\PlatformBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;



/**
 * @ORM\Table(name="oc_advert")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\AdvertRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Advert
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
   * @var \DateTime
   * @ORM\Column(name="date", type="datetime")
   */
  private $date;

  /**
   * @var string
   * @ORM\Column(name="MailPrincipal", type="string", length=255)
   */
  private $MailPrincipal;

    /**
     * @var string
     * @ORM\Column(name="Client", type="string", length=255)
     */
    private $Client;

    /**
     * @var string
     * @ORM\Column(name="Responsable", type="string", length=255)
     */
    private $Responsable;

    /**
     * @var string
     * @ORM\Column(name="MF", type="string", length=255)
     */
    private $MF;

  /**
   * @var string
   * @ORM\Column(name="Pack", type="string", length=255, nullable=true)
   */
  private $pack;

  /**
   * @var string
   *
   * @ORM\Column(name="Description", type="string", length=255)
   */
  private $Description;



  /**
   * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Image", cascade={"persist", "remove"})
   */
  private $image;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\SiteWeb", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_SiteWeb")
   */
  private $SiteWeb;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\NomDeDomaine", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_NomDeDomaine")
   */
  private $NomDeDomaine;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Emails", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_Emails")
   */
  private $Emails;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Reseaux", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_Reseaux")
   */
  private $Reseaux;


  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\BaseDeDonnee", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_BaseDeDonnee")
   */
  private $BaseDeDonnee;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Sitesweb", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_Sitesweb")
   */
  private $Sitesweb;

  /**
   * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\Cpanel", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_Cpanel")
   */
  private $Cpanel;

  /**
   * @ORM\OneToOne(targetEntity="OC\PlatformBundle\Entity\FTP", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_FTP")
   */
  private $FTP;


  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\TelFax", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_TelFax")
   */
  private $TelFax;

  /**
   * @ORM\ManyToMany(targetEntity="OC\PlatformBundle\Entity\Adresse", cascade={"persist"})
   * @ORM\JoinTable(name="oc_advert_Adresse")
   */
  private $Adresse;

  /**
   * @ORM\OneToMany(targetEntity="OC\PlatformBundle\Entity\Application", mappedBy="advert")
   */
  private $applications; // Notez le « s », une annonce est liée à plusieurs candidatures

  /**
   * @ORM\Column(name="updated_at", type="datetime", nullable=true)
   */
  private $updatedAt;

  /**
   * @ORM\Column(name="nb_applications", type="integer")
   */
  private $nbApplications = 0;

  /**
   * @Gedmo\Slug(fields={"MailPrincipal"})
   * @ORM\Column(name="slug", type="string", length=255, unique=true)
   */
  private $slug;

  public function __construct()
  {
    $this->date         = new \Datetime();
    $this->SiteWeb   = new ArrayCollection();
    $this->TelFax   = new ArrayCollection();
    $this->Adresse   = new ArrayCollection();
    $this->applications = new ArrayCollection();
    $this->BaseDeDonnee = new ArrayCollection();
    $this->NomDeDomaine = new ArrayCollection();
    $this->Sitesweb = new ArrayCollection();
    $this->Reseaux = new ArrayCollection();
    $this->Emails = new ArrayCollection();

  }

  /**
   * @ORM\PreUpdate
   */
  public function updateDate()
  {
    $this->setUpdatedAt(new \Datetime());
  }

  public function increaseApplication()
  {
    $this->nbApplications++;
  }

  public function decreaseApplication()
  {
    $this->nbApplications--;
  }

  /**
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @param \DateTime $date
   */
  public function setDate($date)
  {
    $this->date = $date;
  }

  /**
   * @return \DateTime
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * @param string $MailPrincipal
   */
  public function setMailPrincipal($MailPrincipal)
  {
    $this->MailPrincipal = $MailPrincipal;
  }

  /**
   * @return string
   */
  public function getMailPrincipal()
  {
    return $this->MailPrincipal;
  }

    /**
     * @param string $Client
     */
    public function setClient($Client)
    {
        $this->Client = $Client;
    }

    /**
     * @return string
     */
    public function getClient()
    {
        return $this->Client;
    }

    /**
     * @param string $Responsable
     */
    public function setResponsable($Responsable)
    {
        $this->Responsable = $Responsable;
    }

    /**
     * @return string
     */
    public function getResponsable()
    {
        return $this->Responsable;
    }

    /**
     * @param string $MF
     */
    public function setMF($MF)
    {
        $this->MF = $MF;
    }

    /**
     * @return string
     */
    public function getMF()
    {
        return $this->MF;
    }

    /**
     * @param string $pack
     */
    public function setpack($pack)
    {
        $this->pack = $pack;
    }

    /**
     * @return string
     */
    public function getpack()
    {
        return $this->pack;
    }


  /**
   * @param string $Description
   */
  public function setDescription($Description)
  {
    $this->Description = $Description;
  }

  /**
   * @return string
   */
  public function getDescription()
  {
    return $this->Description;
  }


  /**
   * @return Cpanel
   */
  public function getCpanel()
  {
    return $this->Cpanel;
  }


  /**
   * @param Cpanel $Cpanel
   */
  public function setCpanel($Cpanel)
  {
    $this->Cpanel = $Cpanel;
  }

  /**
   * @return FTP
   */
  public function getFTP()
  {
    return $this->FTP;
  }


  /**
   * @param FTP $FTP
   */
  public function setFTP($FTP)
  {
    $this->FTP = $FTP;
  }




  public function setImage(Image $image = null)
  {
    $this->image = $image;
  }

  public function getImage()
  {
    return $this->image;
  }

  /**
   * @param SiteWeb $SiteWeb
   */
  public function addSiteWeb(SiteWeb $SiteWeb)
  {
    $this->SiteWeb[] = $SiteWeb;
  }

  /**
   * @param SiteWeb $SiteWeb
   */
  public function removeSiteWeb(SiteWeb $SiteWeb)
  {
    $this->SiteWeb->removeElement($SiteWeb);
  }

  /**
   * @return ArrayCollection
   */
  public function getSiteWeb()
  {
    return $this->SiteWeb;
  }

  /**
   * @param NomDeDomaine $NomDeDomaine
   */
  public function addNomDeDomaine(NomDeDomaine $NomDeDomaine)
  {
    $this->NomDeDomaine[] = $NomDeDomaine;
  }

  /**
   * @param NomDeDomaine $NomDeDomaine
   */
  public function removeNomDeDomaine(NomDeDomaine $NomDeDomaine)
  {
    $this->NomDeDomaine->removeElement($NomDeDomaine);
  }

  /**
   * @return ArrayCollection
   */
  public function getNomDeDomaine()
  {
    return $this->NomDeDomaine;
  }

  /**
   * @param Emails $Emails
   */
  public function addEmails(Emails $Emails)
  {
    $this->Emails[] = $Emails;
  }

  /**
   * @param Emails $Emails
   */
  public function removeEmails(Emails $Emails)
  {
    $this->Emails->removeElement($Emails);
  }

  /**
   * @return ArrayCollection
   */
  public function getEmails()
  {
    return $this->Emails;
  }


  /**
   * @param Reseaux $Reseaux
   */
  public function addReseaux(Reseaux $Reseaux)
  {
    $this->Reseaux[] = $Reseaux;
  }

  /**
   * @param Reseaux $Reseaux
   */
  public function removeReseaux(Reseaux $Reseaux)
  {
    $this->Reseaux->removeElement($Reseaux);
  }

  /**
   * @return ArrayCollection
   */
  public function getReseaux()
  {
    return $this->Reseaux;
  }


  /**
   * @param Sitesweb $Sitesweb
   */
  public function addSitesweb(Sitesweb $Sitesweb)
  {
    $this->Sitesweb[] = $Sitesweb;
  }

  /**
   * @param Sitesweb $Sitesweb
   */
  public function removeSitesweb(Sitesweb $Sitesweb)
  {
    $this->Sitesweb->removeElement($Sitesweb);
  }

  /**
   * @return ArrayCollection
   */
  public function getSitesweb()
  {
    return $this->Sitesweb;
  }


  /**
   * @param BaseDeDonnee $BaseDeDonnee
   */
  public function addBaseDeDonnee(BaseDeDonnee $BaseDeDonnee)
  {
    $this->BaseDeDonnee[] = $BaseDeDonnee;
  }

  /**
   * @param BaseDeDonnee $BaseDeDonnee
   */
  public function removeBaseDeDonnee(BaseDeDonnee $BaseDeDonnee)
  {
    $this->BaseDeDonnee->removeElement($BaseDeDonnee);
  }

  /**
   * @return ArrayCollection
   */
  public function getBaseDeDonnee()
  {
    return $this->BaseDeDonnee;
  }



  /**
   * @param TelFax $TelFax
   */
  public function addTelFax(TelFax $TelFax)
  {
    $this->TelFax[] = $TelFax;
  }

  /**
   * @param TelFax $TelFax
   */
  public function removeTelFax(TelFax $TelFax)
  {
    $this->TelFax->removeElement($TelFax);
  }

  /**
   * @return ArrayCollection
   */
  public function getTelFax()
  {
    return $this->TelFax;
  }

  /**
   * @param Adresse $Adresse
   */
  public function addAdresse(Adresse $Adresse)
  {
    $this->Adresse[] = $Adresse;
  }

  /**
   * @param Adresse $Adresse
   */
  public function removeAdresse(Adresse $Adresse)
  {
    $this->Adresse->removeElement($Adresse);
  }

  /**
   * @return ArrayCollection
   */
  public function getAdresse()
  {
    return $this->Adresse;
  }

  /**
   * @param Application $application
   */
  public function addApplication(Application $application)
  {
    $this->applications[] = $application;

    // On lie l'annonce à la candidature
    $application->setAdvert($this);
  }

  /**
   * @param Application $application
   */
  public function removeApplication(Application $application)
  {
    $this->applications->removeElement($application);
  }

  /**
   * @return \Doctrine\Common\Collections\Collection
   */
  public function getApplications()
  {
    return $this->applications;
  }

  /**
   * @param \DateTime $updatedAt
   */
  public function setUpdatedAt(\Datetime $updatedAt = null)
  {
      $this->updatedAt = $updatedAt;
  }

  /**
   * @return \DateTime
   */
  public function getUpdatedAt()
  {
      return $this->updatedAt;
  }

  /**
   * @param integer $nbApplications
   */
  public function setNbApplications($nbApplications)
  {
      $this->nbApplications = $nbApplications;
  }

  /**
   * @return integer
   */
  public function getNbApplications()
  {
      return $this->nbApplications;
  }

  /**
   * @param string $slug
   */
  public function setSlug($slug)
  {
      $this->slug = $slug;
  }

  /**
   * @return string
   */
  public function getSlug()
  {
      return $this->slug;
  }


}

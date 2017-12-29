<?php
/**
 * Created by PhpStorm.
 * User: mah
 * Date: 27/07/17
 * Time: 09:29 م
 */

namespace OC\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="oc_Pack")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\PackRepository")
 * @ORM\HasLifecycleCallbacks()
 */

class Pack
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="string")
     */
    private $description;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param string $description
     */
    public function setdescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getdescription()
    {
        return $this->description;
    }

}
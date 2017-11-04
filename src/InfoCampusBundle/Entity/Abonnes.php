<?php

namespace InfoCampusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Abonnes
 *
 * @ORM\Table(name="abonnes")
 * @ORM\Entity(repositoryClass="InfoCampusBundle\Repository\AbonnesRepository")
 */
class Abonnes
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", nullable=true, length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", nullable=true, length=255)
     */
    private $prenom;
    /**
         * @var string
         *
         * @ORM\Column(name="type", type="string", length=255)
         */
        private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="numTel", type="string", length=255)
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="domaineInteret", type="string", nullable=true, length=255)
     */
    private $domaineInteret;

    /**
     * @var Niveau
     *
     * @ORM\ManyToOne(targetEntity="InfoCampusBundle\Entity\Niveau", cascade={"remove"})
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $niveau;

    /**
     * @var string
     * @Doctrine\ORM\Mapping\Column(type="string", nullable=false)
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var Facultes
     *
     * @ORM\ManyToOne(targetEntity="InfoCampusBundle\Entity\Facultes")
     * @ORM\JoinColumn(name="faculte_id", referencedColumnName="id")
     */
    private $faculte;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Abonnes
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Abonnes
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set numTel
     *
     * @param string $numTel
     *
     * @return Abonnes
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return string
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set domaineInteret
     *
     * @param string $domaineInteret
     *
     * @return Abonnes
     */
    public function setDomaineInteret($domaineInteret)
    {
        $this->domaineInteret = $domaineInteret;

        return $this;
    }

    /**
     * Get domaineInteret
     *
     * @return string
     */
    public function getDomaineInteret()
    {
        return $this->domaineInteret;
    }



    /**
     * Set password
     *
     * @param string $password
     *
     * @return Abonnes
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Abonnes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set faculte
     *
     * @param \InfoCampusBundle\Entity\Facultes $faculte
     *
     * @return Abonnes
     */
    public function setFaculte(\InfoCampusBundle\Entity\Facultes $faculte = null)
    {
        $this->faculte = $faculte;

        return $this;
    }

    /**
     * Get faculte
     *
     * @return \InfoCampusBundle\Entity\Facultes
     */
    public function getFaculte()
    {
        return $this->faculte;
    }

    /**
     * Set niveau
     *
     * @param \InfoCampusBundle\Entity\Niveau $niveau
     *
     * @return Abonnes
     */
    public function setNiveau(\InfoCampusBundle\Entity\Niveau $niveau = null)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return \InfoCampusBundle\Entity\Niveau
     */
    public function getNiveau()
    {
        return $this->niveau;
    }
}

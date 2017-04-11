<?php

namespace InfoCampusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Messages
 *
 * @ORM\Table(name="messages")
 * @ORM\Entity(repositoryClass="InfoCampusBundle\Repository\MessagesRepository")
 */
class Messages
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=255)
     */
    private $objet;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateReception", type="datetime")
     */
    private $dateReception;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnvoi", type="datetime")
     */
    private $dateEnvoi;

    /**
     * @var string
     *
     * @ORM\Column(name="statut", type="string", length=255)
     */
    private $statut;
    /**
     * @var Abonnes
     * @ORM\ManyToMany(targetEntity="Abonnes")
     * @ORM\JoinTable(name="Abonnes_Messages")
     */

    private $abonnes;
    /**
     * @var Facultes
     * @ORM\ManyToMany(targetEntity="Facultes")
     * @ORM\JoinTable(name="Messqges_Facultes")
     */
    private  $facultes;

    /**
     * @var Niveau
     *
     * @ORM\ManyToOne(targetEntity="InfoCampusBundle\Entity\Niveau")
     * @ORM\JoinColumn(name="niveau_id", referencedColumnName="id")
     */
    private $niveau;

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
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Messages
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Messages
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Messages
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateReception
     *
     * @param \DateTime $dateReception
     *
     * @return Messages
     */
    public function setDateReception($dateReception)
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get dateReception
     *
     * @return \DateTime
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set dateEnvoi
     *
     * @param \DateTime $dateEnvoi
     *
     * @return Messages
     */
    public function setDateEnvoi($dateEnvoi)
    {
        $this->dateEnvoi = $dateEnvoi;

        return $this;
    }

    /**
     * Get dateEnvoi
     *
     * @return \DateTime
     */
    public function getDateEnvoi()
    {
        return $this->dateEnvoi;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Messages
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->abonnes = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add abonne
     *
     * @param \InfoCampusBundle\Entity\Abonnes $abonne
     *
     * @return Messages
     */
    public function addAbonne(\InfoCampusBundle\Entity\Abonnes $abonne)
    {
        $this->abonnes[] = $abonne;

        return $this;
    }

    /**
     * Remove abonne
     *
     * @param \InfoCampusBundle\Entity\Abonnes $abonne
     */
    public function removeAbonne(\InfoCampusBundle\Entity\Abonnes $abonne)
    {
        $this->abonnes->removeElement($abonne);
    }

    /**
     * Get abonnes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAbonnes()
    {
        return $this->abonnes;
    }

    /**
     * Set facultes
     *
     * @param \InfoCampusBundle\Entity\Facultes $facultes
     *
     * @return Messages
     */
    public function setFacultes(\InfoCampusBundle\Entity\Facultes $facultes = null)
    {
        $this->facultes = $facultes;

        return $this;
    }

    /**
     * Get facultes
     *
     * @return \InfoCampusBundle\Entity\Facultes
     */
    public function getFacultes()
    {
        return $this->facultes;
    }

    /**
     * Add faculte
     *
     * @param \InfoCampusBundle\Entity\Facultes $faculte
     *
     * @return Messages
     */
    public function addFaculte(\InfoCampusBundle\Entity\Facultes $faculte)
    {
        $this->facultes[] = $faculte;

        return $this;
    }

    /**
     * Remove faculte
     *
     * @param \InfoCampusBundle\Entity\Facultes $faculte
     */
    public function removeFaculte(\InfoCampusBundle\Entity\Facultes $faculte)
    {
        $this->facultes->removeElement($faculte);
    }

    /**
     * Set niveau
     *
     * @param \InfoCampusBundle\Entity\Niveau $niveau
     *
     * @return Messages
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

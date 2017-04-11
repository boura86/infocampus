<?php

namespace InfoCampusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Niveau
 *
 * @ORM\Table(name="niveau")
 * @ORM\Entity(repositoryClass="InfoCampusBundle\Repository\NiveauRepository")
 */
class Niveau
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var Facultes
     * @ORM\ManyToOne(targetEntity="InfoCampusBundle\Entity\Facultes")
     * @ORM\JoinColumn(name="faculte_id", referencedColumnName="id")
     */
    private $facultes;
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
     * @return Niveau
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
     * Set facultes
     *
     * @param \InfoCampusBundle\Entity\Facultes $facultes
     *
     * @return Niveau
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
}

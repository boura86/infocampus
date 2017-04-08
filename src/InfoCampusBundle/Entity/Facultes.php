<?php

namespace InfoCampusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facultes
 *
 * @ORM\Table(name="facultes")
 * @ORM\Entity(repositoryClass="InfoCampusBundle\Repository\FacultesRepository")
 */
class Facultes
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
     * @var Structures
     * @ORM\ManyToOne(targetEntity="Structures")
     * @ORM\JoinColumn(name="structure_id", referencedColumnName="id")
     */
    private  $structure;


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
     * @return Facultes
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
     * Set structure
     *
     * @param \InfoCampusBundle\Entity\Structures $structure
     *
     * @return Facultes
     */
    public function setStructure(\InfoCampusBundle\Entity\Structures $structure = null)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure
     *
     * @return \InfoCampusBundle\Entity\Structures
     */
    public function getStructure()
    {
        return $this->structure;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transport
 *
 * @ORM\Table(name="transport")
 * @ORM\Entity
 */
class Transport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="place_depart", type="string", length=255, nullable=false)
     */
    private $placeDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="place_destination", type="string", length=255, nullable=false)
     */
    private $placeDestination;

    /**
     * @var string
     *
     * @ORM\Column(name="date_depart", type="string", length=255, nullable=false)
     */
    private $dateDepart;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_places", type="integer", nullable=false)
     */
    private $nbrePlaces;

    /**
     * @var string
     *
     * @ORM\Column(name="date_arrivee", type="string", length=255, nullable=false)
     */
    private $dateArrivee;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer", nullable=false)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_depart", type="string", length=255, nullable=false)
     */
    private $heureDepart;

    /**
     * @var string
     *
     * @ORM\Column(name="heure_arrivee", type="string", length=255, nullable=false)
     */
    private $heureArrivee;


}

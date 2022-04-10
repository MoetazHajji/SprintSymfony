<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity
 */
class Reservation
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
     * @var int
     *
     * @ORM\Column(name="id_client", type="integer", nullable=false)
     */
    private $idClient;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_cl", type="string", length=255, nullable=false)
     */
    private $nomCl;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom_cl", type="string", length=255, nullable=false)
     */
    private $prenomCl;

    /**
     * @var int
     *
     * @ORM\Column(name="nbre_places", type="integer", nullable=false)
     */
    private $nbrePlaces;

    /**
     * @var int
     *
     * @ORM\Column(name="prix_res", type="integer", nullable=false)
     */
    private $prixRes;

    /**
     * @var string
     *
     * @ORM\Column(name="date_res", type="string", length=255, nullable=false)
     */
    private $dateRes;

    /**
     * @var int
     *
     * @ORM\Column(name="tel_cl", type="integer", nullable=false)
     */
    private $telCl;

    /**
     * @var string
     *
     * @ORM\Column(name="email_cl", type="string", length=255, nullable=false)
     */
    private $emailCl;

    /**
     * @var int|null
     *
     * @ORM\Column(name="refact", type="integer", nullable=true)
     */
    private $refact;

    /**
     * @var int|null
     *
     * @ORM\Column(name="reftra", type="integer", nullable=true)
     */
    private $reftra;


}

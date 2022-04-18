<?php

namespace App\Entity;

use App\Repository\SponsorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SponsorRepository::class)
 */
class Sponsor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_sponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom_sponsor;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_sponsor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type_sponsor;

    /**
     * @ORM\Column(type="integer")
     */
    private $event_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSponsor(): ?string
    {
        return $this->nom_sponsor;
    }

    public function setNomSponsor(string $nom_sponsor): self
    {
        $this->nom_sponsor = $nom_sponsor;

        return $this;
    }

    public function getPrenomSponsor(): ?string
    {
        return $this->prenom_sponsor;
    }

    public function setPrenomSponsor(string $prenom_sponsor): self
    {
        $this->prenom_sponsor = $prenom_sponsor;

        return $this;
    }

    public function getNumSponsor(): ?int
    {
        return $this->num_sponsor;
    }

    public function setNumSponsor(int $num_sponsor): self
    {
        $this->num_sponsor = $num_sponsor;

        return $this;
    }

    public function getTypeSponsor(): ?string
    {
        return $this->type_sponsor;
    }

    public function setTypeSponsor(string $type_sponsor): self
    {
        $this->type_sponsor = $type_sponsor;

        return $this;
    }

    public function getEventId(): ?int
    {
        return $this->event_id;
    }

    public function setEventId(int $event_id): self
    {
        $this->event_id = $event_id;

        return $this;
    }
}

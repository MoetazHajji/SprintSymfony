<?php

namespace App\Entity;

use App\Repository\ReservationRRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRRepository::class)
 */
class ReservationR
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbrpersonneR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $timeR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dateR;

    /**
     * @ORM\ManyToOne(targetEntity=Restau::class, inversedBy="reservationRs")
     */
    private $idR;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservationRs",)
     */
    private $iduser;

    /**
     * @ORM\ManyToOne(targetEntity=Userrr::class, inversedBy="reservationRs",)
     */
    private $idu;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbrpersonneR(): ?int
    {
        return $this->nbrpersonneR;
    }

    public function setNbrpersonneR(int $nbrpersonneR): self
    {
        $this->nbrpersonneR = $nbrpersonneR;

        return $this;
    }

    public function getTimeR(): ?string
    {
        return $this->timeR;
    }

    public function setTimeR(string $timeR): self
    {
        $this->timeR = $timeR;

        return $this;
    }

    public function getDateR(): ?string
    {
        return $this->dateR;
    }

    public function setDateR(string $dateR): self
    {
        $this->dateR = $dateR;

        return $this;
    }

    public function getIdR(): ?restau
    {
        return $this->idR;
    }

    public function setIdR(?restau $idR): self
    {
        $this->idR = $idR;

        return $this;
    }

    public function getIduser(): ?User
    {
        return $this->iduser;
    }

    public function setIduser(?User $iduser): self
    {
        $this->iduser = $iduser;

        return $this;
    }

    public function getIdu(): ?Userrr
    {
        return $this->idu;
    }

    public function setIdu(?Userrr $idu): self
    {
        $this->idu = $idu;

        return $this;
    }

}

<?php

namespace App\Entity;

use App\Repository\RestauRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=RestauRepository::class)
 */
class Restau
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
    private $typeR;

    /**
     * @ORM\Column(type="string", length=255)
     *
     *  @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="Your name cannot contain a number"
     * )

     */
    private $nomR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adressR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paysR;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Regex(
     *     pattern="/^[0-9]+$/",
     *     message="Only numbers allowed"
     * )
     */

    private $telR;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imgR;

    /**
     * @ORM\OneToMany(targetEntity=ReservationR::class, mappedBy="idR")
     */
    private $reservationRs;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="idR")
     */
    private $commentaires;

    public function __construct()
    {
        $this->reservationRs = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeR(): ?string
    {
        return $this->typeR;
    }

    public function setTypeR(string $typeR): self
    {
        $this->typeR = $typeR;

        return $this;
    }

    public function getNomR(): ?string
    {
        return $this->nomR;
    }

    public function setNomR(string $nomR): self
    {
        $this->nomR = $nomR;

        return $this;
    }

    public function getAdressR(): ?string
    {
        return $this->adressR;
    }

    public function setAdressR(string $adressR): self
    {
        $this->adressR = $adressR;

        return $this;
    }

    public function getPaysR(): ?string
    {
        return $this->paysR;
    }

    public function setPaysR(string $paysR): self
    {
        $this->paysR = $paysR;

        return $this;
    }

    public function getTelR(): ?string
    {
        return $this->telR;
    }

    public function setTelR(string $telR): self
    {
        $this->telR = $telR;

        return $this;
    }

    public function getImgR(): ?string
    {
        return $this->imgR;
    }

    public function setImgR(string $imgR): self
    {
        $this->imgR = $imgR;

        return $this;
    }

    /**
     * @return Collection<int, ReservationR>
     */
    public function getReservationRs(): Collection
    {
        return $this->reservationRs;
    }

    public function addReservationR(ReservationR $reservationR): self
    {
        if (!$this->reservationRs->contains($reservationR)) {
            $this->reservationRs[] = $reservationR;
            $reservationR->setIdR($this);
        }

        return $this;
    }

    public function removeReservationR(ReservationR $reservationR): self
    {
        if ($this->reservationRs->removeElement($reservationR)) {
            // set the owning side to null (unless already changed)
            if ($reservationR->getIdR() === $this) {
                $reservationR->setIdR(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setIdR($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getIdR() === $this) {
                $commentaire->setIdR(null);
            }
        }

        return $this;
    }
}

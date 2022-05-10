<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $datecom;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prixtotale;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $valide;

    /**
     * @ORM\ManyToMany(targetEntity=Produit::class)
     */
    private $Produits;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Userrr::class, inversedBy="commandes")
     */
    private $idu;

    /**
     * @ORM\OneToMany(targetEntity=Notification::class, mappedBy="commande")
     */
    private $notifications;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
        $this->Produits = new ArrayCollection();
        $this->notifications = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatecom(): ?\DateTimeInterface
    {
        return $this->datecom;
    }

    public function setDatecom(?\DateTimeInterface $datecom): self
    {
        $this->datecom = $datecom;

        return $this;
    }

    public function getPrixtotale(): ?float
    {
        return $this->prixtotale;
    }

    public function setPrixtotale(?float $prixtotale): self
    {
        $this->prixtotale = $prixtotale;

        return $this;
    }

    public function getValide(): ?string
    {
        return $this->valide;
    }

    public function setValide(?string $valide): self
    {
        $this->valide = $valide;

        return $this;
    }

    /**
     * @return Collection<int, Produit>
     */
    public function getProduits(): Collection
    {
        return $this->Produits;
    }

    public function addProduit(Produit $produit): self
    {
        if (!$this->Produits->contains($produit)) {
            $this->Produits[] = $produit;
        }

        return $this;
    }

    public function removeProduit(Produit $produit): self
    {
        $this->Produits->removeElement($produit);

        return $this;
    }

    public function getIdUser(): ?User
    {
        return $this->idUser;
    }

    public function setIdUser(?User $idUser): self
    {
        $this->idUser = $idUser;

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

    /**
     * @return Collection<int, Notification>
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setCommande($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->removeElement($notification)) {
            // set the owning side to null (unless already changed)
            if ($notification->getCommande() === $this) {
                $notification->setCommande(null);
            }
        }

        return $this;
    }






}

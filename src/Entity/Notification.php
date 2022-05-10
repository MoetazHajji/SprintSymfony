<?php

namespace App\Entity;

use App\Repository\NotificationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NotificationRepository::class)
 */
class Notification
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Userrr::class, inversedBy="notifications")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Commande::class, inversedBy="notifications")
     */
    private $commande;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Userrr
    {
        return $this->user;
    }

    public function setUser(?Userrr $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }
}

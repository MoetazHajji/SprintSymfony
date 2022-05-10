<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
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
    private $contenuCommentaireR;

    /**
     * @ORM\ManyToOne(targetEntity=Restau::class, inversedBy="commentaires")
     */
    private $idR;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commentaires",)
     */
    private $idUser;

    /**
     * @ORM\ManyToOne(targetEntity=Userr::class, inversedBy="commentaires")
     */
    private $iduserr;

    /**
     * @ORM\ManyToOne(targetEntity=Userrr::class, inversedBy="commentaires")
     */
    private $idu;
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContenuCommentaireR(): ?string
    {
        return $this->contenuCommentaireR;
    }

    public function setContenuCommentaireR(string $contenuCommentaireR): self
    {
        $this->contenuCommentaireR = $contenuCommentaireR;

        return $this;
    }

    public function getIdR(): ?Restau
    {
        return $this->idR;
    }

    public function setIdR(?Restau $idR): self
    {
        $this->idR = $idR;

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

    public function getIduserr(): ?Userr
    {
        return $this->iduserr;
    }

    public function setIduserr(?Userr $iduserr): self
    {
        $this->iduserr = $iduserr;

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

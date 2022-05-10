<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *  @Assert\Length(
     *      min = 3,
     *      max = 10,
     *      minMessage = "Entrez plus que 3 lettres",
     *      maxMessage = "Entrez moins de 10 lettres"
     * )
     * @Assert\NotBlank(message="Le champ nom est obligatoire * ")
     * @ORM\Column(type="string", length=255)
     */
    private $nom_event;

    /**
     * @ORM\Column(type="string", length=255)

     */
    private $image;
    /**
     * @Assert\PositiveOrZero
     * @Assert\NotBlank(message="Le champ nombre de participants est obligatoire * ")
     * @ORM\Column(type="integer")
     */
    private $nbr_participant;

    /**


     * @ORM\Column(name="date_debut", type="date")



     */
    private $date_debut;

    /**

     * @ORM\Column(name="date_fin", type="date")



     */
    private $date_fin;

    /**
     *  @Assert\Length(
     *      min = 3,
     *      max = 100,
     *      minMessage = "Entrez plus que 3 lettres",
     *      maxMessage = "Entrez moins de 10 lettres"
     * )
     * @Assert\NotBlank(message="Le champ emplacement est obligatoire * ")
     * @ORM\Column(type="string", length=255)
     */
    private $emplacement;

    /**
     *  @Assert\Length(
     *      min = 10,
     *      max = 50,
     *      minMessage = "Entrez plus que 10 lettres",
     *      maxMessage = "Entrez moins de 50 lettres"
     * )
     * @Assert\NotBlank(message="Le champ description est obligatoire * ")
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     *  @Assert\Length(
     *      min = 3,
     *      max = 15,
     *      minMessage = "Entrez plus que 3 lettres",
     *      maxMessage = "Entrez moins de 10 lettres"
     * )
     * @ORM\Column(type="string", length=255)
     */
    private $theme;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvent(): ?string
    {
        return $this->nom_event;
    }

    public function setNomEvent(string $nom_event): self
    {
        $this->nom_event = $nom_event;

        return $this;
    }

    public function getNbrParticipant(): ?int
    {
        return $this->nbr_participant;
    }

    public function setNbrParticipant(int $nbr_participant): self
    {
        $this->nbr_participant = $nbr_participant;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): self
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): self
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getTheme(): ?string
    {
        return $this->theme;
    }

    public function setTheme(string $theme): self
    {
        $this->theme = $theme;

        return $this;
    }
    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }
}

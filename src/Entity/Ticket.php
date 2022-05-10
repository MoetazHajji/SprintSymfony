<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le champ packet est obligatoire * ")
     * @ORM\Column(type="string", length=255)
     */
    private $packet;

    /**
     *  @Assert\NotBlank(message="Le champ prix est obligatoire * ")
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @Assert\NotBlank(message="Le champ event_id est obligatoire * ")
     * @ORM\Column(type="integer")
     */
    private $event_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPacket(): ?string
    {
        return $this->packet;
    }

    public function setPacket(string $packet): self
    {
        $this->packet = $packet;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

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

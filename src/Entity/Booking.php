<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Show::class, inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     *
     * @Assert\Valid
     */
    private $representation;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\GreaterThan(0, message="Le nombre d'adultes doit être supérieure à {{ compared_value }}")
     */
    private $adult;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\GreaterThanOrEqual(0, message="Veuillez indiquer un nombre d'enfants supérieur ou égal à {{ compared_value }}")
     */
    private $child;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRepresentation(): ?Show
    {
        return $this->representation;
    }

    public function setRepresentation(?Show $representation): self
    {
        $this->representation = $representation;

        return $this;
    }

    public function getAdult(): ?int
    {
        return $this->adult;
    }

    public function setAdult(int $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getChild(): ?int
    {
        return $this->child;
    }

    public function setChild(int $child): self
    {
        $this->child = $child;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\ArtistRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArtistRepository::class)
 */
class Artist
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 250,
     *      maxMessage = "Cette valeur ne peut dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 250,
     *      maxMessage = "Cette valeur ne peut dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    private $story;

    /**
     * @ORM\Column(type="integer")
     *
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private $age;

    /**
     * @ORM\Column(type="float")
     *
     * @Assert\NotBlank
     * @Assert\Type(
     *     type="integer",
     *     message="La valeur {{ value }} n'est pas de type {{ type }}."
     * )
     */
    private $height;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 250,
     *      maxMessage = "Cette valeur ne peut dépasser {{ limit }} caractères",
     *      allowEmptyString = false
     * )
     */
    private $origin;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    private $particularity;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank
     */
    private $incredible;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $picture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStory(): ?string
    {
        return $this->story;
    }

    public function setStory(string $story): self
    {
        $this->story = $story;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHeight(): ?float
    {
        return $this->height;
    }

    public function setHeight(float $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function setOrigin(string $origin): self
    {
        $this->origin = $origin;

        return $this;
    }

    public function getParticularity(): ?string
    {
        return $this->particularity;
    }

    public function setParticularity(string $particularity): self
    {
        $this->particularity = $particularity;

        return $this;
    }

    public function getIncredible(): ?string
    {
        return $this->incredible;
    }

    public function setIncredible(string $incredible): self
    {
        $this->incredible = $incredible;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}

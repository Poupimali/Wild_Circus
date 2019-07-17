<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShowRepository")
 * @ORM\Table("`show`")
 */
class Show
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_adult;

    /**
     * @ORM\Column(type="integer")
     */
    private $price_child;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $time_slot;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $message;

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

    public function getPriceAdult(): ?int
    {
        return $this->price_adult;
    }

    public function setPriceAdult(int $price_adult): self
    {
        $this->price_adult = $price_adult;

        return $this;
    }

    public function getPriceChild(): ?int
    {
        return $this->price_child;
    }

    public function setPriceChild(int $price_child): self
    {
        $this->price_child = $price_child;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTimeSlot(): ?string
    {
        return $this->time_slot;
    }

    public function setTimeSlot(string $time_slot): self
    {
        $this->time_slot = $time_slot;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}

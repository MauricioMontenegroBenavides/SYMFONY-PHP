<?php

namespace App\Entity;

use App\Repository\SymRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SymRepository::class)
 */
class Sym
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $da1;

    /**
     * @ORM\Column(type="text")
     */
    private $da2;

    /**
     * @ORM\Column(type="text")
     */
    private $da3;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDa1(): ?string
    {
        return $this->da1;
    }

    public function setDa1(string $da1): self
    {
        $this->da1 = $da1;

        return $this;
    }

    public function getDa2(): ?string
    {
        return $this->da2;
    }

    public function setDa2(string $da2): self
    {
        $this->da2 = $da2;

        return $this;
    }

    public function getDa3(): ?string
    {
        return $this->da3;
    }

    public function setDa3(string $da3): self
    {
        $this->da3 = $da3;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\CommnetRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommnetRepository::class)
 */
class Commnet
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

     #[Assert\NotBlank(message:'El texto es obligatorio')]
    private $body;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }
}

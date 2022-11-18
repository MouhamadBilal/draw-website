<?php

namespace App\Entity;

use App\Repository\DrawRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DrawRepository::class)]
class Draw
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::BLOB)]
    private $post = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost()
    {
        return $this->post;
    }

    public function setPost($post): self
    {
        $this->post= $post;

        return $this;
    }

    public function __toString(): string
    {
        return $this;
    }
}

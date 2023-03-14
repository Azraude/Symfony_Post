<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\OneToMany(targetEntity: Comment::class , mappedBy: "Post")]

private $comments;
public function __construct()
{
    $this->comments = new ArrayCollection();
}


    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo = null;
    
    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $content = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $sentAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPseudo(): ?string
    {
        return $this->pseudo;
    }

    public function setPseudo(string $pseudo): self
    {
        $this->pseudo = $pseudo;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getSentAt(): ?\DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function setSentAt(\DateTimeImmutable $sentAt): self
    {
        $this->sentAt = $sentAt;

        return $this;
    }
    // public function getComment(): ?Comment
    // {
    //     return $this->comments;
    // }

    // public function setComment(?Comment $comments): self
    // {
    //     $this->comments = $comments;

    //     return $this;
    // }
}

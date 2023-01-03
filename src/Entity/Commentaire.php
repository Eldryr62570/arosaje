<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\CommentaireRepository;
use Symfony\Component\Serializer\Annotation\Groups;


#[ApiResource]
#[ORM\Entity(repositoryClass: CommentaireRepository::class)]
class Commentaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:plante'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:plante'])]
    private ?string $titre_commentaire = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:plante'])]
    private ?string $description_commentaire = null;

    #[ORM\ManyToOne(inversedBy: 'commentaires')]
    #[Groups(['read:plante'])]
    private ?User $User = null;

    #[ORM\ManyToOne(inversedBy: 'Commentaire')]
    private ?Plante $plante = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitreCommentaire(): ?string
    {
        return $this->titre_commentaire;
    }

    public function setTitreCommentaire(string $titre_commentaire): self
    {
        $this->titre_commentaire = $titre_commentaire;

        return $this;
    }

    public function getDescriptionCommentaire(): ?string
    {
        return $this->description_commentaire;
    }

    public function setDescriptionCommentaire(string $description_commentaire): self
    {
        $this->description_commentaire = $description_commentaire;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getPlante(): ?Plante
    {
        return $this->plante;
    }

    public function setPlante(?Plante $plante): self
    {
        $this->plante = $plante;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Entity\Commentaire;
use App\Entity\ImagesPlante;
use ApiPlatform\Metadata\Get;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlanteRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PlanteRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'get:plantItem']),
        new GetCollection(normalizationContext: ['groups' => 'get:plantList'])
    ],
        order: ['createdAt' => 'DESC'],
        paginationEnabled: false,
)]
class Plante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['get:plantItem' , 'get:plantList'])]
    private ?string $nom_plante = null;

    #[ORM\Column(length: 5096)]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private ?string $description_plante = null;

    #[ORM\Column(length: 100)]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private ?string $image_plante = null;

    #[ORM\Column]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private ?\DateTimeImmutable $updated_at = null;

    #[ORM\ManyToOne(inversedBy: 'plantes')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private ?User $User = null;

    #[ORM\OneToMany(mappedBy: 'Plante', targetEntity: Commentaire::class, orphanRemoval: true)]
    #[Groups(['get:plantItem', 'get:plantList'])]
    private Collection $commentaires;

    #[ORM\ManyToOne(inversedBy: 'plantes')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypePlante $TypePlante = null;

    #[ORM\OneToMany(mappedBy: 'Plante', targetEntity: ImagesPlante::class, orphanRemoval: true)]
    private Collection $imagesPlantes;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
        $this->imagesPlantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPlante(): ?string
    {
        return $this->nom_plante;
    }

    public function setNomPlante(string $nom_plante): self
    {
        $this->nom_plante = $nom_plante;

        return $this;
    }

    public function getDescriptionPlante(): ?string
    {
        return $this->description_plante;
    }

    public function setDescriptionPlante(string $description_plante): self
    {
        $this->description_plante = $description_plante;

        return $this;
    }

    public function getImagePlante(): ?string
    {
        return $this->image_plante;
    }

    public function setImagePlante(string $image_plante): self
    {
        $this->image_plante = $image_plante;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(?\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

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

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires->add($commentaire);
            $commentaire->setPlante($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPlante() === $this) {
                $commentaire->setPlante(null);
            }
        }

        return $this;
    }

    public function getTypePlante(): ?TypePlante
    {
        return $this->TypePlante;
    }

    public function setTypePlante(?TypePlante $TypePlante): self
    {
        $this->TypePlante = $TypePlante;

        return $this;
    }

    /**
     * @return Collection<int, ImagesPlante>
     */
    public function getImagesPlantes(): Collection
    {
        return $this->imagesPlantes;
    }

    public function addImagesPlante(ImagesPlante $imagesPlante): self
    {
        if (!$this->imagesPlantes->contains($imagesPlante)) {
            $this->imagesPlantes->add($imagesPlante);
            $imagesPlante->setPlante($this);
        }

        return $this;
    }

    public function removeImagesPlante(ImagesPlante $imagesPlante): self
    {
        if ($this->imagesPlantes->removeElement($imagesPlante)) {
            // set the owning side to null (unless already changed)
            if ($imagesPlante->getPlante() === $this) {
                $imagesPlante->setPlante(null);
            }
        }

        return $this;
    }
}

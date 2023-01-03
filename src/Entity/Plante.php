<?php

namespace App\Entity;

use App\Entity\Commentaire;
use ApiPlatform\Metadata\Get;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PlanteRepository;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;




#[ApiResource(
    normalizationContext: ['groups' => ['read:plante']],
    operations: [
    new Get(),
    new GetCollection()
])]
#[ORM\Entity(repositoryClass: PlanteRepository::class)]
class Plante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:plante'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:plante'])]
    private ?string $adresse_plante = null;

    #[ORM\Column]
    #[Groups(['read:plante'])]
    private ?bool $is_exterieur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['read:plante'])]
    private ?string $description_plante = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:plante'])]
    private ?string $img_plante = null;

    #[ORM\OneToMany(mappedBy: 'plante', targetEntity: Commentaire::class)]
    #[Groups(['read:plante'])]
    private Collection $Commentaire;

    #[ORM\ManyToOne(inversedBy: 'plantes')]
    private ?User $Users = null;

    #[ORM\ManyToOne(inversedBy: 'Plantes')]
    #[ORM\JoinColumn(nullable: true)]
    private ?ResumePlante $resumePlante = null;

    public function __construct()
    {
        $this->Commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdressePlante(): ?string
    {
        return $this->adresse_plante;
    }

    public function setAdressePlante(string $adresse_plante): self
    {
        $this->adresse_plante = $adresse_plante;

        return $this;
    }

    public function isIsExterieur(): ?bool
    {
        return $this->is_exterieur;
    }

    public function setIsExterieur(bool $is_exterieur): self
    {
        $this->is_exterieur = $is_exterieur;

        return $this;
    }

    public function getDescriptionPlante(): ?string
    {
        return $this->description_plante;
    }

    public function setDescriptionPlante(?string $description_plante): self
    {
        $this->description_plante = $description_plante;

        return $this;
    }

    public function getImgPlante(): ?string
    {
        return $this->img_plante;
    }

    public function setImgPlante(string $img_plante): self
    {
        $this->img_plante = $img_plante;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->Commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->Commentaire->contains($commentaire)) {
            $this->Commentaire->add($commentaire);
            $commentaire->setPlante($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->Commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getPlante() === $this) {
                $commentaire->setPlante(null);
            }
        }

        return $this;
    }

    public function getUsers(): ?User
    {
        return $this->Users;
    }

    public function setUsers(?User $Users): self
    {
        $this->Users = $Users;

        return $this;
    }

    public function getResumePlante(): ?ResumePlante
    {
        return $this->resumePlante;
    }

    public function setResumePlante(?ResumePlante $resumePlante): self
    {
        $this->resumePlante = $resumePlante;

        return $this;
    }
}

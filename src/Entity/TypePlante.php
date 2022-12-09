<?php

namespace App\Entity;

use App\Repository\TypePlanteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypePlanteRepository::class)]
class TypePlante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_type_plante = null;

    #[ORM\OneToMany(mappedBy: 'typePlante', targetEntity: ResumePlante::class)]
    private Collection $resumePlante;

    public function __construct()
    {
        $this->resumePlante = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomTypePlante(): ?string
    {
        return $this->nom_type_plante;
    }

    public function setNomTypePlante(string $nom_type_plante): self
    {
        $this->nom_type_plante = $nom_type_plante;

        return $this;
    }

    /**
     * @return Collection<int, ResumePlante>
     */
    public function getResumePlante(): Collection
    {
        return $this->resumePlante;
    }

    public function addResumePlante(ResumePlante $resumePlante): self
    {
        if (!$this->resumePlante->contains($resumePlante)) {
            $this->resumePlante->add($resumePlante);
            $resumePlante->setTypePlante($this);
        }

        return $this;
    }

    public function removeResumePlante(ResumePlante $resumePlante): self
    {
        if ($this->resumePlante->removeElement($resumePlante)) {
            // set the owning side to null (unless already changed)
            if ($resumePlante->getTypePlante() === $this) {
                $resumePlante->setTypePlante(null);
            }
        }

        return $this;
    }
}

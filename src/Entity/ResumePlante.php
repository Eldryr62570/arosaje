<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ResumePlanteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource]
#[ORM\Entity(repositoryClass: ResumePlanteRepository::class)]
class ResumePlante
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom_resume_plante = null;

    #[ORM\OneToMany(mappedBy: 'resumePlante', targetEntity: Plante::class)]
    private Collection $Plantes;

    public function __construct()
    {
        $this->Plantes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomResumePlante(): ?string
    {
        return $this->nom_resume_plante;
    }

    public function setNomResumePlante(string $nom_resume_plante): self
    {
        $this->nom_resume_plante = $nom_resume_plante;

        return $this;
    }

    /**
     * @return Collection<int, Plante>
     */
    public function getPlantes(): Collection
    {
        return $this->Plantes;
    }

    public function addPlante(Plante $plante): self
    {
        if (!$this->Plantes->contains($plante)) {
            $this->Plantes->add($plante);
            $plante->setResumePlante($this);
        }

        return $this;
    }

    public function removePlante(Plante $plante): self
    {
        if ($this->Plantes->removeElement($plante)) {
            // set the owning side to null (unless already changed)
            if ($plante->getResumePlante() === $this) {
                $plante->setResumePlante(null);
            }
        }

        return $this;
    }

}

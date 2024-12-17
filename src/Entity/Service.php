<?php

namespace App\Entity;

use App\Repository\ServiceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
class Service
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $disponibilite = null;

    /**
     * @var Collection<int, Personnelle>
     */
    #[ORM\OneToMany(    targetEntity: Personnelle::class, 
    mappedBy: 'service', 
    cascade: ['remove'], 
    orphanRemoval: true)]
    private Collection $personnelles;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function __construct()
    {
        $this->personnelles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): static
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    /**
     * @return Collection<int, Personnelle>
     */
    public function getPersonnelles(): Collection
    {
        return $this->personnelles;
    }

    public function addPersonnelle(Personnelle $personnelle): static
    {
        if (!$this->personnelles->contains($personnelle)) {
            $this->personnelles->add($personnelle);
            $personnelle->setService($this);
        }

        return $this;
    }

    public function removePersonnelle(Personnelle $personnelle): static
    {
        if ($this->personnelles->removeElement($personnelle)) {
            // set the owning side to null (unless already changed)
            if ($personnelle->getService() === $this) {
                $personnelle->setService(null);
            }
        }

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }
}

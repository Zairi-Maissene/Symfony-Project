<?php

namespace App\Entity;

use App\Repository\EntrepriseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntrepriseRepository::class)]
class Entreprise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $Designation;

    #[ORM\OneToMany(mappedBy: 'entreprise', targetEntity: PFE::class)]
    private $PFEs;

    public function __construct()
    {
        $this->PFEs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignation(): ?string
    {
        return $this->Designation;
    }

    public function setDesignation(?string $Designation): self
    {
        $this->Designation = $Designation;

        return $this;
    }

    /**
     * @return Collection<int, PFE>
     */
    public function getPFEs(): Collection
    {
        return $this->PFEs;
    }

    public function addPFE(PFE $pFE): self
    {
        if (!$this->PFEs->contains($pFE)) {
            $this->PFEs[] = $pFE;
            $pFE->setEntreprise($this);
        }

        return $this;
    }

    public function removePFE(PFE $pFE): self
    {
        if ($this->PFEs->removeElement($pFE)) {
            // set the owning side to null (unless already changed)
            if ($pFE->getEntreprise() === $this) {
                $pFE->setEntreprise(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->Designation;
    }
}

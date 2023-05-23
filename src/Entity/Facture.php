<?php

namespace App\Entity;

use App\Repository\FactureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="factures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="User")
     */
    private $factures;

    /**
     * @ORM\ManyToOne(targetEntity=Facture::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    /**
     * @ORM\OneToMany(targetEntity=Facture::class, mappedBy="facture")
     */
    private $commandes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Facture;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?self
    {
        return $this->User;
    }

    public function setUser(?self $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(self $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setUser($this);
        }

        return $this;
    }

    public function removeFacture(self $facture): self
    {
        if ($this->factures->removeElement($facture)) {
            // set the owning side to null (unless already changed)
            if ($facture->getUser() === $this) {
                $facture->setUser(null);
            }
        }

        return $this;
    }

    public function getFacture(): ?self
    {
        return $this->facture;
    }

    public function setFacture(?self $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(self $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setFacture($this);
        }

        return $this;
    }

    public function removeCommande(self $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getFacture() === $this) {
                $commande->setFacture(null);
            }
        }

        return $this;
    }
}

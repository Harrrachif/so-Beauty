<?php

namespace App\Entity;

use App\Repository\CommandesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandesRepository::class)
 */
class Commandes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=commandes::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $facture;

    /**
     * @ORM\ManyToOne(targetEntity=commandes::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produits;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFacture(): ?commandes
    {
        return $this->facture;
    }

    public function setFacture(?commandes $facture): self
    {
        $this->facture = $facture;

        return $this;
    }

    public function getProduits(): ?commandes
    {
        return $this->produits;
    }

    public function setProduits(?commandes $produits): self
    {
        $this->produits = $produits;

        return $this;
    }

    public function getQuantite(): ?string
    {
        return $this->quantite;
    }

    public function setQuantite(string $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}

<?php

namespace App\Entity;

use Cocur\Slugify\Slugify;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OccasionsRepository")
 * @ORM\HasLifecycleCallbacks
 * * @UniqueEntity(
 *  fields={"slug"},
 *  message="Une autre annonce possède déja ce modèle, merci de le modifier"
 * )
 */
class Occasions
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255, maxMessage="La marque ne peut pas faire plus de 255 caractères")
     */
    private $marque;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255, maxMessage="Le modèle ne peut pas faire plus de 255 caractères")
     */
    private $modele;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $km;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     * @Assert\PositiveOrZero
     */
    private $prix;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $cylindree;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $puissance;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\Length(max=255, maxMessage="Le carburant ne peut pas faire plus de 255 caractères")
     */
    private $carburant;

    /**
     * @ORM\Column(type="integer")
     */
    private $annee_circu;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $transmission;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $options;

    /**
     * @ORM\Column(type="integer")
     * @Assert\PositiveOrZero
     */
    private $nombre_proprio;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Url()
     */
    private $imgCouv;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Gallery", mappedBy="occasion", orphanRemoval=true)
     */
    private $gallery;

    public function __construct()
    {
        $this->gallery = new ArrayCollection();
    }


    /**
     * Permet d'intialiser le slug
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     * 
     * @return void
     */
    public function initializeSlug(){
        if(empty($this->slug)){
            $slugify = new Slugify();
            $this->slug = $slugify->slugify($this->annee_circu.'-'.$this->modele);
        }

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getCylindree(): ?int
    {
        return $this->cylindree;
    }

    public function setCylindree(int $cylindree): self
    {
        $this->cylindree = $cylindree;

        return $this;
    }

    public function getPuissance(): ?int
    {
        return $this->puissance;
    }

    public function setPuissance(int $puissance): self
    {
        $this->puissance = $puissance;

        return $this;
    }

    public function getCarburant(): ?string
    {
        return $this->carburant;
    }

    public function setCarburant(string $carburant): self
    {
        $this->carburant = $carburant;

        return $this;
    }

    public function getAnneeCircu(): ?int
    {
        return $this->annee_circu;
    }

    public function setAnneeCircu(int $annee_circu): self
    {
        $this->annee_circu = $annee_circu;

        return $this;
    }

    public function getTransmission(): ?string
    {
        return $this->transmission;
    }

    public function setTransmission(string $transmission): self
    {
        $this->transmission = $transmission;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getOptions(): ?string
    {
        return $this->options;
    }

    public function setOptions(string $options): self
    {
        $this->options = $options;

        return $this;
    }

    public function getNombreProprio(): ?int
    {
        return $this->nombre_proprio;
    }

    public function setNombreProprio(int $nombre_proprio): self
    {
        $this->nombre_proprio = $nombre_proprio;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImgCouv(): ?string
    {
        return $this->imgCouv;
    }

    public function setImgCouv(string $imgCouv): self
    {
        $this->imgCouv = $imgCouv;

        return $this;
    }

    /**
     * @return Collection|Gallery[]
     */
    public function getGallery(): Collection
    {
        return $this->gallery;
    }

    public function addGallery(Gallery $gallery): self
    {
        if (!$this->gallery->contains($gallery)) {
            $this->gallery[] = $gallery;
            $gallery->setOccasion($this);
        }

        return $this;
    }

    public function removeGallery(Gallery $gallery): self
    {
        if ($this->gallery->contains($gallery)) {
            $this->gallery->removeElement($gallery);
            // set the owning side to null (unless already changed)
            if ($gallery->getOccasion() === $this) {
                $gallery->setOccasion(null);
            }
        }

        return $this;
    }
}

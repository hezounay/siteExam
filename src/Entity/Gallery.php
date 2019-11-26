<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass="App\Repository\GalleryRepository")
 */
class Gallery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=10, minMessage="Le titre de l'image doit faire au minimum 10 caractères")
     */
    private $caption;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Occasions", inversedBy="gallery")
     * @ORM\JoinColumn(nullable=false)
     */
    private $occasion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(string $caption): self
    {
        $this->caption = $caption;

        return $this;
    }

    public function getOccasion(): ?Occasions
    {
        return $this->occasion;
    }

    public function setOccasion(?Occasions $occasion): self
    {
        $this->occasion = $occasion;

        return $this;
    }
    
}

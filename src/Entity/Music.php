<?php

namespace App\Entity;

use App\Repository\MusicRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MusicRepository::class)]
class Music
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $publicIdentifier = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $file = null;

    #[ORM\ManyToMany(targetEntity: MusicStyle::class)]
    private Collection $musicStyles;

    public function __construct()
    {
        $this->musicStyles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublicIdentifier(): ?string
    {
        return $this->publicIdentifier;
    }

    public function setPublicIdentifier(string $publicIdentifier): self
    {
        $this->publicIdentifier = $publicIdentifier;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getFile(): ?string
    {
        return $this->file;
    }

    public function setFile(string $file): self
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return Collection<int, MusicStyle>
     */
    public function getMusicStyles(): Collection
    {
        return $this->musicStyles;
    }

    public function addMusicStyle(MusicStyle $musicStyle): self
    {
        if (!$this->musicStyles->contains($musicStyle)) {
            $this->musicStyles->add($musicStyle);
        }

        return $this;
    }

    public function removeMusicStyle(MusicStyle $musicStyle): self
    {
        $this->musicStyles->removeElement($musicStyle);

        return $this;
    }

}

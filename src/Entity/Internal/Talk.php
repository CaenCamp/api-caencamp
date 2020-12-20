<?php

namespace App\Entity\Internal;

use App\Repository\Internal\TalkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TalkRepository::class)
 */
class Talk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $short_description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $video;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="talks")
     */
    private $Tags;

    /**
     * @ORM\ManyToOne(targetEntity=TalkType::class, inversedBy="talks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Type;

    /**
     * @ORM\ManyToMany(targetEntity=Speaker::class, inversedBy="talks")
     */
    private $Speakers;

    /**
     * @ORM\ManyToOne(targetEntity=Edition::class, inversedBy="talks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Edition;

    public function __construct()
    {
        $this->Tags = new ArrayCollection();
        $this->Speakers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getShortDescription(): ?string
    {
        return $this->short_description;
    }

    public function setShortDescription(string $short_description): self
    {
        $this->short_description = $short_description;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->Tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->Tags->contains($tag)) {
            $this->Tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        $this->Tags->removeElement($tag);

        return $this;
    }

    public function getType(): ?TalkType
    {
        return $this->Type;
    }

    public function setType(?TalkType $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    /**
     * @return Collection|Speaker[]
     */
    public function getSpeakers(): Collection
    {
        return $this->Speakers;
    }

    public function addSpeaker(Speaker $speaker): self
    {
        if (!$this->Speakers->contains($speaker)) {
            $this->Speakers[] = $speaker;
        }

        return $this;
    }

    public function removeSpeaker(Speaker $speaker): self
    {
        $this->Speakers->removeElement($speaker);

        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->Edition;
    }

    public function setEdition(?Edition $Edition): self
    {
        $this->Edition = $Edition;

        return $this;
    }
}
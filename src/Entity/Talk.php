<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TalkRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TalkRepository::class)
 */
class Talk
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"public-speaker", "tag-managment", "talk-type-managment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-speaker"})
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=255,unique=true)
     * @Groups({"public-speaker"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text")
     * @Groups({"public-speaker"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"public-speaker"})
     */
    private $video;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="talks")
     */
    private $Tags;

    /**
     * @ORM\ManyToOne(targetEntity=TalkType::class, inversedBy="talks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public-speaker"})
     */
    private $Type;

    /**
     * @ORM\ManyToMany(targetEntity=Speaker::class, inversedBy="talks")
     */
    private $Speakers;

    /**
     * @ORM\ManyToOne(targetEntity=Edition::class, inversedBy="talks")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public-speaker"})
     */
    private $Edition;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"public-speaker"})
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionHtml;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionMarkdown;

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

    public function getSlug()
    {
        return $this->slug;
    }


    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

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
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): self
    {
        $this->shortDescription = $shortDescription;

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

    public function getDescriptionHtml(): ?string
    {
        return $this->descriptionHtml;
    }

    public function setDescriptionHtml(?string $descriptionHtml): self
    {
        $this->descriptionHtml = $descriptionHtml;

        return $this;
    }

    public function getDescriptionMarkdown(): ?string
    {
        return $this->descriptionMarkdown;
    }

    public function setDescriptionMarkdown(?string $descriptionMarkdown): self
    {
        $this->descriptionMarkdown = $descriptionMarkdown;

        return $this;
    }
}

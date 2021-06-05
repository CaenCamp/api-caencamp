<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EditionRepository::class)
 */
class Edition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"public-speaker", "public-place"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=350)
     * @Groups({"public-speaker", "public-place"})
     */
    private $title;

    /**
     * @Gedmo\Slug(fields={"title"})
     * @ORM\Column(length=350,unique=true)
     * @Groups({"public-speaker", "public-place"})
     */
    private $slug;

    /**
     * @ORM\Column(type="smallint")
     * @Groups({"public-speaker"})
     */
    private $number;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=EditionCategory::class, inversedBy="editions")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public-speaker", "public-place"})
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=EditionMode::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public-speaker"})
     */
    private $Mode;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="editions")
     */
    private $Place;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="sponsorings")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Sponsor;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="editions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Organizer;

    /**
     * @ORM\OneToMany(targetEntity=Talk::class, mappedBy="Edition")
     */
    private $talks;

    /**
     * @ORM\Column(type="boolean")
     */
    private $published;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $meetup_id;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"public-speaker"})
     */
    private $shortDescription;

    /**
     * @ORM\Column(type="datetimetz")
     */
    private $startDateTime;

    /**
     * @ORM\Column(type="datetimetz", nullable=true)
     */
    private $endDateTime;

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
        $this->Sponsor = new ArrayCollection();
        $this->talks = new ArrayCollection();
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

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCategory(): ?EditionCategory
    {
        return $this->Category;
    }

    public function setCategory(?EditionCategory $Category): self
    {
        $this->Category = $Category;

        return $this;
    }

    public function getMode(): ?EditionMode
    {
        return $this->Mode;
    }

    public function setMode(?EditionMode $Mode): self
    {
        $this->Mode = $Mode;

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->Place;
    }

    public function setPlace(?Place $Place): self
    {
        $this->Place = $Place;

        return $this;
    }

    public function getStartDateTime(): ?\DateTimeInterface
    {
        return $this->startDateTime;
    }

    public function setStartDateTime(\DateTimeInterface $startDateTime): self
    {
        $this->startDateTime = $startDateTime;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeInterface
    {
        return $this->endDateTime;
    }

    public function setEndDateTime(?\DateTimeInterface $endDateTime): self
    {
        $this->endDateTime = $endDateTime;

        return $this;
    }

    public function getSponsor(): ?Organization
    {
        return $this->Sponsor;
    }

    public function setSponsor(?Organization $Sponsor): self
    {
        $this->Sponsor = $Sponsor;

        return $this;
    }

    public function getOrganizer(): ?Organization
    {
        return $this->Organizer;
    }

    public function setOrganizer(?Organization $Organizer): self
    {
        $this->Organizer = $Organizer;

        return $this;
    }

    /**
     * @return Collection|Talk[]
     */
    public function getTalks(): Collection
    {
        return $this->talks;
    }

    public function addTalk(Talk $talk): self
    {
        if (!$this->talks->contains($talk)) {
            $this->talks[] = $talk;
            $talk->setEdition($this);
        }

        return $this;
    }

    public function removeTalk(Talk $talk): self
    {
        if ($this->talks->removeElement($talk)) {
            // set the owning side to null (unless already changed)
            if ($talk->getEdition() === $this) {
                $talk->setEdition(null);
            }
        }

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

    public function getPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getMeetupId(): ?string
    {
        return $this->meetup_id;
    }

    public function setMeetupId(?string $meetup_id): self
    {
        $this->meetup_id = $meetup_id;

        return $this;
    }
}

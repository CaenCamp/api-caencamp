<?php

namespace App\Entity\Internal;

use App\Repository\Internal\EditionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EditionRepository::class)
 */
class Edition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=350)
     */
    private $title;

    /**
     * @ORM\Column(type="smallint")
     */
    private $number;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $ShortDescription;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $Description;

    /**
     * @ORM\ManyToOne(targetEntity=EditionCategory::class, inversedBy="editions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Category;

    /**
     * @ORM\ManyToOne(targetEntity=EditionMode::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $Mode;

    /**
     * @ORM\ManyToOne(targetEntity=Place::class, inversedBy="editions")
     */
    private $Place;

    /**
     * @ORM\Column(type="datetime")
     */
    private $StartDateTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $EndDateTime;

    /**
     * @ORM\ManyToOne(targetEntity=Organization::class, inversedBy="sponsorings")
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
        return $this->ShortDescription;
    }

    public function setShortDescription(string $ShortDescription): self
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

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
        return $this->StartDateTime;
    }

    public function setStartDateTime(\DateTimeInterface $StartDateTime): self
    {
        $this->StartDateTime = $StartDateTime;

        return $this;
    }

    public function getEndDateTime(): ?\DateTimeInterface
    {
        return $this->EndDateTime;
    }

    public function setEndDateTime(?\DateTimeInterface $EndDateTime): self
    {
        $this->EndDateTime = $EndDateTime;

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
}

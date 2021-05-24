<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\OrganizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 */
class Organization
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
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255,unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity=Edition::class, mappedBy="Sponsor")
     */
    private $sponsorings;

    /**
     * @ORM\OneToMany(targetEntity=Edition::class, mappedBy="Organizer")
     */
    private $editions;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_html;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description_markdown;

    public function __construct()
    {
        $this->editions = new ArrayCollection();
        $this->sponsorings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setLogo(?string $logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * @return Collection|Edition[]
     */
    public function getSponsorings(): Collection
    {
        return $this->sponsorings;
    }

    public function addSponsoring(Edition $sponsoring): self
    {
        if (!$this->sponsorings->contains($sponsoring)) {
            $this->sponsorings[] = $sponsoring;
            $sponsoring->setSponsor($this);
        }

        return $this;
    }

    public function removeSponsoring(Edition $sponsoring): self
    {
        if ($this->sponsorings->removeElement($sponsoring)) {
            // set the owning side to null (unless already changed)
            if ($sponsoring->getSponsor() === $this) {
                $sponsoring->setSponsor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Edition[]
     */
    public function getEditions(): Collection
    {
        return $this->editions;
    }

    public function addEdition(Edition $edition): self
    {
        if (!$this->editions->contains($edition)) {
            $this->editions[] = $edition;
            $edition->setOrganizer($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): self
    {
        if ($this->editions->removeElement($edition)) {
            // set the owning side to null (unless already changed)
            if ($edition->getOrganizer() === $this) {
                $edition->setOrganizer(null);
            }
        }

        return $this;
    }

    public function getDescriptionHtml(): ?string
    {
        return $this->description_html;
    }

    public function setDescriptionHtml(?string $description_html): self
    {
        $this->description_html = $description_html;

        return $this;
    }

    public function getDescriptionMarkdown(): ?string
    {
        return $this->description_markdown;
    }

    public function setDescriptionMarkdown(?string $description_markdown): self
    {
        $this->description_markdown = $description_markdown;

        return $this;
    }
}

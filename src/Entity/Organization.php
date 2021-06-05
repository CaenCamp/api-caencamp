<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use App\Repository\OrganizationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=OrganizationRepository::class)
 */
#[ApiResource(
    collectionOperations: [
        'get',
        'post' => ['security' => "is_granted('ROLE_ADMIN')"]
    ],
    itemOperations: [
        'get',
        'put' => ['security' => "is_granted('ROLE_ADMIN')"],
        'delete' => ['security' => "is_granted('ROLE_ADMIN')"]
    ],
    normalizationContext: ['groups' => ['organization-managment']],
)]
#[ApiFilter(
    OrderFilter::class,
    properties: ['name'],
    arguments: ['orderParameterName' => 'order']
)]
#[ApiFilter(
    SearchFilter::class,
    properties: ['name' => 'ipartial'])
]
class Organization
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"organization-managment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"organization-managment"})
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255,unique=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"organization-managment"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"organization-managment"})
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
    private $descriptionHtml;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descriptionMarkdown;

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

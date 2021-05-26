<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\SpeakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=SpeakerRepository::class)
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
    normalizationContext: ['groups' => ['public-speaker']],
)]
#[ApiFilter(
    OrderFilter::class,
    properties: ['id', 'name'],
    arguments: ['orderParameterName' => 'order']
)]
#[ApiFilter(
    SearchFilter::class,
    properties: ['name' => 'ipartial'])
]
class Speaker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"public-speaker"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-speaker"})
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255,unique=true)
     * @Groups({"public-speaker"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=400, nullable=true)
     * @Groups({"public-speaker"})
     */
    private $shortbiography;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"public-speaker"})
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity=WebSite::class, mappedBy="speaker")
     * @Groups({"public-speaker"})
     */
    private $websites;

    /**
     * @ORM\ManyToMany(targetEntity=Talk::class, mappedBy="Speakers")
     * @Groups({"public-speaker"})
     */
    private $talks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biographyhtml;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biographymarkdown;

    public function __construct()
    {
        $this->websites = new ArrayCollection();
        $this->talks = new ArrayCollection();
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


    public function getShortbiography(): ?string
    {
        return $this->shortbiography;
    }

    public function setShortbiography(?string $shortbiography): self
    {
        $this->shortbiography = $shortbiography;

        return $this;
    }

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): self
    {
        $this->biography = $biography;

        return $this;
    }

    /**
     * @return Collection|WebSite[]
     */
    public function getWebsites(): Collection
    {
        return $this->websites;
    }

    public function addWebsite(WebSite $website): self
    {
        if (!$this->websites->contains($website)) {
            $this->websites[] = $website;
            $website->setSpeaker($this);
        }

        return $this;
    }

    public function removeWebsite(WebSite $website): self
    {
        if ($this->websites->removeElement($website)) {
            // set the owning side to null (unless already changed)
            if ($website->getSpeaker() === $this) {
                $website->setSpeaker(null);
            }
        }

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
            $talk->addSpeaker($this);
        }

        return $this;
    }

    public function removeTalk(Talk $talk): self
    {
        if ($this->talks->removeElement($talk)) {
            $talk->removeSpeaker($this);
        }

        return $this;
    }

    public function getBiographyhtml(): ?string
    {
        return $this->biographyhtml;
    }

    public function setBiographyhtml(?string $biographyhtml): self
    {
        $this->biographyhtml = $biographyhtml;

        return $this;
    }

    public function getBiographymarkdown(): ?string
    {
        return $this->biographymarkdown;
    }

    public function setBiographymarkdown(?string $biographymarkdown): self
    {
        $this->biographymarkdown = $biographymarkdown;

        return $this;
    }
}

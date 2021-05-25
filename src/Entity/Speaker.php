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
    collectionOperations: ['get'],
    itemOperations: ['get'],
    normalizationContext: ['groups' => ['public-speaker']],
    denormalizationContext: ['groups' => ['admin-speaker']],
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
    private $short_biography;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"public-speaker"})
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity=WebSite::class, mappedBy="speaker")
     * @Groups({"public-speaker"})
     */
    private $WebSites;

    /**
     * @ORM\ManyToMany(targetEntity=Talk::class, mappedBy="Speakers")
     * @Groups({"public-speaker"})
     */
    private $talks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography_html;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography_markdown;

    public function __construct()
    {
        $this->WebSites = new ArrayCollection();
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


    public function getShortBiography(): ?string
    {
        return $this->short_biography;
    }

    public function setShortBiography(?string $short_biography): self
    {
        $this->short_biography = $short_biography;

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
    public function getWebSites(): Collection
    {
        return $this->WebSites;
    }

    public function addWebSite(WebSite $webSite): self
    {
        if (!$this->WebSites->contains($webSite)) {
            $this->WebSites[] = $webSite;
            $webSite->setSpeaker($this);
        }

        return $this;
    }

    public function removeWebSite(WebSite $webSite): self
    {
        if ($this->WebSites->removeElement($webSite)) {
            // set the owning side to null (unless already changed)
            if ($webSite->getSpeaker() === $this) {
                $webSite->setSpeaker(null);
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

    public function getBiographyHtml(): ?string
    {
        return $this->biography_html;
    }

    public function setBiographyHtml(?string $biography_html): self
    {
        $this->biography_html = $biography_html;

        return $this;
    }

    public function getBiographyMarkdown(): ?string
    {
        return $this->biography_markdown;
    }

    public function setBiographyMarkdown(?string $biography_markdown): self
    {
        $this->biography_markdown = $biography_markdown;

        return $this;
    }
}

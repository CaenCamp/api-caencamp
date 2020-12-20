<?php

namespace App\Entity\Internal;

use App\Repository\Internal\SpeakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity(repositoryClass=SpeakerRepository::class)
 */
class Speaker
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
     * @ORM\Column(type="string", length=400, nullable=true)
     */
    private $short_biography;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $biography;

    /**
     * @ORM\OneToMany(targetEntity=WebSite::class, mappedBy="speaker")
     */
    private $WebSites;

    /**
     * @ORM\ManyToMany(targetEntity=Talk::class, mappedBy="Speakers")
     */
    private $talks;

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
}

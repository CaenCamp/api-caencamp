<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\WebSiteRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WebSiteRepository::class)
 */
class WebSite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     * @Groups({"public-speaker"})
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=WebSiteType::class)
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"public-speaker"})
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Speaker::class, inversedBy="websites")
     */
    private $speaker;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getType(): ?WebSiteType
    {
        return $this->type;
    }

    public function setType(?WebSiteType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSpeaker(): ?Speaker
    {
        return $this->speaker;
    }

    public function setSpeaker(?Speaker $speaker): self
    {
        $this->speaker = $speaker;

        return $this;
    }
}

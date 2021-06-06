<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
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
    normalizationContext: ['groups' => ['tag-managment']],
)]
#[ApiFilter(
    OrderFilter::class,
    properties: ['label'],
    arguments: ['orderParameterName' => 'order']
)]
#[ApiFilter(
    SearchFilter::class,
    properties: ['label' => 'ipartial'])
]
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"tag-managment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"tag-managment", "talk-managment"})
     */
    private $label;

    /**
     * @Gedmo\Slug(fields={"label"})
     * @ORM\Column(length=255,unique=true)
     */
    private $slug;

    /**
     * @ORM\ManyToMany(targetEntity=Talk::class, mappedBy="Tags")
     * @Groups({"tag-managment"})
     */
    private $talks;

    public function __construct()
    {
        $this->talks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

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
            $talk->addTag($this);
        }

        return $this;
    }

    public function removeTalk(Talk $talk): self
    {
        if ($this->talks->removeElement($talk)) {
            $talk->removeTag($this);
        }

        return $this;
    }
}

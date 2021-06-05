<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

use App\Repository\TalkTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TalkTypeRepository::class)
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
    normalizationContext: ['groups' => ['talk-type-managment']],
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
class TalkType
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"talk-type-managment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     * @Groups({"public-speaker", "talk-type-managment"})
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"public-speaker", "talk-type-managment"})
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Talk::class, mappedBy="Type")
     */
    private $talks;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"public-speaker", "talk-type-managment"})
     */
    private $durationInMinutes;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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
            $talk->setType($this);
        }

        return $this;
    }

    public function removeTalk(Talk $talk): self
    {
        if ($this->talks->removeElement($talk)) {
            // set the owning side to null (unless already changed)
            if ($talk->getType() === $this) {
                $talk->setType(null);
            }
        }

        return $this;
    }

    public function getDurationInMinutes(): ?int
    {
        return $this->durationInMinutes;
    }

    public function setDurationInMinutes(int $durationInMinutes): self
    {
        $this->durationInMinutes = $durationInMinutes;

        return $this;
    }
}

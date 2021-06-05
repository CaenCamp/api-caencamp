<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ORM\Entity(repositoryClass=PlaceRepository::class)
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
    normalizationContext: ['groups' => ['public-place']],
)]
#[ApiFilter(
    OrderFilter::class,
    properties: ['id', 'name', 'postalCode'],
    arguments: ['orderParameterName' => 'order']
)]
#[ApiFilter(
    SearchFilter::class,
    properties: ['name' => 'ipartial'])
]
class Place
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"public-place"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-place"})
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=255,unique=true)
     * @Groups({"public-place"})
     */
    private $slug;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"public-place"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * @Groups({"public-place"})
     */
    private $url;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-place"})
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"public-place"})
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-place"})
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"public-place"})
     */
    private $logo;

    /**
     * @ORM\OneToMany(targetEntity=Edition::class, mappedBy="Place")
     * @Groups({"public-place"})
     */
    private $editions;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"public-place"})
     */
    private $descriptionHtml;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"public-place"})
     */
    private $descriptionMarkdown;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"public-place"})
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=5)
     * @Groups({"public-place"})
     */
    private $country;

    public function __construct()
    {
        $this->editions = new ArrayCollection();
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

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(?string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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
    public function getEditions(): Collection
    {
        return $this->editions;
    }

    public function addEdition(Edition $edition): self
    {
        if (!$this->editions->contains($edition)) {
            $this->editions[] = $edition;
            $edition->setPlace($this);
        }

        return $this;
    }

    public function removeEdition(Edition $edition): self
    {
        if ($this->editions->removeElement($edition)) {
            // set the owning side to null (unless already changed)
            if ($edition->getPlace() === $this) {
                $edition->setPlace(null);
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

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}

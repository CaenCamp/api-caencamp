<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 *
 * @see http://schema.org/CreativeWork Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/CreativeWork")
 */
class CreativeWork
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

    /**
     * @var string|null URL of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/url")
     * @Assert\Url
     */
    private $url;

    /**
     * @var string|null The identifier property represents any kind of identifier for any kind of \[\[Thing\]\], such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links. See \[background notes\](/docs/datamodel.html#identifierBg) for more details.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/identifier")
     * @Assert\Url
     */
    private $identifier;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setAbstract(?string $abstract): void
    {
        $this->abstract = $abstract;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }
}

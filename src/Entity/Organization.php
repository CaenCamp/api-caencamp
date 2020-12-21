<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An organization such as a school, NGO, corporation, club, etc.
 *
 * @see http://schema.org/Organization Documentation on Schema.org
 *
 * @ApiResource(iri="http://schema.org/Organization",
 *      collectionOperations={"get"},
 *      itemOperations={"get"},
 *      attributes={"pagination_items_per_page"=20, "maximum_items_per_page"=50}
 * )
 */
class Organization
{
    /**
     * @var string|null
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var Organization|null an Organization (or ProgramMembership) to which this Person or Organization belongs
     *
     * @ApiProperty(iri="http://schema.org/memberOf")
     */
    private $memberOf;

    /**
     * @var string|null a description of the item
     *
     * @ApiProperty(iri="http://schema.org/description")
     */
    private $description;

    /**
     * @var string|null The identifier property represents any kind of identifier for any kind of \[\[Thing\]\], such as ISBNs, GTIN codes, UUIDs etc. Schema.org provides dedicated properties for representing many of these, either as textual strings or as URL (URI) links. See \[background notes\](/docs/datamodel.html#identifierBg) for more details.
     *
     * @ApiProperty(iri="http://schema.org/identifier")
     * @Assert\Url
     */
    private $identifier;

    /**
     * @var string|null An image of the item. This can be a \[\[URL\]\] or a fully described \[\[ImageObject\]\].
     *
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     */
    private $image;

    /**
     * @var string|null the name of the item
     *
     * @ApiProperty(iri="http://schema.org/name")
     */
    private $name;

    public function setId(String $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /* public function setMemberOf(?Organization $memberOf): void */
    /* { */
    /*     $this->memberOf = $memberOf; */
    /* } */

    /* public function getMemberOf(): ?Organization */
    /* { */
    /*     return $this->memberOf; */
    /* } */

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    /* public function setIdentifier(?string $identifier): void */
    /* { */
    /*     $this->identifier = $identifier; */
    /* } */

    /* public function getIdentifier(): ?string */
    /* { */
    /*     return $this->identifier; */
    /* } */

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }
}

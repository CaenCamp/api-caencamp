<?php

declare(strict_types=1);

namespace App\Entity\schemaOrg;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * The mailing address.
 *
 * @see http://schema.org/PostalAddress Documentation on Schema.org
 *
 * ApiResource(iri="http://schema.org/PostalAddress", 
 *      collectionOperations={},
 *      itemOperations={"get"}
 * )
 */
class PostalAddress
{
    /**
     * @var int|null
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var string|null The street address. For example, 1600 Amphitheatre Pkwy.
     *
     * @ApiProperty(iri="http://schema.org/streetAddress")
     * @Groups({"event", "place"})
     */
    private $streetAddress;

    /**
     * @var string|null The postal code. For example, 94043.
     *
     * @ApiProperty(iri="http://schema.org/postalCode")
     * @Groups({"event", "place"})
     */
    private $postalCode;

    /**
     * @var string|null The locality. For example, Mountain View.
     *
     * @ApiProperty(iri="http://schema.org/addressLocality")
     * @Groups({"event", "place"})
     */
    private $addressLocality;

    /**
     * @var string|null The country. For example, USA. You can also provide the two-letter \[ISO 3166-1 alpha-2 country code\](http://en.wikipedia.org/wiki/ISO\_3166-1).
     *
     * @ApiProperty(iri="http://schema.org/addressCountry")
     */
    private $addressCountry;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setStreetAddress(?string $streetAddress): void
    {
        $this->streetAddress = $streetAddress;
    }

    public function getStreetAddress(): ?string
    {
        return $this->streetAddress;
    }

    public function setPostalCode(?string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setAddressLocality(?string $addressLocality): void
    {
        $this->addressLocality = $addressLocality;
    }

    public function getAddressLocality(): ?string
    {
        return $this->addressLocality;
    }

    public function setAddressCountry(?string $addressCountry): void
    {
        $this->addressCountry = $addressCountry;
    }

    public function getAddressCountry(): ?string
    {
        return $this->addressCountry;
    }
}

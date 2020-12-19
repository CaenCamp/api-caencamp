<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An event happening at a certain time and location, such as a concert, lecture, or festival. Ticketing information may be added via the \[\[offers\]\] property. Repeated events may be structured as separate Event objects.
 *
 * @see http://schema.org/Event Documentation on Schema.org
 *
 * @ApiResource(iri="http://schema.org/Event",
 *      collectionOperations={"get"},
 *      itemOperations={"get"}
 * )
 */
class Event
{

    /**
     * @var int|null
     */
    private $id;

    /**
     * @var \DateTimeInterface|null The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @ApiProperty(iri="http://schema.org/startDate")
     * @Assert\DateTime
     */
    private $startDate;

    /**
     * @var \DateTimeInterface|null The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @ApiProperty(iri="http://schema.org/endDate")
     * @Assert\DateTime
     */
    private $endDate;

    /**
     * @var \DateTimeInterface|null The duration of the event. (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601#/Durations)).
     * @ApiProperty(iri="https://schema.org/duration")
     * @Assert\DateTime
     */
    private $duration;

    /**
     * @var string|null The mode of attendance (offline / online / both)
     * @ApiProperty(iri="https://schema.org/eventAttendanceMode")
     * this schema.org property is not integrated yet, this is a manual implementation
     */
    private $eventAttendanceMode;

    /**
     * @var Place|null the location of for example where the event is happening, an organization is located, or where an action takes place
     *
     * @ApiProperty(iri="http://schema.org/location")
     */
    private $location;

    /**
     * @var Organization|null an organizer of an Event
     *
     * @ApiProperty(iri="http://schema.org/organizer")
     */
    private $organizer;

    /**
     * @var Person|null a performer at the event—for example, a presenter, musician, musical group or actor
     *
     * @ApiProperty(iri="http://schema.org/performer")
     */
    private $performer;

    /**
     * @var CreativeWork|null the CreativeWork that captured all or part of this Event
     *
     * @ApiProperty(iri="http://schema.org/recordedIn")
     */
    private $recordedIn;

    /**
     * @var Event|null An Event that is part of this event. For example, a conference event includes many presentations, each of which is a subEvent of the conference.
     *
     * @ApiProperty(iri="http://schema.org/subEvent")
     */
    private $subEvent;

    /**
     * @var Event|null An event that this event is a part of. For example, a collection of individual music performances might each have a music festival as their superEvent.
     *
     * @ApiProperty(iri="http://schema.org/superEvent")
     */
    private $superEvent;

    /**
     * @var string|null An additional type for the item, typically used for adding more specific types from external vocabularies in microdata syntax. This is a relationship between something and a class that the thing is in. In RDFa syntax, it is better to use the native RDFa syntax - the 'typeof' attribute - for multiple types. Schema.org tools may have only weaker understanding of extra types, in particular those defined externally.
     *
     * @ApiProperty(iri="http://schema.org/additionalType")
     * @Assert\Url
     */
    private $additionalType;

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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function getDuration(): ?\DateTimeInterface
    {
        return $this->duration;
    }

    public function setDuration(?\DateTimeInterface $duration)
    {
        $this->duration = $duration;
    }

    public function getEventAttendanceMode(): string
    {
        return $this->eventAttendanceMode;
    }

    public function setEventAttendanceMode(string $eventAttendanceMode): void
    {
        $this->eventAttendanceMode = $eventAttendanceMode;
    }

    public function setLocation(?Place $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?Place
    {
        return $this->location;
    }

    public function setOrganizer(?Organization $organizer): void
    {
        $this->organizer = $organizer;
    }

    public function getOrganizer(): ?Organization
    {
        return $this->organizer;
    }

    public function setPerformer(?Person $performer): void
    {
        $this->performer = $performer;
    }

    public function getPerformer(): ?Person
    {
        return $this->performer;
    }

    public function setRecordedIn(?CreativeWork $recordedIn): void
    {
        $this->recordedIn = $recordedIn;
    }

    public function getRecordedIn(): ?CreativeWork
    {
        return $this->recordedIn;
    }

    public function setSubEvent(?Event $subEvent): void
    {
        $this->subEvent = $subEvent;
    }

    public function getSubEvent(): ?Event
    {
        return $this->subEvent;
    }

    public function setSuperEvent(?Event $superEvent): void
    {
        $this->superEvent = $superEvent;
    }

    public function getSuperEvent(): ?Event
    {
        return $this->superEvent;
    }

    public function setAdditionalType(?string $additionalType): void
    {
        $this->additionalType = $additionalType;
    }

    public function getAdditionalType(): ?string
    {
        return $this->additionalType;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setIdentifier(?string $identifier): void
    {
        $this->identifier = $identifier;
    }

    public function getIdentifier(): ?string
    {
        return $this->identifier;
    }

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

<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * An event happening at a certain time and location, such as a concert, lecture, or festival. Ticketing information may be added via the \[\[offers\]\] property. Repeated events may be structured as separate Event objects.
 *
 * @see http://schema.org/Event Documentation on Schema.org
 *
 * @ApiResource(iri="http://schema.org/Event",
 *      collectionOperations={"get"},
 *      itemOperations={"get"},
 *      normalizationContext={"groups"={"event"}},
 *      denormalizationContext={"groups"={"event"}}
 * )
 */
class Event
{

    /**
     * @var string|null
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * @var \DateTimeInterface|null The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @ApiProperty(iri="http://schema.org/startDate")
     * @Assert\DateTime
     * @Groups({"event"})
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
     * @var string|null The duration of the event. (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601#/Durations)).
     * @ApiProperty(iri="https://schema.org/duration")
     * @Assert\DateTime
     * @Groups({"event"})
     */
    private $duration;

    /**
     * @var string|null an eventStatus of an event represents its status; particularly useful when an event is cancelled or rescheduled
     *
     * @ApiProperty(iri="http://schema.org/eventStatus")
     */
    private $eventStatus;

    /**
     * @var string|null The mode of attendance (offline / online / both)
     * @ApiProperty(iri="https://schema.org/eventAttendanceMode")
     * this schema.org property is not integrated yet, this is a manual implementation
     * @Groups({"event"})
     */
    private $eventAttendanceMode;

    /**
     * @var Place|null the location of for example where the event is happening, an organization is located, or where an action takes place
     *
     * @ApiProperty(iri="http://schema.org/location")
     * @Groups({"event"})
     */
    private $location;

    /**
     * @var Organization|null an organizer of an Event
     *
     * @ApiProperty(iri="http://schema.org/organizer")
     * @Groups({"event"})
     */
    private $organizer;

    /**
     * @var Organization|null A person or organization that supports a thing through a pledge, promise, or financial contribution. e.g. a sponsor of a Medical Study or a corporate sponsor of an event.
     *
     * @ApiProperty(iri="http://schema.org/sponsor")
     */
    private $sponsor;

    /**
     * @var Person[]|null a performer at the event—for example, a presenter, musician, musical group or actor
     *
     * @ApiProperty(iri="http://schema.org/performers")
     * @Groups({"event"})
     */
    private $performers;

    /**
     * @var CreativeWork|null the CreativeWork that captured all or part of this Event
     *
     * @ApiProperty(iri="http://schema.org/recordedIn")
     */
    private $recordedIn;

    /**
     * @var Event[]|null An Event that is part of this event. For example, a conference event includes many presentations, each of which is a subEvent of the conference.
     *
     * @ApiProperty(iri="http://schema.org/subEvents")
     * @Groups({"event"})
     */
    private $subEvents;

    /**
     * @var Event|null An event that this event is a part of. For example, a collection of individual music performances might each have a music festival as their superEvent.
     *
     * @ApiProperty(iri="http://schema.org/superEvent")
     */
    private $superEvent;

    /**
     * @var string|null a description of the item
     *
     * @ApiProperty(iri="http://schema.org/description")
     * @Groups({"event"})
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
     * @Groups({"event"})
     */
    private $name;

    public function __construct()
    {
        $this->subEvents = array();
        $this->performers = array();
    }

    public function setId(String $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?string
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

    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(?string $duration)
    {
        $this->duration = $duration;
    }

    public function setEventStatus(?string $eventStatus): void
    {
        $this->eventStatus = $eventStatus;
    }

    public function getEventStatus(): ?string
    {
        return $this->eventStatus;
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

    public function setSponsor(?Organization $sponsor): void
    {
        $this->sponsor = $sponsor;
    }

    public function getSponsor(): ?Organization
    {
        return $this->sponsor;
    }

    public function addPerformer(?Person $performer): self
    {
        $this->performers[] = $performer;

        return $this;
    }

    public function setPerformers(?array $performers): void
    {
        $this->performers = $performers;
    }

    public function getPerformers(): ?iterable
    {
        return $this->performers;
    }

    public function setRecordedIn(?CreativeWork $recordedIn): void
    {
        $this->recordedIn = $recordedIn;
    }

    public function getRecordedIn(): ?CreativeWork
    {
        return $this->recordedIn;
    }

    public function addSubEvent(?Event $subEvent): self
    {
        $this->subEvents[] = $subEvent;

        return $this;
    }

    public function getSubEvents(): ?iterable
    {
        return $this->subEvents;
    }

    public function setSuperEvent(?Event $superEvent): void
    {
        $this->superEvent = $superEvent;
    }

    public function getSuperEvent(): ?Event
    {
        return $this->superEvent;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
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

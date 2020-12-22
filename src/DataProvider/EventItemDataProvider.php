<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\Organization;
use App\Entity\Person;
use App\Entity\Internal\Edition;
use Doctrine\Persistence\ManagerRegistry;

final class EventItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
      $this->managerRegistry = $managerRegistry;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Event::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Event
    {
        $manager = $this->managerRegistry->getManagerForClass(Edition::class);
        $repository = $manager->getRepository(Edition::class);
        $edition = $repository->findOneBySlug($id);
        $event = new Event();
        $event->setId($edition->getSlug());
        $event->setName($edition->getTitle());
        $event->setStartDate($edition->getStartDateTime());
        $event->setDescription($edition->getShortDescription());
        $event->setEventAttendanceMode($edition->getMode()->getLabel());
        $event->setEventStatus('EventScheduled');
        $event->setDuration('1H30M'); //https://en.wikipedia.org/wiki/ISO_8601
        $location = $edition->getPlace();
        $place = new Place();
        $place->setId($location->getSlug());
        $place->setName($location->getName());
        $place->setDescription($location->getDescription());
        $place->setImage($location->getLogo());
        $event->setLocation($place);
        $organizer = $edition->getOrganizer();
        $category = $edition->getCategory();
        $organization = new Organization();
        $organization->setId($organizer->getSlug());
        $organization->setName($category->getDescription());
        $organization->setDescription($organizer->getDescription());
        $organization->setImage($organizer->getLogo());
        $event->setOrganizer($organization);

        $talks = $edition->getTalks();
        $globalSpeakers = array();
        foreach ($talks as $talk) {
            $subEvent = new Event();
            $subEvent->setId($talk->getSlug());
            $subEvent->setName($talk->getTitle());
            $subEvent->setDescription($talk->getShortDescription());
            $subEvent->setDuration($talk->getType()->getDurationInMinutes() . 'M');
            $speakers = $talk->getSpeakers();
            if ($speakers && count($speakers)) {
                foreach ($speakers as $speaker) {
                    $person = new Person();
                    $person->setId($speaker->getSlug());
                    $person->setName($speaker->getName());
                    $person->setDescription($speaker->getShortBiography());
                    $globalSpeakers[] = $person;
                    $subEvent->addPerformer($person);
                }
            }
            $event->addSubEvent($subEvent);
        }
        $event->setPerformers($globalSpeakers);

        return $event;
    }
}

/*
{
  "@context": "/api/contexts/Event",
  "@id": "/api/events/pas-de-stress-ya-cypress",
  "@type": "http://schema.org/Event",
  "id": "pas-de-stress-ya-cypress",
  "startDate": "2020-10-28T19:00:00+01:00",
  "endDate": null,
  "duration": null,
  "eventStatus": "EventScheduled",
  "eventAttendanceMode": "online",
  "location": null,
  "organizer": null,
  "sponsor": null,
  "performers": [],
  "recordedIn": null,
  "subEvents": [],
  "superEvent": null,
  "additionalType": null,
  "description": "Retour d'expérience sur l'implémentation de tests end to end avec Cypress dans un contexte d'application SaaS.",
  "identifier": null,
  "image": null,
  "name": "Pas de stress, y'a Cypress"
}

*/
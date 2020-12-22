<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Event;
use App\Entity\Place;
use App\Entity\Organization;
use App\Entity\Person;
use App\Entity\Internal\Edition;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class EventCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $pagination = array_shift($context);
        $page = isset($pagination['page']) && !!$pagination['page'] ? $pagination['page'] :  1;
        $perPage = isset($pagination['itemsPerPage'])  ? $pagination['itemsPerPage'] : 20;
        $offset = $perPage * ($page - 1);
        $manager = $this->managerRegistry->getManagerForClass(Edition::class);
        $repository = $manager->getRepository(Edition::class);
        $query = $repository->createQueryBuilder('c')
            ->orderBy('c.StartDateTime', 'DESC')
            ->setMaxResults($perPage)
            ->setFirstResult($offset)
            ->getQuery()
        ;
        $editions = new Paginator($query);
        $collection = array();
        foreach ($editions as $edition) {
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
            $collection[] = $event;
        }

        return $collection;
    }
}

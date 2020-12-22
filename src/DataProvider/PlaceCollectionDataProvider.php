<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Place;
use App\Entity\PostalAddress;
use App\Entity\Internal\Place as Location;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

final class PlaceCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
      $this->managerRegistry = $managerRegistry;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Place::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $pagination = array_shift($context);
        $page = isset($pagination['page']) && !!$pagination['page'] ? $pagination['page'] :  1;
        $perPage = isset($pagination['itemsPerPage'])  ? $pagination['itemsPerPage'] : 20;
        $offset = $perPage * ($page - 1);
        $manager = $this->managerRegistry->getManagerForClass(Location::class);
        $repository = $manager->getRepository(Location::class);
        $query = $repository->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->setMaxResults($perPage)
            ->setFirstResult($offset)
            ->getQuery()
        ;
        $locations = new Paginator($query);
        $collection = array();
        foreach ($locations as $location) {
            $place = new Place();
            $place->setId($location->getSlug());
            $place->setName($location->getName());
            $place->setDescription($location->getDescription());
            $place->setImage($location->getLogo());
            $address = new PostalAddress();
            $address->setId($location->getId());
            $address->setStreetAddress($location->getAddress1() . ' ' . $location->getAddress2());
            $address->setPostalCode($location->getPostalCode());
            $address->setAddressLocality($location->getCity());
            $place->setAddress($address);
            $collection[] = $place;
        }

        return $collection;
    }
}

<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\schemaOrg\Place;
use App\Entity\schemaOrg\PostalAddress;
use App\Entity\Place as Location;
use Doctrine\Persistence\ManagerRegistry;

final class PlaceItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
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

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Place
    {
        $manager = $this->managerRegistry->getManagerForClass(Location::class);
        $repository = $manager->getRepository(Location::class);
        $location = $repository->findOneBySlug($id);
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

        return $place;
    }
}

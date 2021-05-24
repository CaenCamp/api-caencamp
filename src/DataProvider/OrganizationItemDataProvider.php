<?php

namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\schemaOrg\Organization;
use App\Entity\Organization as Enterprise;
use Doctrine\Persistence\ManagerRegistry;

final class OrganizationItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
      $this->managerRegistry = $managerRegistry;
    }

    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Organization::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Organization
    {
        $manager = $this->managerRegistry->getManagerForClass(Enterprise::class);
        $repository = $manager->getRepository(Enterprise::class);
        $enterprise = $repository->findOneBySlug($id);
        $organization = new Organization();
        $organization->setId($enterprise->getSlug());
        $organization->setName($enterprise->getName());
        $organization->setDescription($enterprise->getDescription());
        $organization->setImage($enterprise->getLogo());

        return $organization;
    }
}

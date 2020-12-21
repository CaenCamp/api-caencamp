<?php
namespace App\DataProvider;

use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use App\Entity\Organization;
use App\Entity\Internal\Organization as Enterprise;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;
use ApiPlatform\Core\DataProvider\ArrayPaginator;

final class OrganizationCollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
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

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $pagination = array_shift($context);
        $page = isset($pagination['page']) && !!$pagination['page'] ? $pagination['page'] :  1;
        $perPage = isset($pagination['itemsPerPage'])  ? $pagination['itemsPerPage'] : 20;
        $offset = $perPage * ($page - 1);
        $manager = $this->managerRegistry->getManagerForClass(Enterprise::class);
        $repository = $manager->getRepository(Enterprise::class);
        $query = $repository->createQueryBuilder('c')
            ->orderBy('c.name', 'ASC')
            ->setMaxResults($perPage)
            ->setFirstResult($offset)
            ->getQuery()
        ;
        $enterprises = new Paginator($query);
        $collection = array();
        foreach ($enterprises as $enterprise) {
            $orga = new Organization();
            $orga->setId($enterprise->getSlug());
            $orga->setName($enterprise->getName() );
            $orga->setDescription($enterprise->getDescription());
            $orga->setImage($enterprise->getLogo());
            $collection[] = $orga;
        }

        return $collection;
        /* return new ArrayPaginator($collection, $offset, $perPage); */
    }
}

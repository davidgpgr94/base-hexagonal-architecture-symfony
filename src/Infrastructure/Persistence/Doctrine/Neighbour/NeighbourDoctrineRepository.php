<?php


namespace App\Infrastructure\Persistence\Doctrine\Neighbour;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

use App\Domain\Neighbour\Neighbour as NeighbourDomain;
use App\Domain\Neighbour\Services\NeighbourRepository;


/**
 * @method Neighbour|null   find($id, $lockMode = null, $lockVersion = null)
 * @method Neighbour|null   findOneBy(array $criteria, ?array $orderBy = null)
 * @method Neighbour[]      findAll()
 * @method Neighbour[]      findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
 */
class NeighbourDoctrineRepository extends ServiceEntityRepository implements NeighbourRepository
{
    private NeighbourDoctrineParser $neighbourDoctrineParser;

    public function __construct(ManagerRegistry $registry, NeighbourDoctrineParser $neighbourDoctrineParser)
    {
        parent::__construct($registry, Neighbour::class);
        $this->neighbourDoctrineParser = $neighbourDoctrineParser;
    }

    //    /**
    //     * @TODO Remove this function
    //     * @param string $email
    //     * @return Neighbour|null
    //     * @throws \Doctrine\ORM\NonUniqueResultException
    //     */
    //    public function findOneByEmail(string $email): ?Neighbour
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.email = :email')
    //            ->setParameter('email', $email)
    //            ->getQuery()
    //            ->getOneOrNullResult();
    //    }

    public function findById(string $id): ?NeighbourDomain
    {
        $neighbourDoctrine = $this->find($id);
        return is_null($neighbourDoctrine) ? null : $this->neighbourDoctrineParser->toDomain($neighbourDoctrine);
    }

    public function findByEmail(string $email): ?NeighbourDomain
    {
        $neighbourDoctrine = $this->findOneBy(['email' => $email]);
        return is_null($neighbourDoctrine) ? null : $this->neighbourDoctrineParser->toDomain($neighbourDoctrine);
    }

    public function save(NeighbourDomain $neighbour): void
    {
        $neighbourDoctrine = $this->neighbourDoctrineParser->toDoctrine($neighbour);
        $entityManager = $this->getEntityManager();
        try {
            $entityManager->persist($neighbourDoctrine);
            $entityManager->flush();
        } catch (OptimisticLockException | ORMException $e) { }
    }

    public function update(NeighbourDomain $neighbour): void
    {
        $neighbourDoctrine = $this->find($neighbour->getId());
        $neighbourDoctrine->setEmail($neighbour->getEmail())
            ->setFirstname($neighbour->getFirstname())
            ->setLastname($neighbour->getLastname())
            ->setPassword($neighbour->getPassword());
        $entityManager = $this->getEntityManager();
        try {
            $entityManager->flush();
        } catch (OptimisticLockException | ORMException $e) { }
    }
}
<?php

namespace App\Repository;

use App\Entity\Eth;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Eth>
 *
 * @method Eth|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eth|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eth[]    findAll()
 * @method Eth[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EthRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eth::class);
    }

    public function getQball():QueryBuilder{
        return $this->createQueryBuilder('e');
    }
}

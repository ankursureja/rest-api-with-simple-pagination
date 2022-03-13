<?php
namespace App\Repository;

use App\Entity\CompaniesEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompaniesEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompaniesEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompaniesEntity[]    findAll()
 * @method CompaniesEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompaniesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompaniesEntity::class);
    }
}
<?php
namespace App\Repository;

use App\Entity\CompaniesEntity;
use App\Entity\JobsEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method JobsEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method JobsEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method JobsEntity[]    findAll()
 * @method JobsEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JobsRepository extends ServiceEntityRepository
{
    /**
     * The EntityManager used by this QueryBuilder.
     *
     * @var PaginatorInterface
     */
    private $paginator;

    public function __construct(ManagerRegistry $registry, PaginatorInterface $paginator)
    {
        parent::__construct($registry, JobsEntity::class);
        $this->paginator = $paginator;
    }

    /**
     * @param Request $request
     * @return \Knp\Component\Pager\Pagination\PaginationInterface
     * @throws \Exception
     */
    public function getJobs(Request $request) {
        try {
            $requestData = json_decode($request->getContent(), true);

            $job = $this->createQueryBuilder('job')
            ->leftJoin(CompaniesEntity::class, 'c', Join::WITH, 'c.id=job.company');

            // Add filter for add requesting filter type
            // Allow tye : '=', '!=','>', '<', '>=', '<=', 'IN', 'NOT IN'
            if (isset($requestData['filterData'])) {
                foreach ($requestData['filterData'] as $key => $filterData) {
                    $filterKey = $filterData['fieldName'];
                    if (self::allowFilterType($filterData['operation'])) {
                        if ($filterData['operation'] == 'IN') {
                            $qb = $job->andWhere('job.' . $filterData["fieldName"] . ' ' . $filterData["operation"] . ' (:' . $filterKey . ')')
                                ->setParameter($filterKey, $filterData["value"]);
                        } else {
                            $qb = $job->andWhere('job.' . $filterData['fieldName'] . ' ' . $filterData['operation'] . ' :' . $filterKey)
                                ->setParameter($filterKey, $filterData['value']);
                        }
                        unset($filterKey);
                    }
                }
            }

            // Add sorting for add requesting sorting type
            // Allow type: ASC, DESC,
            // If other type is not valid then set ASC is default
            if (isset($requestData['sortData'])) {
                foreach ($requestData['sortData'] as $sortData) {
                    $qb = $job->addOrderBy('job.' . $sortData['fieldName'], $sortData['type'] ? 'ASC' : 'DESC');
                }
            }

            // Add search for requesting search type
            if (isset($requestData['searchData'])) {
                $qb = $job->orWhere('job.' . $requestData['searchData']['fieldName'] . ' LIKE :' . $requestData['searchData']['fieldName'])
                    ->setParameter($requestData['searchData']['fieldName'], '%' . $requestData['searchData']['value'] . '%');
            }
            //var_dump($job->getQuery()->getSQL()); exit;

            // Add pagination
            // page and limit is not set then set default is 1, 10.
            $pagination = $this->paginator->paginate(
                $qb,
                $requestData['page'] ? $requestData['page'] : 1,
                $requestData['limit'] ? $requestData['limit'] : 10
            );

            return $pagination;
        } catch (Exception $exception) {
            throw new \Exception($exception->getMessage(), Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param $type
     * @throws \Exception
     */
    private function allowFilterType($type) {
        $staus = false;
        $allType = ['=', '!=','>', '<', '>=', '<=', 'IN', 'NOT IN'];
        if(in_array($type, $allType)) {
            return true;
        }
        if(!$staus) {
            throw new \Exception("Operator type is not valid, Please enter below operoter :". implode(',', $allType), Response::HTTP_NOT_FOUND);
        }
    }
}
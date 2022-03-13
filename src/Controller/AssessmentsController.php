<?php
/**
 * Created by PhpStorm.
 * User: ankur
 * Date: 12/3/22
 * Time: 2:27 PM
 */

namespace App\Controller;


use App\Entity\JobsEntity;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
/**
 * Assessments Controller.
 * @Rest\Route("/api",name="api_")
 */

class AssessmentsController extends AbstractFOSRestController
{
    /**
     * The EntityManager used by this QueryBuilder.
     *
     * @var EntityManagerInterface
     */
    private $entityManager;


    public function __construct(EntityManagerInterface $em)
    {
        $this->entityManager = $em;
    }

    /**
     * @Rest\Post("/jobs")
     * @param Request $request
     * @return View
     */
    public function getJobAction(Request $request):View
    {
        try {
            $jobResult = $this->entityManager->getRepository(JobsEntity::class)->getJobs($request);

            return View::create($jobResult, Response::HTTP_OK);
        } catch (\Exception $exception) {
            $error = array(
                'error' => array(
                    'msg' => $exception->getMessage(),
                    'code' => $exception->getCode(),
                ),
            );
            return View::create($error, Response::HTTP_NOT_FOUND);
        }

    }
}
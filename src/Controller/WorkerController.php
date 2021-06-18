<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Worker;
use App\Form\WorkerType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Uid\Uuid;

class WorkerController extends AbstractApiController
{
    /**
     * Adding new worker to database
     * @Route("/api/workers", name="add_worker", methods={"POST"})
     */
    public function addWorker(Request $request): Response
    {
        $form = $this->buildForm(WorkerType::class);

        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            return $this->respond($form, Response::HTTP_BAD_REQUEST);
        }

        /** @var Worker $worker */
        $worker = $form->getData();
        $worker->setUuid(Uuid::v4());

        $this->getDoctrine()->getManager()->persist($worker);
        $this->getDoctrine()->getManager()->flush();

        return $this->respond($worker);
    }

    /**
     * Listing all of the workers
     * @Route("/api/workers", name="list_workers", methods={"GET"})
     */
    public function listWorkers(Request $request): Response
    {
        $workers = $this->getDoctrine()->getRepository(Worker::class)->findAll();

        return $this->respond($workers);
    }

    /**
     * Getting worker info based on provided uuid
     * @Route("/api/workers/{uuid}", name="get_worker", methods={"GET"})
     */
    public function getWorker(Request $request, string $uuid): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $worker = $entityManager->getRepository(Worker::class)->findOneBy([
            'uuid' => $uuid,
        ]);

        if (null === $worker) {
            throw new NotFoundHttpException('Wrong uuid - worker not found');
        }

        return $this->respond($worker);
    }

    /**
     * Deleting worker info based on provided uuid
     * @Route("/api/workers/{uuid}", name="delete_worker", methods={"DELETE"})
     */
    public function deleteWorker(Request $request, string $uuid): JsonResponse
    {
        $entityManager = $this->getDoctrine()->getManager();

        $worker = $entityManager->getRepository(Worker::class)->findOneBy([
            'uuid' => $uuid,
        ]);

        if (null === $worker) {
            throw new NotFoundHttpException('Wrong uuid - worker not found');
        }

        $entityManager->remove($worker);
        $entityManager->flush();

        return new JsonResponse('Worker has been deleted');
    }

    /**
     * Gets the results of avg salaries for certain worker types, and for whole company
     * @Route("/api/salary", name="get_salary", methods={"GET"})
     */
    public function salaryDetails(Request $request): Response
    {
        $avgArr = [];
        $allSalaries = 0;
        $workerTypes = ['CEO', 'FOUNDER', 'MANAGER', 'REGULAR'];
        $workers = (array) $this->getDoctrine()->getRepository(Worker::class)->findAll();

        foreach ($workerTypes as $type) {
            $typeCount = 0;
            $typeSalary = 0;
            foreach ($workers as $worker) {
                if ($type === $worker->getWorkerType()) {
                    $typeSalary += $worker->getSalary();
                    ++$typeCount;
                }
                $allSalaries += $worker->getSalary();
            }
            $typeSalary = $typeSalary / $typeCount;
            $avgArr['average salary for '.$type] = $typeSalary;
        }

        $avgArr['average salary in company'] = $allSalaries / count($workers);

        return new JsonResponse($avgArr);
    }
}

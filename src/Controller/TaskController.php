<?php

namespace App\Controller;

use App\Entity\Task;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/api/tasks", name="tasks.")
 */

class TaskController extends AbstractController
{
    #[Route('/task', name: 'task')]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/TaskController.php',
        ]);
    }

    /**
     * @Route("/create", name="create", methods={"POST"})
     */
    public function create(Request $request)
    {
        $date = new DateTime('now');

        $task = new Task();
        $task->setTitle($request->get('title'));
        $task->setContent($request->get('content'));
        $task->setCreated($date, 'Y-m-d H:i:s');

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return new Response("Task Created");
    }

    /**
     * @Route("/task/{id}", name="read", methods={"GET"})
     */
    public function read(Request $request)
    {
        $id = $request->get('id');

        $task = $this->getDoctrine()->getManager()
            ->getRepository(Task::class)
            ->find($id);

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id ' . $id
            );
        }

        return new Response('Title: ' . $task->getTitle() . ' Content:' . $task->getContent());
    }

    /**
     * @Route("/update/{id}", name="update", methods={"PATCH"})
     */
    public function update(Request $request)
    {
        $id = $request->get('id');
        $date = new DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $task = $em->getRepository(Task::class)->find($id);

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id ' . $id
            );
        }

        $task->setTitle($request->get('title'));
        $task->setContent($request->get('content'));
        $task->setCreated($date, 'Y-m-d H:i:s');
        $em->flush();

        return new Response('Task Updated');
    }

    /**
     * @Route("/delete/{id}", name="delete", methods={"PUT"})
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();

        $task = $em
            ->getRepository(Task::class)
            ->find($id);

        if (!$task) {
            throw $this->createNotFoundException(
                'No task found for id ' . $id
            );
        }

        $em->remove($task);
        $em->flush();

        return new Response('Task Deleted');
    }
}

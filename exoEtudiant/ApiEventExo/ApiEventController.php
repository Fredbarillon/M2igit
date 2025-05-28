<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\EventClass;

#[Route('/api/events')]
class ApiEventController extends AbstractController
{
    private array $eventTable = [];

    public function __construct()
    {
        session_start();

        if (!isset($_SESSION['eventTable'])) {
            $_SESSION['eventTable'] = [
                1 => new EventClass(1, 'réunion Symfony', 'Paris', '2028-06-10', true),
                2 => new EventClass(2, 'Meetup barbecue coding', 'Valence', '2025-07-05', false),
            ];
        }

        $this->eventTable = &$_SESSION['eventTable'];
    }

    #[Route('', name: 'get_events', methods: ['GET'])]
    public function list(Request $request): JsonResponse
    {
        $location = $request->query->get('location');

        $filteredEvents = [];

        foreach ($this->eventTable as $event) {
            if (!$location || strtolower($event->location) === strtolower($location)) {
                $filteredEvents[] = $event;
            }
        }

        return new JsonResponse($filteredEvents, Response::HTTP_OK);
    }

    #[Route('/public', name: 'get_public_events', methods: ['GET'])]
    public function listPublic(): JsonResponse
    {
        $publicEvents = array_values(array_filter($this->eventTable, fn($event) => $event->isPublic));
        return new JsonResponse($publicEvents, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'get_event', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return isset($this->eventTable[$id])
            ? new JsonResponse($this->eventTable[$id], Response::HTTP_OK)
            : new JsonResponse(['error' => 'Événement non trouvé'], Response::HTTP_NOT_FOUND);
    }

    #[Route('', name: 'add_event', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $id = rand(100, 999);
        $event = new EventClass($id, $data['title'], $data['location'], $data['date'], $data['isPublic']);
        $this->eventTable[$id] = $event;

        return new JsonResponse([
            'message' => 'Événement ajouté',
            'event' => $event,
        ], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: 'update_event', methods: ['PUT'])]
    public function update(Request $request, int $id): JsonResponse
    {
        if (!isset($this->eventTable[$id])) {
            return new JsonResponse(['error' => 'Événement introuvable'], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);
        $this->eventTable[$id] = new EventClass($id, $data['title'], $data['location'], $data['date'], $data['isPublic']);

        return new JsonResponse([
            'message' => 'Événement mis à jour',
            'event' => $this->eventTable[$id],
        ], Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'delete_event', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        if (!isset($this->eventTable[$id])) {
            return new JsonResponse(['error' => 'Événement introuvable'], Response::HTTP_NOT_FOUND);
        }

        unset($this->eventTable[$id]);

        return new JsonResponse(['message' => 'Événement supprimé'], Response::HTTP_NO_CONTENT);
    }
}

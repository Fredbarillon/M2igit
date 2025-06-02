 Voici un projet Symfony très simple, minimaliste, avec :

    ✅ Un service (UserService) qui appelle un repository

    ✅ Une interface (UserServiceInterface) injectée dans le contrôleur

    ✅ Et bien sûr, le repository (UserRepository) accède à une entité (User)

    ✅ Le tout auto-injecté par Symfony

🧱 Structure minimale

src/
├── Controller/
│   └── UserController.php
├── Entity/
│   └── User.php
├── Repository/
│   └── UserRepository.php
├── Service/
│   ├── UserServiceInterface.php
│   └── UserService.php

1. 👤 Entité User

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: \App\Repository\UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $email;

    public function getId(): ?int { return $this->id; }
    public function getEmail(): string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }
}

2. 🗃️ Repository UserRepository

// src/Repository/UserRepository.php
namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function findFirst(): ?User
    {
        return $this->createQueryBuilder('u')
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }
}

3. 📑 Interface UserServiceInterface

// src/Service/UserServiceInterface.php
namespace App\Service;

use App\Entity\User;

interface UserServiceInterface
{
    public function getFirstUser(): ?User;
}

4. ⚙️ Service UserService

// src/Service/UserService.php
namespace App\Service;

use App\Repository\UserRepository;
use App\Entity\User;

class UserService implements UserServiceInterface
{
    public function __construct(
        private UserRepository $userRepository
    ) {}

    public function getFirstUser(): ?User
    {
        return $this->userRepository->findFirst();
    }
}

5. 🧭 Contrôleur UserController

// src/Controller/UserController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UserServiceInterface;

class UserController extends AbstractController
{
    #[Route('/api/first-user', name: 'first_user')]
    public function firstUser(UserServiceInterface $userService): JsonResponse
    {
        $user = $userService->getFirstUser();

        if (!$user) {
            return $this->json(['error' => 'No user found'], 404);
        }

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail()
        ]);
    }
}

6. 🧩 services.yaml (uniquement si autowiring ne suffit pas)

Symfony détecte l’implémentation automatiquement si :

    autowire: true ✅

    le nom de l’interface correspond au nom du service injecté

Mais pour être explicite, tu peux ajouter dans config/services.yaml :

services:
    App\Service\UserServiceInterface: '@App\Service\UserService'

✅ Et voilà !

Tu peux maintenant lancer :

symfony serve

Et tester :

GET http://localhost:8000/api/first-user
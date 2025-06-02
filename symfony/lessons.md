🧱 Symfony – Fiche Complète
1. ⚙️ Prérequis techniques

    PHP 8.1 minimum

    Composer

    Symfony CLI

    Serveur : SQLite, MySQL ou PostgreSQL

2. 🚀 Création d’un projet

symfony new mon-projet --webapp  # version avec tout sauf couche Service
symfony new mon-projet --full    # version complète
symfony new mon-projet --demo    # projet démo interactif

3. 🗂️ Arborescence d’un projet Symfony
Dossier / Fichier	Rôle
/src	Code source PHP (contrôleurs, services, entités, etc.)
/templates	Vues Twig
/public	Point d’entrée HTTP (index.php), assets compilés
/config	Configuration des routes, services, doctrine, etc.
/migrations	Historique des modifications de BDD
/var	Logs, cache, fichiers temporaires
/vendor	Dépendances installées via Composer
.env / .env.local	Variables d’environnement
/assets	Fichiers front-end sources (JS, CSS, images)
/node_modules	Dépendances Node.js (si Webpack/Encore utilisé)
/bin	Fichiers exécutables (console Symfony, etc.)

🟨 bin/console : permet d’exécuter des commandes CLI Symfony.
4. 📡 Lancer le serveur local

symfony serve
symfony serve --https  # version HTTPS

5. 🔒 Fichiers à ne jamais committer

    .env.local

    fichiers de sessions/cache/logs

    secrets

    clés API

✅ Ajoutés par défaut dans .gitignore.
6. 🛠️ Commandes utiles Symfony

symfony server:log                 # Affiche les logs temps réel
php bin/console debug:router      # Liste des routes
php bin/console debug:config      # Voir la config d’un bundle

7. 📦 Symfony UX

🔎 Question posée : Symfony UX, à quoi ça sert ? Comment l’installer ?

🟨 Symfony UX est un ensemble d’intégrations JavaScript modernes (Stimulus, Turbo, Chart.js, Dropzone, etc.) prêtes à l’emploi avec Symfony.

composer require symfony/ux-turbo
yarn install
yarn encore dev

➡️ Permet de créer des interfaces plus réactives sans réécrire tout le front en React/Vue.
8. 📍 Définir ses routes
Avec les attributs PHP (recommandé)

#[Route('/chemin', name: 'nom', methods: ['GET'])]

Ou dans des fichiers .yaml

🟨 Exemple config/routes/event.yaml :

event_list:
  path: /api/events
  controller: App\Controller\ApiEventController::list
  methods: [GET]

Et dans routes.yaml :

imports:
  - { resource: routes/event.yaml }

9. 🔀 HTTP Status Codes (demandé)
Code	Signification
300	Redirection multiple (rarement utilisé)
301	Redirection permanente
302	Redirection temporaire
303	Redirection pour POST/GET
304	Not Modified (mise en cache)
305	Use Proxy (déprécié)
400	Bad Request
401	Unauthorized (authentification requise)
402	Payment Required (réservé pour futur usage)
403	Forbidden
404	Not Found
405	Method Not Allowed
500	Internal Server Error
501	Not Implemented
502	Bad Gateway
503	Service Unavailable
504	Gateway Timeout
505	HTTP Version Not Supported

10. 🧠 Injection de dépendances (DI)

    🔎 Symfony injecte automatiquement les services dont tu as besoin grâce à son container.

🔁 Schéma exemple :

    MessageController → dépend de NotificationService

    NotificationService → dépend de UserRepository

## 🧠 Principe général : Injection de dépendances
injection de couches basse vers les plus haute ent passant par do et dto
    Plutôt que de créer toi-même les objets dont tu as besoin (new MonService()), Symfony les "injecte" automatiquement dans ton code via le constructeur, grâce à son container de services.

🧩 Exemple Complet
📁 Structure :

    MessageController : utilise un NotificationService

    NotificationService : utilise un UserRepository

1. 🎯 Le Repository (existant automatiquement)

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

    public function findAllEmails(): array
    {
        return $this->createQueryBuilder('u')
            ->select('u.email')
            ->getQuery()
            ->getSingleColumnResult();
    }
}

## 📝 Le repository est automatiquement enregistré comme service par Symfony si tu as autowire: true.
2. 🛠 Le Service qui utilise le Repository (Injection ici)

// src/Service/NotificationService.php

namespace App\Service;

use App\Repository\UserRepository;

class NotificationService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function notifyAll(): void
    {
        $emails = $this->userRepository->findAllEmails();

        foreach ($emails as $email) {
            // Envoi d’un email fictif
            echo "Notification envoyée à $email\n";
        }
    }
}

## 📌 Ici, Symfony injecte automatiquement UserRepository dans NotificationService.
3. 🧭 Le Controller qui utilise le Service (Injection ici aussi)

// src/Controller/MessageController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\NotificationService;

class MessageController extends AbstractController
{
    #[Route('/notify', name: 'notify')]
    public function notifyAll(NotificationService $notificationService): Response
    {
        $notificationService->notifyAll();

        return new Response("Notifications envoyées !");
    }
}

## 📌 Ici, Symfony injecte automatiquement le service dans le contrôleur, sans que tu aies à t’en occuper.
## 🧪 Résultat en visitant /notify

Tu verras :

Notification envoyée à alice@example.com
Notification envoyée à bob@example.com
...

✅ Résumé des injections
Cible	Injecté automatiquement ?	Comment ?
NotificationService	✅ oui	Via constructeur du controller
UserRepository	✅ oui	Via constructeur du service

11. 🧩 DTO – Data Transfer Object

    Objectif : transférer uniquement les données utiles (ex : pas le mot de passe de l’utilisateur).

    Est-ce que le DTO sert à cacher les infos des entités ?

✔ Oui. Il sert à filtrer, formater et protéger les données partagées avec les vues ou les API.

le dto créer dans un service permet de cacher les info des entités : donne moi un exemple de ca
Exactement ! 👌 En architecture propre, le DTO (Data Transfer Object) sert à transporter des données structurées sans exposer l’entité entière (et donc sans fuite de données sensibles ou inutilement complexes). C’est une bonne pratique entre les couches (ex : controller → service → DTO → view/API).
## 📌 Contexte de l’exemple

Imaginons une entité User qui contient des informations sensibles comme le mot de passe ou le rôle, mais on veut exposer uniquement le prénom, le nom et l’email dans une API.
1. 🧬 L'entité User

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private string $firstName;

    #[ORM\Column(length: 100)]
    private string $lastName;

    #[ORM\Column(length: 180, unique: true)]
    private string $email;

    #[ORM\Column]
    private string $password;

    #[ORM\Column]
    private string $role;

    // Getters et Setters ...
}

2. 🧾 Le DTO UserPublicDto

// src/Dto/UserPublicDto.php
namespace App\Dto;

class UserPublicDto
{
    public string $firstName;
    public string $lastName;
    public string $email;

    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}

3. ⚙️ Le Service qui construit le DTO à partir de l’entité

// src/Service/UserFormatter.php
namespace App\Service;

use App\Entity\User;
use App\Dto\UserPublicDto;

class UserFormatter
{
    public function toPublicDto(User $user): UserPublicDto
    {
        return new UserPublicDto(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail()
        );
    }
}

4. 🧭 Le Controller qui retourne la version publique

// src/Controller/UserController.php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\UserFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/users/{id}', name: 'api_user')]
    public function getUser(int $id, UserRepository $repo, UserFormatter $formatter): JsonResponse
    {
        $user = $repo->find($id);

        if (!$user) {
            return $this->json(['error' => 'User not found'], 404);
        }

        $dto = $formatter->toPublicDto($user);

        return $this->json($dto);
    }
}

## 🔒 Bénéfices :

    Tu ne renvoies pas l’objet User directement → donc pas de mot de passe ni de rôle dans l’API.

    Le format de sortie est stable, même si l’entité évolue.

    Tu peux facilement tester ton DTO indépendamment.

exemple avec une api:
## 🧾 Objectif

    Retourner un tableau JSON contenant uniquement : firstName, lastName, email de chaque utilisateur (pas de mot de passe ni de rôle).

✅ Récapitulatif des fichiers (repris/complétés) :

    User (entité Doctrine) → avec données sensibles

    UserPublicDto (DTO)

    UserFormatter (service pour transformer des entités en DTOs)

    UserController (API GET /api/users)

1. 📄 Entité User (déjà vue)

Voir plus haut ⤴️ — rien à modifier.
2. 🧾 DTO UserPublicDto

// src/Dto/UserPublicDto.php
namespace App\Dto;

class UserPublicDto
{
    public string $firstName;
    public string $lastName;
    public string $email;

    public function __construct(string $firstName, string $lastName, string $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }
}

3. ⚙️ Service UserFormatter

// src/Service/UserFormatter.php
namespace App\Service;

use App\Entity\User;
use App\Dto\UserPublicDto;

/**
 * Convertit des entités User en DTO publics
 */
class UserFormatter
{
    public function toPublicDto(User $user): UserPublicDto
    {
        return new UserPublicDto(
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail()
        );
    }

    /**
     * Convertit une liste d'entités User en liste de DTO
     */
    public function toPublicDtoList(array $users): array
    {
        return array_map(fn(User $u) => $this->toPublicDto($u), $users);
    }
}

4. 🧭 Controller avec route /api/users

// src/Controller/UserController.php
namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\UserFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    #[Route('/api/users', name: 'api_users', methods: ['GET'])]
    public function list(UserRepository $repo, UserFormatter $formatter): JsonResponse
    {
        $users = $repo->findAll(); // Renvoie des entités complètes
        $dtos = $formatter->toPublicDtoList($users);

        return $this->json($dtos);
    }
}

✅ Résultat JSON attendu (exemple)

[
  {
    "firstName": "Alice",
    "lastName": "Dupont",
    "email": "alice@example.com"
  },
  {
    "firstName": "Bob",
    "lastName": "Martin",
    "email": "bob@example.com"
  }
]

💡 Astuce : Si tu veux filtrer les utilisateurs actifs uniquement

Tu peux ajouter une méthode comme :

public function findActive(): array
{
    return $this->createQueryBuilder('u')
        ->where('u.isActive = true')
        ->getQuery()
        ->getResult();
}

Et appeler $repo->findActive() dans le contrôleur.

12. 🧪 TDD (Test-Driven Development)


➡️ On part du principe : écrire les tests en premier, puis coder.

Exemples de tests possibles :

    Tester le service NotificationService

    Vérifier qu’un UserFormatter renvoie bien un UserPublicDto

    S’assurer qu’un endpoint API retourne un 404 pour un utilisateur inexistant

13. 🔄 Remarques pratiques

    Ne surcharge pas les contrôleurs → délègue la logique métier à des services.

    index.php (dans /public) est le point d’entrée : ne jamais le modifier directement.

    Twig peut être utilisé même dans une architecture SPA (avec hx-boost, turbo, ou Symfony UX).


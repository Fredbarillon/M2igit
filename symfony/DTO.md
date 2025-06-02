## 🧾 Définition : Qu’est-ce qu’un DTO ?

Un DTO (Data Transfer Object) est un objet simple qui sert uniquement à transporter des données entre les différentes couches de ton application (ex : du service vers le contrôleur, ou d’une API vers ton code interne), sans logique métier.

Il est utilisé pour :

    Structurer des données échangées,

    Masquer l’implémentation des entités (ex : cacher un mot de passe),

    Limiter le couplage entre les couches (API / service / base de données),

    Préparer des formats propres à l’envoi (API, formulaires, etc.).

📦 Exemple simple

Imaginons une entité User :

// Entité Doctrine
class User {
    private int $id;
    private string $email;
    private string $password;
    private string $role;
}

Tu veux exposer à ton front seulement : email et role.

➡️ Tu crées un DTO :

// src/Dto/UserDto.php
class UserDto {
    public string $email;
    public string $role;

    public function __construct(string $email, string $role)
    {
        $this->email = $email;
        $this->role = $role;
    }
}

Et depuis un service ou un formatter :

$userDto = new UserDto($user->getEmail(), $user->getRole());

Tu renvoies ça à l'API, pas l'entité brute.
🧠 Pourquoi ne pas retourner directement l’entité ?

Parce que les entités :

    contiennent des données sensibles (mot de passe, tokens...),

    ont souvent des relations Doctrine paresseuses qui génèrent des erreurs (LazyInitializationException en JSON),

    sont très liées à ta base de données → si la base change, le format JSON change aussi (c’est mauvais).

🧱 Caractéristiques d’un DTO
Caractéristique	Détail
Pas de logique métier	Un DTO n'a pas de règles ni de comportements métier (pas de méthode calculateX())
Constructeur ou propriétés publiques	Le plus simple possible – juste un conteneur de données
Format contrôlé	Tu choisis exactement ce qui est visible, dans quel ordre, avec quels noms
Indépendant de Doctrine	Ne dépend pas des annotations ORM ou du cycle de vie d’une entité
🔄 Où les utilise-t-on concrètement ?
Couches	Exemple
Controller → Service	Un formulaire ou une API envoie un DTO qui est validé, puis transformé en entité
Service → Controller	Le service renvoie un DTO au contrôleur, qui le retourne en JSON
API → Form Type	Symfony peut mapper un formulaire directement sur un DTO
🧰 DTO en entrée vs DTO en sortie
✅ DTO en sortie (output DTO)

    Ex : pour lire / afficher des données

    Format propre, lisible, sans données internes

    UserPublicDto, ProductCardDto, etc.

✍️ DTO en entrée (input DTO)

    Ex : pour recevoir un POST/PUT

    Tu utilises ce DTO avec le composant Form, ou en lecture JSON via des contrôleurs API

    Exemple : RegisterUserDto, UpdateProfileDto, etc.

class RegisterUserDto {
    public string $email;
    public string $plainPassword;
}

🛡️ Bonus : pourquoi c’est encore plus utile en API

Avec API Platform ou une API custom, un DTO :

    Te protège contre les effets de bord liés à l'entité (persist() involontaire, cascade mal gérée…),

    Permet des formats personnalisés : ajouter des champs calculés, renommer des propriétés, etc.

✅ Avantages des DTO

✔ Mieux structurer les données
✔ Améliorer la sécurité (ne pas exposer l'entité)
✔ Découpler les couches métier, persistante et présentation
✔ Favoriser les tests unitaires (plus facile à mocker)
✔ Compatible avec la validation Symfony (@Assert\NotBlank etc.)
🧭 Schéma – Cycle d’un DTO dans Symfony

          🎯 Utilisateur / Frontend
                  |
                  |   (1) Envoie JSON ou formulaire
                  v
          🎮 Controller (ex: UserController)
                  |
                  |   (2) Injection d'un DTO en entrée
                  v
          🧠 Service (ex: UserManager)
                  |
                  |   (3) Hydrate l'entité depuis DTO
                  |   (4) Appelle le repository (save)
                  |
                  |   (5) Crée un DTO de sortie
                  v
          🎮 Controller (retour)
                  |
                  |   (6) Retourne DTO → JSON
                  v
          📲 Frontend reçoit réponse propre et filtrée

📥 Exemple de DTO en entrée (input) + validation
DTO d’enregistrement (input)

// src/Dto/RegisterUserDto.php
namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 8)]
    public string $plainPassword;
}

Utilisation dans un contrôleur (ex: POST /api/register)

// src/Controller/RegistrationController.php
#[Route('/api/register', methods: ['POST'])]
public function register(
    Request $request, 
    ValidatorInterface $validator, 
    UserManager $userManager
): JsonResponse {
    $data = json_decode($request->getContent(), true);

    $dto = new RegisterUserDto();
    $dto->email = $data['email'] ?? '';
    $dto->plainPassword = $data['plainPassword'] ?? '';

    $errors = $validator->validate($dto);

    if (count($errors) > 0) {
        return $this->json(['errors' => (string) $errors], 400);
    }

    $userManager->register($dto);

    return $this->json(['status' => 'User created'], 201);
}

Dans le service : conversion DTO → entité

// src/Service/UserManager.php
class UserManager
{
    public function __construct(
        private EntityManagerInterface $em,
        private UserPasswordHasherInterface $hasher
    ) {}

    public function register(RegisterUserDto $dto): void
    {
        $user = new User();
        $user->setEmail($dto->email);
        $user->setPassword($this->hasher->hashPassword($user, $dto->plainPassword));
        $user->setRole('ROLE_USER');

        $this->em->persist($user);
        $this->em->flush();
    }
}

📤 Exemple de DTO en sortie (output)

Comme dans les messages précédents, tu crées un UserPublicDto :

class UserPublicDto
{
    public function __construct(
        public string $email,
        public string $firstName,
        public string $lastName,
    ) {}
}

Puis dans ton UserManager :

public function toPublicDto(User $user): UserPublicDto
{
    return new UserPublicDto(
        $user->getEmail(),
        $user->getFirstName(),
        $user->getLastName()
    );
}

🔐 Résultat : plus de sécurité, plus de clarté
✅ Bonne pratique	⛔ Mauvaise pratique (à éviter)
Utiliser un DTO bien défini	Renvoyer une entité Doctrine brute
Valider le DTO avec Symfony	Valider le tableau $data[] à la main
Mapper DTO → entité → base	Injecter l’EntityManager dans le contrôleur
Renvoyer un DTO formaté	Laisser API Platform exposer tout par défaut

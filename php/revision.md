## 🐘 PHP Vanilla – Bases & Astuces avancées
📌 1. Bases de PHP

# commentaire sur une ligne 
// même chose
/* commentaire multiligne */

'' = ne supporte pas les caractères spéciaux  
"" = les supporte, utile pour les sauts de ligne ou tabulations

echo("world");
echo '\t plouf\n'; // affichera littéralement \t et \n

// Affichage en terminal :
php ./php_test.php 

$string = "a string";
echo $string . PHP_EOL; // PHP_EOL est l'équivalent de \n

var_dump($string); // affiche valeur et type
gettype($string);  // retourne seulement le type
print($string);    // comme echo, mais retourne toujours 1

// echo vs print :
/*
- echo n’a pas de valeur de retour (plus rapide)
- print retourne 1 (utilisable dans des expressions)
- echo accepte plusieurs arguments (rarement utilisé ainsi)
*/

$prenom = readline("Entrez votre prénom: "); // entrée utilisateur en console (toujours string)

$age = (int)readline("Quel âge ? ");
var_dump($age);
var_export($age == 1)
The var_export() function outputs or returns structured information about a variable.

This function works similar to var_dump(), except that the returned value for this function is valid PHP code.
Syntax
var_export(variable, return);

## CONCATÉNATION
"Bonjour " . $prenom
"Bonjour $prenom" // fonctionne dans les doubles guillemets

unset($prenom); // détruit une variable


## ⚙️ PHP – Les opérateurs
🔢 1. Opérateurs arithmétiques
Opérateur	Signification	Exemple	Résultat
+	Addition	$a + $b	2 + 3 = 5
-	Soustraction	$a - $b	5 - 2 = 3
*	Multiplication	$a * $b	2 * 3 = 6
/	Division	$a / $b	6 / 2 = 3
%	Modulo (reste)	$a % $b	5 % 2 = 1
**	Puissance	$a ** $b	2 ** 3 = 8
➕ 2. Opérateurs d'affectation
Opérateur	Signification	Exemple
=	Affectation simple	$a = 5
+=	Ajout puis affectation	$a += 2 → $a = $a + 2
-=	Soustraction puis affectation	$a -= 2
*=	Multiplication puis affectation	$a *= 3
/=	Division puis affectation	$a /= 2
%=	Modulo puis affectation	$a %= 3
**=	Puissance puis affectation	$a **= 2
🤔 3. Opérateurs de comparaison
Opérateur	Signification	Exemple	Résultat (si $a = 5)
==	Égalité (valeur)	$a == "5"	✅ true
===	Égalité stricte (valeur + type)	$a === "5"	❌ false
!=	Différent	$a != 4	✅ true
!==	Différent strictement	$a !== "5"	✅ true
<>	Différent (équivalent à !=)	$a <> 4	✅ true
<	Inférieur à	$a < 10	✅ true
>	Supérieur à	$a > 3	✅ true
<=	Inférieur ou égal à	$a <= 5	✅ true
>=	Supérieur ou égal à	$a >= 6	❌ false
<=>	Spaceship operator (PHP 7+)	$a <=> $b	-1, 0 ou 1

    📌 Spaceship operator :

        Retourne -1 si $a < $b

        Retourne 0 si $a == $b

        Retourne 1 si $a > $b

## 🔁 4. Opérateurs logiques (booléens)
Opérateur	Signification	Exemple
&&	ET logique	if ($a > 0 && $b > 0)
`		`
!	NON logique	if (!empty($a))
and	ET (priorité faible)	identique à &&
or	OU (priorité faible)	identique à `
xor	OU exclusif	true xor false → true
🔤 5. Opérateurs sur les chaînes
Opérateur	Signification	Exemple
.	Concaténation	$full = $a . " " . $b;
.=	Ajout de texte	$a .= " suite";

## 🧪 6. Autres opérateurs utiles

    isset($var) : retourne true si la variable existe et n’est pas null

    empty($var) : retourne true si la variable est vide (null, 0, "", false…)

    ?? : opérateur de coalescence (valeur par défaut)

$nom = $_GET['nom'] ?? 'inconnu';

    ?: : opérateur ternaire abrégé

$role = $userRole ?: 'invité';

    $a ? $b : $c : ternaire classique

$message = ($age >= 18) ? 'Majeur' : 'Mineur';

## CONTINUE ET BREAK
break = casse une boucle
continue = permet de sauter le bloc de code juste apres le continue afin d'isoler la logique de bloc qui le precede
ex: on isole une logique au cas ou un tarif est à un prix specifique, le bloc marche et on saute l'etape pour les autre prix avant de continuer la suite des instructions.

## 📝 PHP + HTML : Comment et pourquoi les mélanger ?
## 🧠 Pourquoi mélanger PHP et HTML ?
!! le fichier doit être un .php
PHP permet de générer dynamiquement du contenu HTML selon :

    Les données utilisateur (formulaire, session, base de données)

    Les conditions d'affichage (si connecté, admin, etc.)

Exemple :

<?php
$prenom = "Marie";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exemple PHP</title>
</head>
<body>
    <h2>Bonjour <?php echo $prenom; ?></h2>
</body>
</html>

Tu peux aussi combiner PHP avec du CSS :

<style>
    body {
        background-color: #f0f0f0;
    }
</style>

Tu peux aussi combiner PHP avec du js :
<script>
        function saluer() {
            alert("Bonjour depuis JavaScript !");
        }
    </script>

Autres exemples PHP :

<?php
echo "Hello, world!";
$nombre = 42;

if ($nombre > 10) {
    echo "Grand nombre";
} else {
    echo "Petit nombre";
}

for ($i = 0; $i < 5; $i++) {
    echo $i;
}

function direBonjour($nom) {
    return "Bonjour $nom !";
}
!!! penser a match(){} qui renvoi une valeur avec => ex 'string' =>'other string' . ca fait un ===
les ternaires:
condition? expSiVrai : exprSiFaux;
## 📦 2. PDO – Connexion sécurisée à MySQL

try {
    $pdo = new PDO("mysql:host=localhost;dbname=ma_db;charset=utf8", "user", "password");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE email = :email");
    $stmt->execute(['email' => 'test@example.com']);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

🔎 Explications :

    Utilise une interface objet

    Sécurise les requêtes (préparation + injection SQL évitée)

    Peut se configurer avec fetchAll, fetch, etc.

## 🧱 3. Architecture MVC – Structure minimale

project/
├── index.php
├── controllers/
│   └── HomeController.php
├── models/
│   └── User.php
├── views/
│   └── home.php
├── core/
│   ├── Router.php
│   └── Database.php

Exemple index.php

require_once 'core/Router.php';
$router = new Router();
$router->handleRequest();

🔎 Explications :

    Point d'entrée unique

    Initialise le routeur

    Centralise le fonctionnement du site/app

Router simplifié

class Router {
    public function handleRequest() {
        $controller = new HomeController();
        $controller->index();
    }
}

🔎 Explications :

    Ce routeur basique dirige toutes les requêtes vers une méthode.

    Peut être enrichi pour interpréter des segments d'URL.

## 🧩 4. Objets et Classes

class User {
    private string $name;

    public function __construct(string $name) {
        $this->name = $name;
    }

    public function greet(): string {
        return "Salut " . $this->name;
    }
}

$user = new User("Gaétan");
echo $user->greet();

🔎 Explications :

    Programmation orientée objet complète

    Supporte la visibilité (private, public)

    Bon pour MVC

## 🚀 5. Tips avancés & bonnes pratiques
🔹 Autochargement avec spl_autoload_register()

spl_autoload_register(function ($class) {
    $path = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});

🔎 Explications :

    Appelé automatiquement quand une classe est instanciée

    Remplace tous les require_once

    Gère les namespaces

🔹 Templates simples avec ob_start() / ob_get_clean()

ob_start();
include 'views/home.php';
$content = ob_get_clean();
include 'views/layout.php';

🔎 Explications :

    Capture un fichier HTML

    Injecte son contenu dans un layout

    Bonne base avant d’utiliser un moteur comme Twig

🔹 Séparer la configuration

// config/config.php
return [
    'db' => [
        'host' => 'localhost',
        'dbname' => 'ma_base',
        'user' => 'root',
        'password' => ''
    ]
];

🔎 Explications :

    Centralise les données sensibles ou répétitives

    Permet de les modifier sans toucher au reste du code

## 🌐 API et Routeur : Similitudes et différences
Élément	Routeur PHP (site MVC)	API REST
Point d’entrée	index.php via .htaccess	index.php ou /api/index.php
Routing	URI, paramètres GET/POST	URI + méthode HTTP (GET/POST/...)
Réponse	HTML (souvent)	JSON, XML
Authentification	Session	Token (JWT, API key, etc.)

// URL : /utilisateur/5
$uri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($uri, '/'));

if ($segments[0] === 'utilisateur' && is_numeric($segments[1])) {
    $id = (int)$segments[1];
    $userController = new UserController();
    $userController->show($id);
}

## 🔐 Restrictions :

    Pour un site : session, rôles, redirections

    Pour une API : tokens, ACL, 401/403

👉 En résumé :

    Un routeur PHP avec .htaccess centralise les requêtes

    Si tu retournes du JSON, tu fais une API REST en vanilla PHP !

## 🛠️ 6. À approfondir pendant la formation

    🔐 Sessions & cookies (authentification)

    📁 Upload de fichiers (validation et sécurité)

    🔄 Appels API (envoi/réception JSON)

    🛡️ Sécurité : CSRF, XSS, CORS

    🧪 Tests unitaires (PHPUnit)

    📦 Utilisation de Composer (autoloader, packages)
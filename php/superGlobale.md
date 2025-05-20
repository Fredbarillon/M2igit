## 🧰 PHP – Les Superglobales

Les superglobales sont des variables automatiquement disponibles dans tous les contextes d’un script PHP, sans besoin d’import ou de passage en paramètre.
## 🌍 $GLOBALS

    Contient toutes les variables globales du script.

    Accès universel, même dans une fonction.

$nom = "Marie";
function test() {
    echo $GLOBALS["nom"]; // Affiche "Marie"
}

## 🖥️ $_SERVER

    Contient des infos sur :

        L’environnement d’exécution

        Les entêtes HTTP

        Les chemins et fichiers appelés

    Exemples :

$_SERVER["REQUEST_METHOD"]   // "GET" ou "POST"
$_SERVER["PHP_SELF"]         // Le script en cours
$_SERVER["HTTP_USER_AGENT"]  // Infos sur le navigateur

## 🔗 $_GET

    Donne accès à tous les paramètres envoyés dans l’URL.

    Utilisé pour les liens avec paramètres (?page=1&tri=date)

    Vérifications recommandées :

if (!empty($_GET["page"])) { ... }
if (isset($_GET["tri"])) { ... }

    Test rapide :

print_r($_GET);

## 📨 $_POST

    Contient les données envoyées dans le corps de la requête, typiquement via un formulaire.

    Idéal pour les infos sensibles (mot de passe, données perso).

## 📎 $_FILES

    Contient toutes les données des fichiers uploadés.

    Structure complexe :

$_FILES["cv"]["name"];
$_FILES["cv"]["tmp_name"];
$_FILES["cv"]["error"];

## 🍪 $_COOKIE

    Contient tous les cookies envoyés par le client (navigateur).

    Pour enregistrer des préférences utilisateur :

    setcookie("theme", "dark", time() + 3600); // valide 1h
    echo $_COOKIE["theme"];

## 🗂️ $_SESSION

    Permet de stocker des infos côté serveur entre deux requêtes.

    Nécessite session_start(); en début de script.

    Les données sont liées à un identifiant de session stocké dans un cookie.

session_start();
$_SESSION["user"] = "admin";

    Pour supprimer la session :

session_unset();
session_destroy();

## 🧪 Exemple commenté

<?php
session_start();

// ➕ Mise à jour du cookie de visites
<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["nom"] = $_POST["nom"] ?? "nom par défaut";
    $_SESSION["prenom"] = $_POST["prenom"] ?? "prénom par défaut";
    // header("Location: " . $_SERVER["PHP_SELF"]);
    // exit;
}
if (isset($_GET["logout"])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

if (isset($_COOKIE["visites"])) {
    setcookie("visites", $_COOKIE["visites"] + 1, time() + 60);
} else {
    setcookie("visites", 1, time() + 60);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice Superglobales</title>
</head>
<body>

    <?php if (isset($_SESSION["nom"]) && isset($_SESSION["prenom"])): ?>
        <h1>BIENVENUE <?= ($_SESSION["prenom"]) . " " . ($_SESSION["nom"]) ?></h1>
        <form method="get">
            <button type="submit" name="logout" value="1" >Se déconnecter</button>
        </form>
    <?php else: ?>
            <h1>BIENVENUE POUR VOTRE PREMIERE VISITE</h1>
            <h2>Formulaire de connexion</h2>
            <form method="post">
                <input type="text" name="nom" placeholder="Nom" required>
                <input type="text" name="prenom" placeholder="Prénom" required>
                <button type="submit">Se connecter</button>
            </form>
    <?php endif; ?>
            <p>visite numero: <?= $_COOKIE["visites"] ?> .</p>

</body>
</html>

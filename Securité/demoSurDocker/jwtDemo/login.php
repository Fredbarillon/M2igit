<?php
require_once 'jwt_utils.php'; // 📥 Importe les fonctions liées aux JWT (par exemple : generateJWT())

// 🔁 Vérifie si le formulaire a été soumis en méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 🔐 Récupère les champs 'user' et 'password' envoyés par le formulaire, ou les initialise à vide si absents
    $user = $_POST['user'] ?? '';
    $password = $_POST['password'] ?? '';

    // ✅ Vérifie si les identifiants sont corrects (ici hardcodés : admin / secret)
    if ($user === 'admin' && $password === 's') {

        // 🔑 Génére un JWT pour l'utilisateur admin avec un rôle 'admin'
        $jwt = generateJWT('admin', 'admin');

        // 🍪 Crée un cookie nommé 'token' contenant le JWT, valable 1h (3600 sec)
        // Arguments : (nom, valeur, expiration, chemin, domaine, secure, httponly)
        setcookie("token", $jwt, time() + 3600, "/", "", false, true);
        // ❗️Remarques :
        // - `secure = false` ici → le cookie peut être transmis même sans HTTPS (pas recommandé en prod)
        // - `httponly = true` → le cookie n’est pas accessible via JavaScript (bonne protection XSS)

        // 🔁 Redirige vers une page protégée `secure.php`
        header('Location: secure.php');

        // ⛔ Stoppe le script après la redirection
        exit;
    } else {
        // ❌ Si les identifiants sont incorrects, on stocke un message d'erreur
        $error = "Identifiants incorrects.";
    }
}
?>

<!-- 📄 Formulaire HTML affiché même si rien n’a été soumis -->
<form method="POST">

    <!-- ⚠️ Si une erreur existe, elle est affichée ici -->
    <?php if (isset($error)): ?><p><?= $error ?></p><?php endif; ?>

    <!-- 📝 Champ utilisateur -->
    Utilisateur : <input name="user"><br>

    <!-- 🔒 Champ mot de passe -->
    Mot de passe : <input name="password" type="password"><br>

    <!-- ✅ Bouton de soumission -->
    <button>Connexion</button>
</form>

<?php
require_once 'jwt_utils.php'; // 📥 Inclut le fichier contenant les fonctions liées au JWT (par ex. validateJWT())

// 🔐 Vérification d'accès protégée par JWT :
if (
    !isset($_COOKIE['token'])                                 // ❌ Si le cookie 'token' n'existe pas
    || !($decoded = validateJWT($_COOKIE['token']))           // ❌ Ou si le token est invalide (échec de la validation ou signature incorrecte)
    || $decoded->role !== 'admin'                             // ❌ Ou si le rôle dans le token n'est pas 'admin'
) {
    http_response_code(403);                                  // 🔒 Renvoie une erreur HTTP 403 (Accès interdit)
    exit("⛔️ Accès refusé : Jeton invalide ou droits insuffisants."); // 🛑 Arrête l'exécution avec un message d'erreur
}
?>

<!-- ✅ Si le token est valide et le rôle est "admin", on continue l’affichage -->

<h2>✅ Bienvenue <?= htmlspecialchars($decoded->user) ?> (admin JWT)</h2>
<!-- 🧼 htmlspecialchars empêche les attaques XSS au cas où la valeur du user contiendrait du HTML -->

<a href="logout.php">Déconnexion</a>
<!-- 🔓 Lien vers le script de déconnexion (qui efface le cookie 'token') -->

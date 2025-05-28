<?php
// 🧹 Supprime le cookie nommé 'token' en le remplaçant par une valeur vide et une date d'expiration passée
setcookie('token', '', time() - 3600, "/", "", false, true);

// 🔁 Redirige l'utilisateur vers la page d'accueil (index.php)
header('Location: index.php');

// ⛔ Interrompt l'exécution du script immédiatement après la redirection
exit;
?>
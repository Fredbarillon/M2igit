<!-- 2 fonction ici pour s'assurer que le jwt est base_convert -->

<?php
require __DIR__.'/vendor/autoload.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

const JWT_SECRET = 'MyUltraSecretKey123!';  // clé secrète forte

// Générer un JWT
function generateJWT($user, $role): string {
    $payload = [
        'user' => $user,
        'role' => $role,
        'iat' => time(),
        'exp' => time() + 3600  // expire dans 1h
    ];
    return JWT::encode($payload, JWT_SECRET, 'HS256');
}

// Valider et décoder le JWT
function validateJWT($jwt) {
    try {
        return JWT::decode($jwt, new Key(JWT_SECRET, 'HS256'));
    } catch (Exception $e) {
        return null;
    }
}
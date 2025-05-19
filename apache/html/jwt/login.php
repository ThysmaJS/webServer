<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'jwt_utils.php';

// Vérifie méthode HTTP
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

// Récupère le JSON envoyé
$input = json_decode(file_get_contents("php://input"), true);

if (!isset($input['username'], $input['password'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Identifiants manquants']);
    exit;
}

$username = $input['username'];
$password = $input['password'];

// Connexion PostgreSQL (adapté à ton docker-compose)
$host = 'postgres';
$db = 'authCB';
$user = 'authcb';
$pass = 'authcb';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête utilisateur
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user || !password_verify($password, $user['password'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Identifiants invalides']);
        exit;
    }

    // Génération JWT
    $secret = 'donsecure123';
    $payload = [
        'user' => $user['username'],
        'exp' => time() + 1800
    ];

    $jwt = generate_jwt($payload, $secret);

    // Cookie sécurisé
    setcookie("jwt_token", $jwt, [
        'expires' => time() + 1800,
        'path' => '/',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);

    header('Content-Type: application/json');
    echo json_encode(['token' => $jwt]);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erreur serveur : ' . $e->getMessage()]);
}

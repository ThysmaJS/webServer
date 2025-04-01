<?php
require_once 'jwt_utils.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Méthode non autorisée']);
    exit;
}

$secret = 'donsecure123';
$payload = [
    'user' => 'admin',
    'exp' => time() + 1800  // expiration dans 30 minutes
];

$jwt = generate_jwt($payload, $secret);

// Stocke le token dans un cookie
setcookie(
    "jwt_token",
    $jwt,                   
    [
        'expires' => time() + 1800,
        'path' => '/',
        'secure' => true,
        'httponly' => true,     
        'samesite' => 'Lax'
    ]
);

header('Content-Type: application/json');
echo json_encode(['token' => $jwt]);

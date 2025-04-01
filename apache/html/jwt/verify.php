<?php
require_once 'jwt_utils.php';

$secret = 'donsecure123';

$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
if (!preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
    http_response_code(401);
    exit('Missing or malformed token');
}

$jwt = $matches[1];
$payload = verify_jwt($jwt, $secret);
if (!$payload) {
    http_response_code(401);
    exit('Invalid or expired token');
}

// Token validé
http_response_code(200);
exit('Token validé');

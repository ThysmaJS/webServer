<?php

function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64url_decode($data) {
    return base64_decode(strtr($data, '-_', '+/'));
}

function generate_jwt($payload, $secret, $exp = 1800) {
    $header = ['alg' => 'HS256', 'typ' => 'JWT'];
    $payload['exp'] = time() + $exp;

    $base64UrlHeader = base64url_encode(json_encode($header));
    $base64UrlPayload = base64url_encode(json_encode($payload));
    $signature = hash_hmac('sha256', "$base64UrlHeader.$base64UrlPayload", $secret, true);
    $base64UrlSignature = base64url_encode($signature);

    return "$base64UrlHeader.$base64UrlPayload.$base64UrlSignature";
}

function verify_jwt($jwt, $secret) {
    $parts = explode('.', $jwt);
    if (count($parts) !== 3) return false;

    list($header64, $payload64, $signature64) = $parts;

    $expected_signature = base64url_encode(
        hash_hmac('sha256', "$header64.$payload64", $secret, true)
    );

    if (!hash_equals($expected_signature, $signature64)) return false;

    $payload = json_decode(base64url_decode($payload64), true);

    if ($payload['exp'] < time()) return false;

    return $payload;
}

<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function makeJWT($data) {

    $key = getenv('JWT_KEY');
    $time = time();

    $payload = [
        'aud' => base_url(),
        'iat' => $time,
        'exp' => $time + (60 * 5),
        'data' => $data,
    ];

    $jwt = JWT::encode($payload, $key, 'HS256');

    return $jwt;
}

function getJWT($authHeader) {

    if (!isset($authHeader))
        return '';

    $jwt = explode(' ', $authHeader)[1];

    return $jwt;
}

function getJWTdecoded($jwt) {

    $key = getenv('JWT_KEY');
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    return $decoded;
}

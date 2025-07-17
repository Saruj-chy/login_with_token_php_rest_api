<?php
include 'token_key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $accessToken = getAuthorizationHeader();

    if (preg_match('/Bearer\s(\S+)/', $accessToken, $matches)) {
        $jwt = $matches[1];
        try {
            $decoded = JWT::decode($jwt, new Key($secretKey, 'HS256'));
            $userId  = $decoded->sub;

            $r = getUserData($conn, $userId);

            $userData;
            while ($row = $r->fetch_array(MYSQLI_ASSOC)) {
                $userData = $row;
            }
            $access = generateToken($userData['id'], $secretKey, 1);
            echo json_encode(['message' => 'Access granted',
                'user_id'                   => $userId,
                'data'                      => $userData,
                'access_token'              => $access]);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['success' => 401,
                'error'                     => 'Invalid access token', 'msg' => 'Please again login to generate new access token']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Authorization header missing or malformed']);
    }

}

function getUserData($conn, $userId)
{
    $sql = "SELECT * FROM users where `id` = '$userId'";
    $r   = mysqli_query($conn, $sql);
    return $r;
}
function generateToken($userId, $key, $expireMinutes)
{
    $payload = [
        'iss' => "localhost",
        'aud' => "localhost",
        'iat' => time(),
        'exp' => time() + (60 * $expireMinutes),
        'sub' => $userId,
    ];
    return JWT::encode($payload, $key, 'HS256');
}

function getAuthorizationHeader()
{
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } else if (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}

mysqli_close($conn);

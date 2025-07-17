<?php
include 'token_key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$response = [];
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $ch = curl_init('http://localhost/login_with_token/rate_limit_api/limit_api.php'); // Replace with actual
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $limitRes       = curl_exec($ch);
    $limitResDecode = json_decode($limitRes, true);
    if ($limitResDecode['success'] == 200) {
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
                $access                   = generateToken($userData['id'], $secretKey, 5);
                $response['success']      = 200;
                $response['message']      = 'Access granted';
                $response['user_id']      = $userId;
                $response['access_token'] = $access;
                $response['data']         = $userData;
            } catch (Exception $e) {
                http_response_code(401);
                $response['success'] = 401;
                $response['message'] = 'Please again login to generate new access token';
                $response['error']   = 'Invalid access token';
            }
        } else {
            http_response_code(400);
            $response['success'] = 400;
            $response['error']   = 'Authorization header missing or malformed';
        }
    } else {
        $response = $limitResDecode;
    }

} else {
    $response['success'] = 400;
    $response['message'] = 'Please provide data in get method.';
}

echo json_encode($response);

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

<?php
include 'token_key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) || isset($_POST['password'])) {
        isset($_POST['email']) ? $email       = $_POST['email'] : $email       = '';
        isset($_POST['password']) ? $password = md5($_POST['password']) : $password = '';
    } else {
        echo 'missing parameter';
        exit();
    }

    $r = getUser($conn, $email, $password);

    $userData;
    while ($row = $r->fetch_array(MYSQLI_ASSOC)) {
        $userData = $row;
    }
    $access  = generateToken($userData['id'], $secretKey, 5);        // 5 minute
    $refresh = generateToken($userData['id'], $refreshKey, 60 * 24); // 1 day

    $response = [];
    if ($userData) {
        $response['state']  = "Success";
        $response['id']     = $userData['id'];
        $response['access'] = $access;
        $response['data']   = $userData;
    } else {
        http_response_code(401);
        $response['state'] = "Failed";
        $response['msg']   = "Login Failed";
    }
    echo json_encode($response);
}

function getUser($conn, $email, $password)
{
    $sql = "SELECT * FROM users where `email` = '$email' and `password`= '$password' ";
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

mysqli_close($conn);

<?php
include 'token_key.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['name']) || isset($_POST['email']) || isset($_POST['password']) || isset($_POST['created_by'])) {
        isset($_POST['name']) ? $name             = $_POST['name'] : $name             = '';
        isset($_POST['email']) ? $email           = $_POST['email'] : $email           = '';
        isset($_POST['password']) ? $password     = md5($_POST['password']) : $password     = '';
        isset($_POST['created_by']) ? $created_by = $_POST['created_by'] : $created_by = '';

    } else {
        echo 'missing parameter';
        exit();
    }

    $created_date = date('Y-m-d H:i:s');
    $r            = insertUser($conn, $name, $email, $password, $created_by, $created_date);

    $insertId = $conn->insert_id;

    $access  = generateToken($insertId, $secretKey, 5);        // 5 minute
    $refresh = generateToken($insertId, $refreshKey, 60 * 24); // 1 day

    $expires_at = date("Y-m-d H:i:s", time() + 86400);
    $r          = InsertToken($conn, $insertId, $refresh, $expires_at);

    $response = [];
    if ($insertId != 0) {
        $response['state']  = "Success";
        $response['access'] = $access;
    } else {
        http_response_code(401);
        $response['state'] = "Failed";
    }
    echo json_encode($response);
}

function insertUser($conn, $name, $email, $password, $created_by, $created_date)
{
    $sql  = "INSERT INTO `users`(`name`,`email`,`password`,`created_by`, `created_date` ) VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sssss', $name, $email, $password, $created_by, $created_date);
    $stmt->execute();
    $stmt->close();
    return $stmt;
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

function InsertToken($conn, $user_id, $refresh, $expires_at)
{
    $sql  = "INSERT INTO `tokens`(`user_id`,`token`,`expires_at`) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $user_id, $refresh, $expires_at);
    $stmt->execute();
    $stmt->close();
    return $stmt;
}

mysqli_close($conn);

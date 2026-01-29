<?php
session_start();
header("Content-Type: application/json");
require_once __DIR__ . '/../../database/db.php';
require_once __DIR__ . 'check_login.php';

if (is_login()) {
    header("Location: ../../frontend/pages/home.html");
    exit;
}

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $user = mysqli_real_escape_string($connection, $username);

    $result = get_or_none_user($user);
    if ($result) {
        if (password_verify($password, $result["password"])) {
            $_SESSION["username"] = $user;
            $response["status"] = "success";
            $response["message"] = "$user logined";
        } else {
            $response["status"] = "error";
            $response["error"] = "INVALID_PASSWORD";
            $response["message"] = "Not correct password for $user user";
        }
    } else {
        $response["status"] = "error";
        $response["error"] = "INVALID_USERNAME";
        $response["message"] = "User $user not exists";
    }

    echo json_encode($response);
    exit;
}
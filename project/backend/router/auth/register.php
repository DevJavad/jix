<?php
session_start();
header("Content-Type: application/json");
require_once __DIR__ . '/../../database/db.php';
require_once __DIR__ . '/check_login.php';

if (is_login()) {
    header("Location: ../../../frontend/pages/home.html");
    exit;
}

$response = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    $user = mysqli_real_escape_string($connection, $username);

    $result = get_or_none_user($user);
    if ($result) {
        $response["status"] = "error";
        $response["error"] = "DUPLICATE_USERNAME";
        $response["message"] = "$user is exists";
    } else {
        $created = create_user($user, $password);
        if ($created) {
            $_SESSION["username"] = $user;
            $response["status"] = "success";
            $response["message"] = "$user created";
        } else {
            $response["status"] = "error";
            $response["error"] = "SERVER_ERROR";
            $response["message"] = "Error to create $user user";
        }
    }

    echo json_encode($response);
    exit;
}
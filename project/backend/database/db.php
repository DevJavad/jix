<?php
require_once __DIR__ . '/../config.php';

$connection = mysqli_connect(
    $host,
    $username,
    $password,
    $database,
    $port
);


function create_table(
    string $table,
    array $data
) {
    global $connection;

    $columns = [];
    foreach ($data as $name => $type) {
        $columns[] = "$name $type";
    }

    $query = "CREATE TABLE IF NOT EXISTS `$table` (" . implode(", ", $columns) . ")";
    if (mysqli_query($connection, $query)) {
        return true;
    } else return false;
}

function get_or_none_user(string $username)
{
    global $connection;

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($connection, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else return null;
}


function create_user(
    string $username,
    string $password
) {
    global $connection;

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, password) VALUES ('$username', '$hash')";
    if (mysqli_query($connection, $query)) {
        return true;
    } else return false;
}
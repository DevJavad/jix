<?php
require_once __DIR__ . '/../config.php';

function create_database()
{
    global $host, $username, $password, $database, $port;

    $connection = mysqli_connect(
        $host,
        $username,
        $password,
        "",
        $port
    );

    $query = "CREATE DATABASE IF NOT EXISTS `$database`";
    mysqli_query($connection, $query);
    mysqli_close($connection);
}
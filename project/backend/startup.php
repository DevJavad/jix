<?php
require_once __DIR__ . '/database/init.php';
require_once __DIR__ . '/database/db.php';

if (file_exists(".started")) {
    exit;
}

create_database();
create_table(
    "users",
    [
        "id" => "INT AUTO_INCREMENT PRIMARY KEY",
        "username" => "VARCHAR(255) NOT NULL UNIQUE",
        "password" => "VARCHAR(255) NOT NULL"
    ]
);

file_put_contents(".started", "started: true");
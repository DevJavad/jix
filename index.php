<?php
require_once __DIR__ . '/project/backend/startup.php';

$page = $_GET["page"] ?? "home";
$file = __DIR__ . "/project/frontend/pages/$page.html";

if (file_exists($file)) {
    require $file;
} else {
    echo "404\nPage not found";
}
<?php

$request = $_GET['url'] ?? '';

switch ($request) {
    case 'login':
        require 'api/login.php';
        break;
    case 'search':
        require 'api/search.php';
        break;
    case 'update':
        require 'api/update.php';
        break;
    case 'delete':
        require 'api/delete.php';
        break;
    case 'grade':
        require 'api/grade.php';
        break;
    default:
        http_response_code(404);
        echo 'API endpoint not found';
        break;
}

echo '<pre>' . print_r($_GET, true) . '</pre>';
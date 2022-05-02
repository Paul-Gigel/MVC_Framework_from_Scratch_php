<?php

use app\controllers\SiteController;
use app\core\Application;
use \app\controllers\AuthController;

//phpinfo();
require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];
$dsn = $config['dsn' ] ?? '';
$user = $config['user'] ?? '';
$password = $config['password'] ?? '';

$app = new Application(__DIR__, $config);

$app->db->applyMigrations();

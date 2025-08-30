
<?php
require_once __DIR__ . '/../../inc/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

json_response([
    'site_name' => 'PC Clone',
    'logo' => '/assets/category-CMHPLGhY.png',
    'banner' => '/assets/notice-BFxQjxhm.png',
    'currencies' => ['USD', 'CNY'],
    'languages' => ['zh-CN', 'en-US'],
    'maintenance' => false,
    'registration_enabled' => true
]);

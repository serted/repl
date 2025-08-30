<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
try {
  $pdo->query('SELECT 1');
  $db = true;
} catch (Throwable $e) {
  $db = false;
}
json_response(['ok'=>true, 'php'=>PHP_VERSION, 'db'=>$db]);

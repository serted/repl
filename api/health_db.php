<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
try {
  $st=$pdo->query('SELECT NOW() as now');
  $row=$st->fetch();
  json_response(['ok'=>1, 'db'=>1, 'now'=>$row['now'] ?? null]);
} catch (Throwable $e) {
  fail('db_error', 500);
}

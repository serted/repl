<?php
require_once __DIR__ . '/../../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
require_admin();

$page = max(1, (int)($_GET['page'] ?? 1));
$per  = min(100, max(1, (int)($_GET['per'] ?? 20)));
$q    = trim((string)($_GET['q'] ?? ''));
$off  = ($page-1)*$per;

$where = '1';
$args = [];
if ($q !== '') {
  $where = '(username LIKE ? OR nickname LIKE ?)';
  $args = ["%$q%","%$q%"];
}

$st = $pdo->prepare("SELECT SQL_CALC_FOUND_ROWS id, username, nickname, balance, is_admin FROM users WHERE $where ORDER BY id DESC LIMIT $per OFFSET $off");
$st->execute($args);
$list = $st->fetchAll();

$total = (int)$pdo->query("SELECT FOUND_ROWS()")->fetchColumn();
json_response(['items'=>$list, 'page'=>$page, 'per'=>$per, 'total'=>$total]);

<?php
require_once __DIR__ . '/../../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
require_admin();
assert_csrf();

$uid   = (int)($_POST['id'] ?? 0);
$nickname = trim((string)($_POST['nickname'] ?? ''));
$newpass  = (string)($_POST['new_password'] ?? '');
$delta = (float)($_POST['delta'] ?? 0);
$reason = trim((string)($_POST['reason'] ?? 'manual'));

try {
  $pdo->beginTransaction();

  if ($nickname !== '') {
    $st=$pdo->prepare('UPDATE users SET nickname=? WHERE id=?');
    $st->execute([$nickname, $uid]);
  }
  if ($newpass !== '') {
    $st=$pdo->prepare('UPDATE users SET password_hash=? WHERE id=?');
    $st->execute([password_hash($newpass, PASSWORD_DEFAULT), $uid]);
  }
  if ($delta != 0.0) {
    $st=$pdo->prepare('UPDATE users SET balance = balance + :d WHERE id=:id');
    $st->execute([':d'=>$delta, ':id'=>$uid]);

    $st=$pdo->prepare('INSERT INTO balance_audit (user_id, delta, reason) VALUES (:id,:d,:r)');
    $st->execute([':id'=>$uid, ':d'=>$delta, ':r'=>$reason]);
  }

  $pdo->commit();
  json_response(['ok'=>1]);
} catch (Throwable $e) {
  $pdo->rollBack();
  app_log('admin_update_failed: '.$e->getMessage());
  fail('update_failed', 500);
}

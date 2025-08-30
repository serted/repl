<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
assert_csrf();

$in = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$username = trim((string)($in['username'] ?? ''));
$password = (string)($in['password'] ?? '');
$nickname = trim((string)($in['nickname'] ?? ''));

if ($username === '' || $password === '') fail('missing', 400);

if (strlen($username) < 3 || strlen($username) > 64) fail('bad_username', 422);
if (strlen($password) < 6) fail('weak_password', 422);

$st = $pdo->prepare('SELECT id FROM users WHERE username=?');
$st->execute([$username]);
if ($st->fetch()) fail('exists', 409);

$hash = password_hash($password, PASSWORD_DEFAULT);
$st = $pdo->prepare('INSERT INTO users (username, password_hash, nickname, balance, is_admin) VALUES (?,?,?,?,0)');
$st->execute([$username, $hash, $nickname, 0]);

json_response(['ok'=>1]);

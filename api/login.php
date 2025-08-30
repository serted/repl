<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
assert_csrf();

$in = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$username = trim((string)($in['username'] ?? ''));
$password = (string)($in['password'] ?? '');

if ($username === '' || $password === '') fail('missing', 400);

$st = $pdo->prepare('SELECT id, password_hash FROM users WHERE username=?');
$st->execute([$username]);
$row = $st->fetch();

if (!$row || !password_verify($password, $row['password_hash'])) fail('invalid', 401);

regenerate_session();
$_SESSION['uid'] = (int)$row['id'];
json_response(['ok'=>1, 'user'=>current_user(), 'csrf'=>csrf_token()]);

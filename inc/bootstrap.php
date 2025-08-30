<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);

// inc/bootstrap.php — single entry point
if (session_status() === PHP_SESSION_NONE) {
  session_set_cookie_params([
    'lifetime' => 0, 'path' => '/', 'secure' => !empty($_SERVER['HTTPS']),
    'httponly' => true, 'samesite' => 'Lax'
  ]);
  session_start();
}

if (!defined('BASE_PREFIX')) {
  define('BASE_PREFIX', getenv('BASE_PREFIX') ?: '/dev/');
}

function env_or(string $k, $d=null) { $v=getenv($k); return $v!==false ? $v : $d; }

$appEnv = env_or('APP_ENV','prod');
error_reporting($appEnv==='dev' ? E_ALL : E_ALL & ~E_NOTICE);
ini_set('display_errors', $appEnv==='dev' ? '1' : '0');
header_remove('X-Powered-By');

require_once __DIR__ . '/../api/config.php'; // must define DB_* constants

$dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', DB_HOST, DB_PORT, DB_NAME);
$pdo = new PDO($dsn, DB_USER, DB_PASS, [
  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC,
  PDO::MYSQL_ATTR_INIT_COMMAND=>'SET sql_mode=STRICT_ALL_TABLES'
]);

function json_response($data, int $code=200): void {
  http_response_code($code);
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
  exit;
}
function fail(string $msg, int $code=400){
    if (strpos($_SERVER['SCRIPT_NAME'], '/api/') === 0) {
        json_response(['error'=>$msg], $code);
    } else {
        http_response_code($code);
        echo "<h1>Error {$code}</h1><p>{$msg}</p>";
        exit;
    }
}

function regenerate_session(): void { if (session_status()===PHP_SESSION_ACTIVE) session_regenerate_id(true); }

function current_user(): ?array {
  global $pdo;
  $uid = $_SESSION['uid'] ?? null;
  if (!$uid) return null;
  $st=$pdo->prepare('SELECT id,username,nickname,balance,is_admin FROM users WHERE id=?');
  $st->execute([$uid]);
  $u = $st->fetch();
  return $u ?: null;
}
function require_user(): void { if (!current_user()) fail('unauthorized',401); }
function require_admin(): void {
  $u=current_user(); if (!$u || !intval($u['is_admin'])) fail('forbidden',403);
}

// CSRF helpers
function csrf_token(): string { return $_SESSION['_csrf'] ??= bin2hex(random_bytes(16)); }
function assert_csrf(): void {
  if ($_SERVER['REQUEST_METHOD']==='GET' || $_SERVER['REQUEST_METHOD']==='OPTIONS') return;
  $token = $_SERVER['HTTP_X_CSRF'] ?? ($_POST['_csrf'] ?? '');
  if (!$token || !hash_equals($_SESSION['_csrf'] ?? '', $token)) fail('csrf', 419);
}

// Simple logger (file path via APP_LOG or logs/app.log)
function app_log(string $msg): void {
  $path = env_or('APP_LOG', __DIR__ . '/../logs/app.log');
  $line = sprintf("[%s] %s %s\n", date('c'), $_SERVER['REQUEST_URI'] ?? '-', $msg);
  @file_put_contents($path, $line, FILE_APPEND);
}

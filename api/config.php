<?php
require_once __DIR__ . '/../inc/bootstrap.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET,POST,OPTIONS');
if ($_SERVER['REQUEST_METHOD']==='OPTIONS'){ http_response_code(200); exit; }

if (strpos($_SERVER['SCRIPT_NAME'], '/api/') === 0) {
    header('Content-Type: application/json; charset=utf-8');
}
/*function fail($m,$c=500,$extra=[]) {
  http_response_code($c);
  echo json_encode(['ok'=>0,'error'=>$m] + $extra, JSON_UNESCAPED_UNICODE);
  exit;
}*/

foreach (['pdo_pgsql'=>'PDO PostgreSQL','curl'=>'cURL'] as $ext=>$name){
  if($ext==='pdo_pgsql' && !extension_loaded('pdo_pgsql')) fail("PHP extension missing: $name", 500);
  if($ext!=='pdo_pgsql' && !extension_loaded($ext)) fail("PHP extension missing: $name", 500);
}

// Use PostgreSQL environment variables from Replit
$databaseUrl = getenv('DATABASE_URL');
if ($databaseUrl) {
  $parsedUrl = parse_url($databaseUrl);
  define('DB_HOST', $parsedUrl['host']);
  define('DB_PORT', $parsedUrl['port'] ?? 5432);
  define('DB_NAME', ltrim($parsedUrl['path'], '/'));
  define('DB_USER', $parsedUrl['user']);
  define('DB_PASS', $parsedUrl['pass']);
} else {
  define('DB_HOST', getenv('PGHOST') ?: '127.0.0.1');
  define('DB_PORT', getenv('PGPORT') ?: '5432');
  define('DB_NAME', getenv('PGDATABASE') ?: 'pc_dfbiu_clone');
  define('DB_USER', getenv('PGUSER') ?: 'postgres');
  define('DB_PASS', getenv('PGPASSWORD') ?: '');
}


// Database connection and initialization is handled in bootstrap.php

/*function current_user(){
  global $pdo;
  if (empty($_SESSION['uid'])) return null;
  $st=$pdo->prepare("SELECT id,username,nickname,balance,is_admin FROM users WHERE id=?");
  $st->execute([$_SESSION['uid']]);
  return $st->fetch() ?: null;
}*/
//function require_admin(){ $u=current_user(); if(!$u || !$u['is_admin']) fail('forbidden',403); }
?>
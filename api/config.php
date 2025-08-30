<?php
//require_once __DIR__ . '/inc/bootstrap.php';\n
//header('Content-Type: application/json; charset=utf-8');
//require_once __DIR__.'/../include/functions.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Content-Type');
header('Access-Control-Allow-Methods: GET,POST,OPTIONS');
if ($_SERVER['REQUEST_METHOD']==='OPTIONS'){ http_response_code(200); exit; }
//header('Content-Type: application/json; charset=utf-8');
if (strpos($_SERVER['SCRIPT_NAME'], '/api/') === 0) {
    header('Content-Type: application/json; charset=utf-8');
}
/*function fail($m,$c=500,$extra=[]) {
  http_response_code($c);
  echo json_encode(['ok'=>0,'error'=>$m] + $extra, JSON_UNESCAPED_UNICODE);
  exit;
}*/

foreach (['pdo_mysql'=>'PDO MySQL','curl'=>'cURL'] as $ext=>$name){
  if($ext==='pdo_mysql' && !extension_loaded('pdo_mysql')) fail("PHP extension missing: $name", 500);
  if($ext!=='pdo_mysql' && !extension_loaded($ext)) fail("PHP extension missing: $name", 500);
}

define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_NAME', getenv('DB_NAME') ?: 'pc_dfbiu_clone');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: 'НовыйПароль');


$host = getenv('DB_HOST') ?: '127.0.0.1';
$db   = getenv('DB_NAME') ?: 'pc_dfbiu_clone';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: 'НовыйПароль';

try {
  $pdo = new PDO("mysql:host={$host};dbname={$db};charset=utf8mb4", $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  ]);
} catch (Throwable $e){
  fail('DB connection failed', 500, ['details'=>$e->getMessage()]);
}

try {
  // Try to use DB; if missing – try to create, then use
  try { $pdo->exec("USE `{$db}`"); }
  catch(Throwable $e_use){
    try { $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$db}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"); $pdo->exec("USE `{$db}`"); }
    catch(Throwable $e_create){ fail('DB select/create failed', 500, ['details'=>$e_create->getMessage()]); }
  }

  // Ensure schema
  $schemaFile = __DIR__.'/../schema.sql';
  if (is_file($schemaFile)) {
    // create tables if not exist
    $pdo->exec(file_get_contents($schemaFile));
  }

  // Seed admin if users empty
  try { $c = (int)$pdo->query("SELECT COUNT(*) AS c FROM users")->fetch()['c']; } catch(Throwable $e){ $c = 0; }
  if ($c===0){
    $st=$pdo->prepare("INSERT INTO users(username,password_hash,nickname,balance,is_admin) VALUES(?,?,?,?,?)");
    $st->execute(['admin', password_hash('Admin123!', PASSWORD_BCRYPT), 'Admin', 0, 1]);
    $st->execute(['test228', password_hash('test228', PASSWORD_BCRYPT), 'Tester', 100, 0]);
  }

} catch (Throwable $e){
  fail('DB init failed', 500, ['details'=>$e->getMessage()]);
}

/*function current_user(){
  global $pdo;
  if (empty($_SESSION['uid'])) return null;
  $st=$pdo->prepare("SELECT id,username,nickname,balance,is_admin FROM users WHERE id=?");
  $st->execute([$_SESSION['uid']]);
  return $st->fetch() ?: null;
}*/
//function require_admin(){ $u=current_user(); if(!$u || !$u['is_admin']) fail('forbidden',403); }
?>
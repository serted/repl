<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');
if (session_status()===PHP_SESSION_ACTIVE) {
  $_SESSION = [];
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"] ?? '', $params["secure"], $params["httponly"]);
  }
  session_destroy();
}
json_response(['ok'=>1]);

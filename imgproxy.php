<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__.'/include/functions.php';
$u = $_GET['u'] ?? '';
if (!$u || !preg_match('~^https?://~',$u)) { http_response_code(400); exit; }
$hash = sha1($u);
$dir = __DIR__.'/img/cache/'.substr($hash,0,2);
@mkdir($dir,0775,true);
$dest = $dir.'/'.$hash.'.bin';
if (!is_file($dest)) {
  if (function_exists('curl_init')) {
    $ch = curl_init($u); curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>1,CURLOPT_FOLLOWLOCATION=>1,CURLOPT_TIMEOUT=>20,CURLOPT_SSL_VERIFYPEER=>false]); $data = curl_exec($ch); curl_close($ch);
  } else {
    $ctx = stream_context_create(['http'=>['timeout'=>20,'follow_location'=>1],'ssl'=>['verify_peer'=>false,'verify_peer_name'=>false]]); $data = @file_get_contents($u,false,$ctx);
  }
  if ($data===false || !strlen($data)) { http_response_code(502); exit; }
  file_put_contents($dest,$data);
}
$finfo = function_exists('finfo_open') ? finfo_open(FILEINFO_MIME_TYPE) : false;
$mime = $finfo ? finfo_file($finfo,$dest) : 'image/*'; if($finfo) finfo_close($finfo);
header('Content-Type: '.$mime); readfile($dest);

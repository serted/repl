<?php
require_once __DIR__ . '/inc/bootstrap.php'; require __DIR__.'/../config.php'; require_admin(); header('Content-Type: application/json');
$in=json_decode(file_get_contents('php://input'),true) ?: $_POST;
$lang=$in['lang']??''; $key=$in['key']??''; $val=$in['value']??'';
if(!$lang||!$key) fail('bad',400);
$st=$pdo->prepare("INSERT INTO translations(lang,`key`,`value`) VALUES(?,?,?) ON DUPLICATE KEY UPDATE `value`=VALUES(`value`)");
$st->execute([$lang,$key,$val]); echo json_encode(['ok'=>1]);
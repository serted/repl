<?php
require_once __DIR__ . '/../inc/bootstrap.php';
header('Content-Type: application/json; charset=utf-8');

$lang = trim((string)($_GET['lang'] ?? 'en'));
$map = [
  'zh-CN'=>'zh-CN','简体中文'=>'zh-CN','中文简体'=>'zh-CN',
  '中文繁体'=>'zh-TW','zh-TW'=>'zh-TW',
  'English'=>'en','en'=>'en',
  '日本語'=>'ja','ja'=>'ja',
  '한국인'=>'ko','ko'=>'ko',
  'Tiếng Việt'=>'vi','vi'=>'vi',
  'แบบไทย'=>'th','th'=>'th',
  'Português'=>'pt','pt'=>'pt',
  'កម្ពុជា។'=>'km','km'=>'km',
  'Indonesia'=>'id','id'=>'id'
];
$code = $map[$lang] ?? $lang;

$paths = [
  __DIR__ . '/../i18n/' . $code . '.json',
  __DIR__ . '/../assets/i18n/' . $code . '.json',
];

foreach ($paths as $p) {
  if (is_file($p)) {
    $json = file_get_contents($p);
    echo $json;
    exit;
  }
}
json_response(['error'=>'missing_locale','lang'=>$code], 200);

<?php
require_once __DIR__ . '/inc/bootstrap.php';
header('Content-Type: text/plain; charset=utf-8');
echo "Diag for /dev\n\n";
echo "PHP: ".PHP_VERSION."\n";
foreach (['pdo_mysql','curl','mbstring','fileinfo'] as $ext){
  echo sprintf("ext %-10s : %s\n",$ext, extension_loaded($ext)?'OK':'MISSING');
}
echo "\nENV:\n";
foreach (['DB_HOST','DB_NAME','DB_USER','DB_PASS'] as $k){
  echo $k.'='.(getenv($k)?:'(not set)')."\n";
}
?>
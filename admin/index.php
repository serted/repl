<?php
require_once __DIR__ . '/inc/bootstrap.php'; require_once __DIR__.'/../include/functions.php'; ?>
<!doctype html><html>
  <base href=\"<?= BASE_PREFIX ?>\"><meta charset="utf-8"><title>Admin</title><link rel="stylesheet" href="<?= asset('css/admin.css') ?>"></head>
<body><h1>Admin</h1>
<nav><a href="<?= urlp('admin/users.php') ?>">Users</a> | <a href="<?= urlp('admin/translations.php') ?>">Translations</a> | <a href="<?= urlp('admin/login.php') ?>">Login</a></nav>
</body></html>
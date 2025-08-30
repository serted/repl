<?php
require_once __DIR__ . '/inc/bootstrap.php'; require_once __DIR__.'/../include/functions.php'; ?>
<!doctype html><html>
  <base href=\"<?= BASE_PREFIX ?>\"><meta charset="utf-8"><title>Admin Login</title></head>
<body><h1>Login</h1>
<form id="f"><input name="username" placeholder="username" required>
<input name="password" type="password" placeholder="password" required><button>Login</button></form>
<script>
document.getElementById('f').onsubmit = async (e)=>{
 e.preventDefault();
 const body = Object.fromEntries(new FormData(e.target).entries());
 const r = await fetch('<?= asset('api/login.php') ?>',{method:'POST',headers:{'Content-Type':'application/json'},credentials:'include',body:JSON.stringify(body)});
 const j = await r.json(); if(j.user && j.user.is_admin){ location.href='<?= urlp('admin/') ?>'; } else alert('Not admin');
};
</script>
</body></html>
<?php
require_once __DIR__ . '/inc/bootstrap.php'; require_once __DIR__.'/../include/functions.php'; ?>
<!doctype html><html>
  <base href=\"<?= BASE_PREFIX ?>\"><meta charset="utf-8"><title>Translations</title></head>
<body><h1>Translations</h1>
<form id="add"><input name="lang" placeholder="lang" required><input name="key" placeholder="key" required><input name="value" placeholder="value" required><button>Add</button></form>
<table id="t" border="1" cellpadding="6"></table>
<script>
async function list(){ const lang=(document.querySelector('input[name=lang]').value||'en'); const r=await fetch('<?= asset('api/i18n.php') ?>?lang='+encodeURIComponent(lang),{credentials:'include'}); const dict=await r.json();
 const t=document.getElementById('t'); t.innerHTML='<tr><th>Key</th><th>Value</th></tr>'; Object.entries(dict).forEach(([k,v])=>{ const tr=document.createElement('tr'); tr.innerHTML=`<td>${k}</td><td>${v}</td>`; t.appendChild(tr); });
}
document.getElementById('add').onsubmit = async (e)=>{
 e.preventDefault(); const body=Object.fromEntries(new FormData(e.target).entries());
 await fetch('<?= asset('api/admin/translations_save.php') ?>',{method:'POST',headers:{'Content-Type':'application/json'},credentials:'include',body:JSON.stringify(body)});
 list();
};
list();
</script>
</body></html>
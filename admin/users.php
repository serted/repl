<?php
require_once __DIR__ . '/inc/bootstrap.php'; require_once __DIR__.'/../include/functions.php'; ?>
<!doctype html><html>
  <base href=\"<?= BASE_PREFIX ?>\"><meta charset="utf-8"><title>Users</title></head>
<body><h1>Users</h1><table id="t" border="1" cellpadding="6"></table>
<script>
async function load(){ const r=await fetch('<?= asset('api/admin/users_list.php') ?>',{credentials:'include'}); if(!r.ok){ alert('login as admin'); return; } const rows=await r.json();
 const t=document.getElementById('t'); t.innerHTML='<tr><th>ID</th><th>User</th><th>Nick</th><th>Balance</th><th>Admin</th><th>New pass</th><th>Save</th></tr>';
 rows.forEach(u=>{ const tr=document.createElement('tr'); tr.innerHTML=`
 <td>${u.id}</td><td>${u.username}</td>
 <td><input value="${u.nickname||''}" data-k="nickname"></td>
 <td><input value="${u.balance}" data-k="balance" type="number" step="0.01"></td>
 <td><input type="checkbox" ${u.is_admin?'checked':''} data-k="is_admin"></td>
 <td><input placeholder="(unchanged)" data-k="password" type="password"></td>
 <td><button>Save</button></td>`;
 tr.querySelector('button').onclick = async ()=>{
   const payload={id:u.id};
   tr.querySelectorAll('input').forEach(inp=>{
     let k=inp.dataset.k; let v = (inp.type==='checkbox')? (inp.checked?1:0) : inp.value;
     if(k==='password' && !v) return; payload[k]=v;
   });
   const r=await fetch('<?= asset('api/admin/user_update.php') ?>',{method:'POST',headers:{'Content-Type':'application/json'},credentials:'include',body:JSON.stringify(payload)});
   alert(r.ok?'Saved':'Error');
 };
 t.appendChild(tr); });
}
load();
</script></body></html>
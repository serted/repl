(async function(){
  async function checkAuth(){
    try {
      const r = await fetch('api/me.php', {credentials:'include'});
    } catch(e){ console.warn('auth check failed', e); }
  }
  document.addEventListener('DOMContentLoaded', checkAuth);
})();

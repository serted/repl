(function(){
  function base(){ return "https://pc.dfbiu.com" + (location.pathname.indexOf('/dev/')===0?'/dev/':'/'); }
  function api(p){ return base() + p.replace(/^\//,''); }
  var lang = (localStorage.getItem('lang') || document.documentElement.getAttribute('lang') || 'en').toLowerCase();
  fetch(api('api/i18n.php?lang='+encodeURIComponent(lang)), {credentials:'include'})
    .then(function(r){ return r.json(); })
    .then(function(dict){
      Array.prototype.forEach.call(document.querySelectorAll('[data-i18n]'), function(node){
        var k = node.getAttribute('data-i18n'); if (dict[k]) node.textContent = dict[k];
      });
    }).catch(function(e){ console.warn('i18n load failed', e); });
})();
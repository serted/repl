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
/**
 * Internationalization support
 */
(function() {
    'use strict';
    
    const translations = {
        'zh-CN': {
            'login': '登录',
            'register': '注册',
            'logout': '退出',
            'username': '用户名',
            'password': '密码',
            'balance': '余额',
            'deposit': '充值',
            'withdraw': '提现',
            'transfer': '转账',
            'games': '游戏',
            'live': '真人',
            'slot': '老虎机',
            'lottery': '彩票',
            'sport': '体育',
            'profile': '个人中心',
            'vip': 'VIP',
            'promotion': '优惠',
            'download': '下载',
            'contact': '联系我们'
        },
        'en-US': {
            'login': 'Login',
            'register': 'Register',
            'logout': 'Logout',
            'username': 'Username',
            'password': 'Password',
            'balance': 'Balance',
            'deposit': 'Deposit',
            'withdraw': 'Withdraw',
            'transfer': 'Transfer',
            'games': 'Games',
            'live': 'Live',
            'slot': 'Slot',
            'lottery': 'Lottery',
            'sport': 'Sports',
            'profile': 'Profile',
            'vip': 'VIP',
            'promotion': 'Promotion',
            'download': 'Download',
            'contact': 'Contact Us'
        }
    };
    
    let currentLanguage = 'zh-CN';
    
    window.i18n = {
        t: function(key) {
            return translations[currentLanguage][key] || key;
        },
        
        setLanguage: function(lang) {
            if (translations[lang]) {
                currentLanguage = lang;
                localStorage.setItem('language', lang);
            }
        },
        
        getCurrentLanguage: function() {
            return currentLanguage;
        }
    };
    
    // Initialize language from localStorage
    const savedLanguage = localStorage.getItem('language');
    if (savedLanguage && translations[savedLanguage]) {
        currentLanguage = savedLanguage;
    }
    
})();

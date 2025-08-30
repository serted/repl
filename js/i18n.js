
/**
 * Internationalization support
 */
(function() {
    'use strict';
    
    var translations = {
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
            'slot': 'Slots',
            'lottery': 'Lottery',
            'sport': 'Sports',
            'profile': 'Profile',
            'vip': 'VIP',
            'promotion': 'Promotions',
            'download': 'Download',
            'contact': 'Contact Us'
        }
    };
    
    var currentLang = (localStorage.getItem('lang') || document.documentElement.getAttribute('lang') || 'zh-CN').toLowerCase();
    
    function translate(key) {
        return translations[currentLang] && translations[currentLang][key] || key;
    }
    
    function applyTranslations() {
        var elements = document.querySelectorAll('[data-i18n]');
        Array.prototype.forEach.call(elements, function(element) {
            var key = element.getAttribute('data-i18n');
            if (key && translations[currentLang] && translations[currentLang][key]) {
                element.textContent = translations[currentLang][key];
            }
        });
    }
    
    // Apply translations when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applyTranslations);
    } else {
        applyTranslations();
    }
    
    // Export functions
    window.i18n = {
        translate: translate,
        applyTranslations: applyTranslations,
        setLanguage: function(lang) {
            currentLang = lang;
            localStorage.setItem('lang', lang);
            applyTranslations();
        }
    };
    
})();

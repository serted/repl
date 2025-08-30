
// App initialization without domain restrictions
(function() {
    'use strict';
    
    // Ensure jQuery is available
    function waitForJQuery(callback) {
        if (typeof $ !== 'undefined') {
            callback();
        } else {
            setTimeout(function() { waitForJQuery(callback); }, 100);
        }
    }
    
    // Initialize when ready
    function initializeApp() {
        console.log('App initializing...');
        initializeModals();
        initializeAuth();
        initializeUI();
    }
    
    function initializeModals() {
        // Modal functionality
        $(document).on('click', '.modal-trigger', function(e) {
            e.preventDefault();
            var target = $(this).data('target');
            if (target) {
                $(target).show();
            }
        });
        
        $(document).on('click', '.modal-close, .modal-backdrop', function() {
            $('.modal').hide();
        });
    }
    
    function initializeAuth() {
        // Auth form handlers
        $(document).on('submit', '#loginForm', handleLogin);
        $(document).on('submit', '#registerForm', handleRegister);
        $(document).on('click', '.logout-btn', handleLogout);
    }
    
    function initializeUI() {
        // UI enhancements
        $(document).on('click', '.dropdown-toggle', function(e) {
            e.preventDefault();
            $(this).next('.dropdown-menu').toggle();
        });
        
        // Close dropdowns when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').hide();
            }
        });
        
        // Download section tabs
        $(document).on('click', '.tutorial .btn', function() {
            $('.tutorial .btn').removeClass('actived');
            $(this).addClass('actived');
            
            var isIOS = $(this).hasClass('btn_ios');
            $('.textTitle').text(isIOS ? 'iOS APP' : 'Android APP');
            $('.textContent').text(isIOS ? 
                '作为基于云平台的服务，我们更加重视产品的安全性能。每一份数据都经过严格加密并多场景备份，防止危机发生。如果出现数据问题，可以及时恢复，让数据在云端更安全。' :
                'Android版本提供更好的兼容性和性能优化，支持多种安卓设备，让您随时随地享受游戏乐趣。'
            );
        });
    }
    
    function handleLogin(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        fetch('/api/auth/login.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Login failed');
            }
        })
        .catch(function(error) {
            console.error('Login error:', error);
            alert('Login failed');
        });
    }
    
    function handleRegister(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        // Check password confirmation
        var password = formData.get('password');
        var passwordConfirm = formData.get('password_confirm');
        
        if (password !== passwordConfirm) {
            alert('密码确认不匹配');
            return;
        }
        
        fetch('/api/auth/register.php', {
            method: 'POST',
            body: formData
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                alert('注册成功');
                $('#registerModal').hide();
                location.reload();
            } else {
                alert(data.message || 'Registration failed');
            }
        })
        .catch(function(error) {
            console.error('Register error:', error);
            alert('Registration failed');
        });
    }
    
    function handleLogout() {
        fetch('/api/auth/logout.php', {
            method: 'POST'
        })
        .then(function() {
            location.reload();
        });
    }
    
    // Initialize when jQuery and DOM are ready
    waitForJQuery(function() {
        $(document).ready(initializeApp);
    });
    
})();

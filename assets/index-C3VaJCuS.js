
/**
 * Main application script - fixed version without ESM artifacts
 */
(function() {
    'use strict';
    
    // Safe Vite helpers replacement
    window.__vite__mapDeps = window.__vite__mapDeps || function(deps) { return deps || []; };
    window.__vite__preload = window.__vite__preload || function(url) { return Promise.resolve(); };
    
    // App configuration
    var AppConfig = {
        baseUrl: window.location.origin,
        apiUrl: window.location.origin + '/api/',
        assetsUrl: window.location.origin + '/assets/'
    };
    
    // Global state management
    window.GlobalState = {
        user: null,
        token: null,
        isLoggedIn: false,
        balance: 0,
        config: {}
    };
    
    // Vue-like reactive functionality
    function createApp() {
        return {
            mount: function(selector) {
                console.log('App mounted to:', selector);
                initializeComponents();
                return this;
            }
        };
    }
    
    function initializeComponents() {
        initBanner();
        initDownloadSection();
        initGameCategories();
        initModals();
        initForms();
        initCarousel();
        initTooltips();
    }
    
    function initBanner() {
        var banner = document.querySelector('.banner');
        if (banner) {
            // Banner carousel logic
            var bannerCounter = document.querySelector('.banner_counter');
            if (bannerCounter) {
                // Initialize banner
            }
        }
    }
    
    function initDownloadSection() {
        var btns = document.querySelectorAll('.tutorial .btn');
        if (btns.length > 0) {
            btns.forEach(function(btn, index) {
                btn.addEventListener('click', function() {
                    btns.forEach(function(b) { b.classList.remove('actived'); });
                    this.classList.add('actived');
                    
                    var textTitle = document.querySelector('.textTitle');
                    var textContent = document.querySelector('.textContent');
                    
                    if (textTitle && textContent) {
                        if (index === 0) {
                            textTitle.textContent = 'iOS APP';
                            textContent.textContent = '作为基于云平台的服务，我们更加重视产品的安全性能。每一份数据都经过严格加密并多场景备份，防止危机发生。如果出现数据问题，可以及时恢复，让数据在云端更安全。';
                        } else {
                            textTitle.textContent = 'Android APP';
                            textContent.textContent = 'Android版本提供更好的兼容性和性能优化，支持多种安卓设备，让您随时随地享受游戏乐趣。';
                        }
                    }
                });
            });
        }
    }
    
    function initGameCategories() {
        var gameLinks = document.querySelectorAll('.el-sub-menu a');
        gameLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                gameLinks.forEach(function(l) { 
                    l.classList.remove('router-link-active', 'router-link-exact-active'); 
                });
                this.classList.add('router-link-active');
            });
        });
    }
    
    function initModals() {
        var modalTriggers = document.querySelectorAll('.modal-trigger');
        var modals = document.querySelectorAll('.modal');
        var modalCloses = document.querySelectorAll('.modal-close, .modal-backdrop');
        
        modalTriggers.forEach(function(trigger) {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                var target = this.getAttribute('data-target');
                if (target) {
                    var modal = document.querySelector(target);
                    if (modal) {
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden';
                    }
                }
            });
        });
        
        modalCloses.forEach(function(close) {
            close.addEventListener('click', function() {
                modals.forEach(function(modal) {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = '';
            });
        });
        
        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                modals.forEach(function(modal) {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = '';
            }
        });
    }
    
    function initForms() {
        var loginForm = document.getElementById('loginForm');
        if (loginForm) {
            loginForm.addEventListener('submit', handleLogin);
        }
        
        var registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', handleRegister);
        }
        
        var logoutBtn = document.querySelector('.logout-btn');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', handleLogout);
        }
    }
    
    function initCarousel() {
        // Initialize any carousel functionality
        var carousels = document.querySelectorAll('.carousel, .slider');
        carousels.forEach(function(carousel) {
            // Add carousel logic here
        });
    }
    
    function initTooltips() {
        // Initialize tooltips
        var tooltipElements = document.querySelectorAll('[data-tooltip]');
        tooltipElements.forEach(function(element) {
            element.addEventListener('mouseenter', function() {
                // Show tooltip
            });
            element.addEventListener('mouseleave', function() {
                // Hide tooltip
            });
        });
    }
    
    function handleLogin(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        fetch('/api/auth/login.php', {
            method: 'POST',
            body: formData,
            credentials: 'include'
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                window.location.reload();
            } else {
                alert(data.message || '登录失败');
            }
        })
        .catch(function(error) {
            console.error('Login error:', error);
            alert('登录失败');
        });
    }
    
    function handleRegister(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        var password = formData.get('password');
        var passwordConfirm = formData.get('password_confirm');
        
        if (password !== passwordConfirm) {
            alert('密码确认不匹配');
            return;
        }
        
        fetch('/api/auth/register.php', {
            method: 'POST',
            body: formData,
            credentials: 'include'
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if (data.success) {
                alert('注册成功');
                document.querySelector('#registerModal').style.display = 'none';
                document.body.style.overflow = '';
                window.location.reload();
            } else {
                alert(data.message || '注册失败');
            }
        })
        .catch(function(error) {
            console.error('Register error:', error);
            alert('注册失败');
        });
    }
    
    function handleLogout() {
        fetch('/api/auth/logout.php', {
            method: 'POST',
            credentials: 'include'
        })
        .then(function() {
            window.location.reload();
        });
    }
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            var app = createApp();
            app.mount('#app');
        });
    } else {
        var app = createApp();
        app.mount('#app');
    }
    
    // Export for global access
    window.createApp = createApp;
    window.AppConfig = AppConfig;
    
})();


// App initialization without domain restrictions
(function() {
    'use strict';
    
    // Ensure jQuery is available
    if (typeof $ === 'undefined') {
        console.warn('jQuery not loaded');
        return;
    }
    
    // Initialize Vue app when DOM is ready
    $(document).ready(function() {
        // Remove any domain checks that might prevent loading
        // Initialize basic functionality
        initializeApp();
        initializeModals();
        initializeAuth();
        initializeUI();
    });
    
    function initializeApp() {
        console.log('App initializing...');
        // Basic app setup
    }
    
    function initializeModals() {
        // Modal functionality
        $('.modal-trigger').on('click', function(e) {
            e.preventDefault();
            const target = $(this).data('target');
            if (target) {
                $(target).show();
            }
        });
        
        $('.modal-close, .modal-backdrop').on('click', function() {
            $('.modal').hide();
        });
    }
    
    function initializeAuth() {
        // Auth form handlers
        $('#loginForm').on('submit', handleLogin);
        $('#registerForm').on('submit', handleRegister);
        $('.logout-btn').on('click', handleLogout);
    }
    
    function initializeUI() {
        // UI enhancements
        $('.dropdown-toggle').on('click', function(e) {
            e.preventDefault();
            $(this).next('.dropdown-menu').toggle();
        });
        
        // Close dropdowns when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-menu').hide();
            }
        });
    }
    
    function handleLogin(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('/api/auth/login.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Login failed');
            }
        })
        .catch(error => {
            console.error('Login error:', error);
            alert('Login failed');
        });
    }
    
    function handleRegister(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch('/api/auth/register.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Registration successful');
                location.reload();
            } else {
                alert(data.message || 'Registration failed');
            }
        })
        .catch(error => {
            console.error('Register error:', error);
            alert('Registration failed');
        });
    }
    
    function handleLogout() {
        fetch('/api/auth/logout.php', {
            method: 'POST'
        })
        .then(() => {
            location.reload();
        });
    }
    
})();

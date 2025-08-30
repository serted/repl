
/**
 * Authentication helper functions
 */
(function() {
    'use strict';
    
    window.Auth = {
        // Login function
        async login(username, password) {
            try {
                var formData = new FormData();
                formData.append('username', username);
                formData.append('password', password);
                
                var response = await fetch('/api/auth/login.php', {
                    method: 'POST',
                    body: formData
                });
                
                var data = await response.json();
                
                if (data.success) {
                    if (data.access_token) {
                        localStorage.setItem('token', data.access_token);
                        localStorage.setItem('expires_in', data.expires_in);
                        window.GlobalState.token = data.access_token;
                        window.GlobalState.isLoggedIn = true;
                    }
                    return { success: true, data: data };
                } else {
                    return { success: false, error: data.message || 'Login failed' };
                }
            } catch (error) {
                console.error('Login error:', error);
                return { success: false, error: 'Network error' };
            }
        },
        
        // Register function
        async register(userData) {
            try {
                var formData = new FormData();
                Object.keys(userData).forEach(function(key) {
                    formData.append(key, userData[key]);
                });
                
                var response = await fetch('/api/auth/register.php', {
                    method: 'POST',
                    body: formData
                });
                
                var data = await response.json();
                return data;
            } catch (error) {
                console.error('Register error:', error);
                return { error: 'Network error' };
            }
        },
        
        // Logout function
        logout: function() {
            localStorage.removeItem('token');
            localStorage.removeItem('expires_in');
            if (window.GlobalState) {
                window.GlobalState.token = null;
                window.GlobalState.user = null;
                window.GlobalState.isLoggedIn = false;
            }
            window.location.href = '/';
        },
        
        // Check if user is logged in
        isLoggedIn: function() {
            var token = localStorage.getItem('token');
            var expires = localStorage.getItem('expires_in');
            
            if (!token || !expires) {
                return false;
            }
            
            // Check if token is expired
            var expiryTime = parseInt(expires);
            var currentTime = Math.floor(Date.now() / 1000);
            
            if (currentTime > expiryTime) {
                this.logout();
                return false;
            }
            
            return true;
        },
        
        // Get current user info
        async getCurrentUser() {
            if (!this.isLoggedIn()) {
                return null;
            }
            
            try {
                var headers = {};
                var token = localStorage.getItem('token');
                if (token) {
                    headers['Authorization'] = 'Bearer ' + token;
                }
                
                var response = await fetch('/api/auth/me.php', {
                    headers: headers
                });
                
                var data = await response.json();
                
                if (data && !data.error) {
                    if (window.GlobalState) {
                        window.GlobalState.user = data;
                        window.GlobalState.balance = data.balance || 0;
                    }
                    return data;
                }
            } catch (error) {
                console.error('Get user error:', error);
            }
            
            return null;
        }
    };
    
    // Auto-check auth on page load
    async function checkAuth() {
        try {
            var response = await fetch('/api/auth/me.php', { credentials: 'include' });
            var data = await response.json();
            if (data && data.username && window.GlobalState) {
                window.GlobalState.user = data;
                window.GlobalState.isLoggedIn = true;
                window.GlobalState.balance = data.balance || 0;
            }
        } catch(e) { 
            console.warn('auth check failed', e); 
        }
    }
    
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkAuth);
    } else {
        checkAuth();
    }
    
})();

(async function(){
  async function checkAuth(){
    try {
      const r = await fetch('api/me.php', {credentials:'include'});
    } catch(e){ console.warn('auth check failed', e); }
  }
  document.addEventListener('DOMContentLoaded', checkAuth);
})();
/**
 * Authentication helper functions
 */
(function() {
    'use strict';
    
    window.Auth = {
        // Login function
        async login(username, password) {
            try {
                const response = await fetch('/api/login.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ username, password })
                });
                
                const data = await response.json();
                
                if (data.access_token) {
                    localStorage.setItem('token', data.access_token);
                    localStorage.setItem('expires_in', data.expires_in);
                    window.GlobalState.token = data.access_token;
                    window.GlobalState.isLoggedIn = true;
                    return { success: true, data };
                } else {
                    return { success: false, error: data.error || 'Login failed' };
                }
            } catch (error) {
                console.error('Login error:', error);
                return { success: false, error: 'Network error' };
            }
        },
        
        // Register function
        async register(userData) {
            try {
                const response = await fetch('/api/register.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(userData)
                });
                
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Register error:', error);
                return { error: 'Network error' };
            }
        },
        
        // Logout function
        logout() {
            localStorage.removeItem('token');
            localStorage.removeItem('expires_in');
            window.GlobalState.token = null;
            window.GlobalState.user = null;
            window.GlobalState.isLoggedIn = false;
            window.location.href = '/';
        },
        
        // Check if user is logged in
        isLoggedIn() {
            const token = localStorage.getItem('token');
            const expires = localStorage.getItem('expires_in');
            
            if (!token || !expires) {
                return false;
            }
            
            // Check if token is expired
            const expiryTime = parseInt(expires);
            const currentTime = Math.floor(Date.now() / 1000);
            
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
                const response = await fetch('/api/me.php', {
                    headers: {
                        'Authorization': `Bearer ${localStorage.getItem('token')}`
                    }
                });
                
                const data = await response.json();
                
                if (data && !data.error) {
                    window.GlobalState.user = data;
                    window.GlobalState.balance = data.balance || 0;
                    return data;
                }
            } catch (error) {
                console.error('Get user error:', error);
            }
            
            return null;
        }
    };
    
})();

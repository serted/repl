
/**
 * Application initialization - ensures proper loading order
 */
(function() {
    'use strict';
    
    // Wait for DOM and all scripts to load
    let scriptsLoaded = 0;
    const totalScripts = 3; // i18n, auth, main app
    
    function checkAllLoaded() {
        scriptsLoaded++;
        if (scriptsLoaded >= totalScripts && document.readyState === 'complete') {
            initializeApp();
        }
    }
    
    function initializeApp() {
        try {
            // Initialize global state
            if (!window.GlobalState) {
                window.GlobalState = {
                    user: null,
                    token: localStorage.getItem('token'),
                    balance: 0,
                    isLoggedIn: false
                };
            }
            
            // Initialize authentication
            if (window.Auth && window.Auth.isLoggedIn()) {
                window.Auth.getCurrentUser();
            }
            
            console.log('App initialized successfully');
        } catch (error) {
            console.error('App initialization error:', error);
        }
    }
    
    // Load required scripts
    const scripts = [
        '/js/i18n.js',
        '/js/auth.js',
        '/assets/index-C3VaJCuS.js'
    ];
    
    scripts.forEach(src => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = checkAllLoaded;
        script.onerror = function() {
            console.error('Failed to load script:', src);
            checkAllLoaded(); // Continue even if script fails
        };
        document.head.appendChild(script);
    });
    
    // Also check when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', checkAllLoaded);
    } else {
        checkAllLoaded();
    }
    
})();

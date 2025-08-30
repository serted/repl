/**
 * Fixed JavaScript file - removed ESM exports and added safe Vite helpers
 */

// Safe Vite helpers
window.__vite__mapDeps = function(indexes) {
  return indexes || [];
};

// Preload helper
(function(){
  const e=document.createElement("link").relList;
  if(e&&e.supports&&e.supports("modulepreload"))return;
  for(const r of document.querySelectorAll('link[rel="modulepreload"]'))s(r);
  new MutationObserver(r=>{
    for(const o of r)if(o.type==="childList")for(const i of o.addedNodes)i.tagName==="LINK"&&i.rel==="modulepreload"&&s(i)
  }).observe(document,{childList:!0,subtree:!0});
  function t(r){
    const o={};
    return r.integrity&&(o.integrity=r.integrity),r.referrerPolicy&&(o.referrerPolicy=r.referrerPolicy),r.crossOrigin==="use-credentials"?o.credentials="include":r.crossOrigin==="anonymous"?o.credentials="omit":o.credentials="same-origin",o
  }
  function s(r){
    if(r.ep)return;
    r.ep=!0;
    const o=t(r);
    fetch(r.href,o)
  }
})();


// Global Vue and Element Plus setup
window.Vue = window.Vue || {};
window.ElementPlus = window.ElementPlus || {};

// Main application code
(function() {
    'use strict';

    // Vue 3 setup
    const { createApp, ref, reactive, computed, onMounted, watch } = Vue;
    const { ElMessage, ElMessageBox, ElLoading } = ElementPlus;

    // Global state
    const globalState = reactive({
        user: null,
        token: localStorage.getItem('token') || null,
        balance: 0,
        isLoggedIn: false
    });

    // API helper
    const api = {
        async request(url, options = {}) {
            const config = {
                headers: {
                    'Content-Type': 'application/json',
                    ...options.headers
                },
                ...options
            };

            if (globalState.token) {
                config.headers.Authorization = `Bearer ${globalState.token}`;
            }

            try {
                const response = await fetch(url, config);
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('API Error:', error);
                return { error: 'Network error' };
            }
        },

        async login(username, password) {
            return this.request('/api/login.php', {
                method: 'POST',
                body: JSON.stringify({ username, password })
            });
        },

        async register(data) {
            return this.request('/api/register.php', {
                method: 'POST',
                body: JSON.stringify(data)
            });
        },

        async getUser() {
            return this.request('/api/me.php');
        }
    };

    // Main app component
    const App = {
        setup() {
            const loading = ref(false);
            const currentRoute = ref('home');

            const setToken = (token) => {
                globalState.token = token;
                localStorage.setItem('token', token);
            };

            const logout = () => {
                globalState.token = null;
                globalState.user = null;
                globalState.isLoggedIn = false;
                localStorage.removeItem('token');
            };

            onMounted(async () => {
                if (globalState.token) {
                    const userData = await api.getUser();
                    if (userData && !userData.error) {
                        globalState.user = userData;
                        globalState.isLoggedIn = true;
                        globalState.balance = userData.balance || 0;
                    }
                }
            });

            return {
                loading,
                currentRoute,
                globalState,
                setToken,
                logout,
                api
            };
        },

        template: `
            <div id="app">
                <div class="app-container">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        `
    };

    // Initialize app when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        try {
            if (typeof Vue !== 'undefined' && Vue.createApp) {
                const app = Vue.createApp(App);

                // Use Element Plus if available
                if (window.ElementPlus) {
                    app.use(ElementPlus);
                }

                app.mount('#app');
                console.log('App mounted successfully');
            } else {
                console.error('Vue.js not loaded');
            }
        } catch (error) {
            console.error('App mount error:', error);
            // Ensure basic functionality even if Vue fails
            document.getElementById('app').innerHTML = '<div>Loading...</div>';
        }
    });

    // Export for global access
    window.AppAPI = api;
    window.GlobalState = globalState;

})();
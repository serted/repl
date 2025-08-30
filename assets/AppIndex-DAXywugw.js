
/**
 * AppIndex Component - Fixed syntax errors
 */
(function() {
    'use strict';
    
    // Safe fallbacks for undefined functions
    window.Q = window.Q || function(obj) { return obj; };
    window.A = window.A || function() { return {}; };
    window.j = window.j || function() { return {}; };
    window.F = window.F || function() { return {}; };
    window.J = window.J || function() { return {}; };
    
    // Component definition
    const AppIndexComponent = {
        name: 'AppIndex',
        setup() {
            const { ref, reactive, onMounted } = Vue;
            
            const data = ref([]);
            const currentPage = ref(1);
            const pageSize = ref(10);
            const total = ref(0);
            const loading = ref(false);
            
            const loadData = async () => {
                loading.value = true;
                try {
                    // Mock data for now
                    data.value = [
                        {
                            id: 1,
                            title: 'Game 1',
                            img: '/assets/category-CMHPLGhY.png',
                            url: '#'
                        },
                        {
                            id: 2,
                            title: 'Game 2', 
                            img: '/assets/category-CMHPLGhY.png',
                            url: '#'
                        }
                    ];
                    total.value = data.value.length;
                } finally {
                    loading.value = false;
                }
            };
            
            const handleItemClick = (item) => {
                console.log('Item clicked:', item);
                if (item.url && item.url !== '#') {
                    window.open(item.url);
                }
            };
            
            const handlePageChange = (page) => {
                currentPage.value = page;
                loadData();
            };
            
            onMounted(() => {
                loadData();
            });
            
            return {
                data,
                currentPage,
                pageSize,
                total,
                loading,
                loadData,
                handleItemClick,
                handlePageChange
            };
        },
        
        template: `
            <div class="app-index">
                <div class="game-list" v-if="data.length">
                    <div class="imgItem" 
                         v-for="(item, index) in data" 
                         :key="index"
                         @click="handleItemClick(item)">
                        <div class="img-container">
                            <img :src="item.img" :alt="item.title" />
                            <div class="overlay">
                                <a :href="item.url" class="btn primary">查看</a>
                            </div>
                        </div>
                        <div class="title">{{ item.title }}</div>
                    </div>
                </div>
                <div v-else class="empty-state">
                    <p>No Data</p>
                </div>
            </div>
        `
    };
    
    // Register component globally if Vue is available
    if (window.Vue && window.Vue.createApp) {
        window.AppIndexComponent = AppIndexComponent;
    }
    
})();

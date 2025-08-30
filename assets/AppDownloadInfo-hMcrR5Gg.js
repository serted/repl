
/**
 * AppDownloadInfo Component - Fixed
 */
(function() {
    'use strict';
    
    const AppDownloadInfoComponent = {
        name: 'AppDownloadInfo',
        setup() {
            const { ref, reactive } = Vue;
            
            const downloadInfo = reactive({
                title: '下载APP',
                description: '随时随地享受游戏乐趣',
                buttons: [
                    { text: 'Android下载', icon: 'android', url: '#' },
                    { text: 'iOS下载', icon: 'apple', url: '#' }
                ]
            });
            
            const handleDownload = (type) => {
                console.log('Download:', type);
                // Add download logic here
            };
            
            return {
                downloadInfo,
                handleDownload
            };
        },
        
        template: `
            <div class="app-download-info">
                <h3>{{ downloadInfo.title }}</h3>
                <p>{{ downloadInfo.description }}</p>
                <div class="download-buttons">
                    <button v-for="btn in downloadInfo.buttons" 
                            :key="btn.text"
                            @click="handleDownload(btn.icon)"
                            class="download-btn">
                        {{ btn.text }}
                    </button>
                </div>
            </div>
        `
    };
    
    window.AppDownloadInfoComponent = AppDownloadInfoComponent;
    
})();

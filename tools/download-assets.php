
<?php
/**
 * Enhanced asset downloader - downloads all missing assets from original site
 */

echo "Downloading assets from pc.dfbiu.com...\n";

$assets_to_download = [
    // Core CSS
    'index-mqTVirNo.css' => 'https://pc.dfbiu.com/assets/index-mqTVirNo.css',
    
    // Images
    'notice-BFxQjxhm.png' => 'https://pc.dfbiu.com/assets/notice-BFxQjxhm.png',
    'h5-DDnm2lPM.png' => 'https://pc.dfbiu.com/assets/h5-DDnm2lPM.png',
    '15-DzRccdTg.png' => 'https://pc.dfbiu.com/assets/15-DzRccdTg.png',
    '16-Dn_-QgpL.png' => 'https://pc.dfbiu.com/assets/16-Dn_-QgpL.png',
    '17-CLffHcpW.png' => 'https://pc.dfbiu.com/assets/17-CLffHcpW.png',
    'title_bg-Di__fMUt.jpg' => 'https://pc.dfbiu.com/assets/title_bg-Di__fMUt.jpg',
    'app_download_btn_bg1-oNFq8O70.png' => 'https://pc.dfbiu.com/assets/app_download_btn_bg1-oNFq8O70.png',
    'app_download_btn_bg2-32SGOt7u.png' => 'https://pc.dfbiu.com/assets/app_download_btn_bg2-32SGOt7u.png',
    
    // Additional CSS files
    'el-form-item-CKZiX9BY.css' => 'https://pc.dfbiu.com/assets/el-form-item-CKZiX9BY.css',
    'el-overlay-DRoyQF-S.css' => 'https://pc.dfbiu.com/assets/el-overlay-DRoyQF-S.css',
    'AppIndex-BBu_fjf6.css' => 'https://pc.dfbiu.com/assets/AppIndex-BBu_fjf6.css',
    'AppBanner-CK-lTLTl.css' => 'https://pc.dfbiu.com/assets/AppBanner-CK-lTLTl.css',
    'AppDownloadInfo-COqfudpn.css' => 'https://pc.dfbiu.com/assets/AppDownloadInfo-COqfudpn.css',
    
    // JavaScript files (we'll clean them up)
    'AppIndex-DAXywugw.js' => 'https://pc.dfbiu.com/assets/AppIndex-DAXywugw.js',
    'AppDownloadInfo-hMcrR5Gg.js' => 'https://pc.dfbiu.com/assets/AppDownloadInfo-hMcrR5Gg.js'
];

$assets_dir = __DIR__ . '/../assets/';

if (!is_dir($assets_dir)) {
    mkdir($assets_dir, 0755, true);
}

foreach ($assets_to_download as $filename => $url) {
    $filepath = $assets_dir . $filename;
    
    if (file_exists($filepath)) {
        echo "Skipping $filename (already exists)\n";
        continue;
    }
    
    echo "Downloading $filename from $url\n";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($data && $httpCode === 200) {
        // Clean JavaScript files of ESM artifacts
        if (preg_match('/\.js$/', $filename)) {
            $data = cleanJavaScript($data);
        }
        
        file_put_contents($filepath, $data);
        echo "✓ Downloaded $filename (" . number_format(strlen($data)) . " bytes)\n";
    } else {
        echo "✗ Failed to download $filename (HTTP $httpCode)\n";
    }
}

function cleanJavaScript($js) {
    // Remove ESM exports/imports
    $js = preg_replace('/export\s+\{[^}]*\}\s*;?/m', '', $js);
    $js = preg_replace('/export\s+default\s+[^;]+;?/m', '', $js);
    $js = preg_replace('/import\s+[^;]+;?/m', '', $js);
    
    // Fix broken constructions
    $js = preg_replace('/[gt]\.\s*;/', '', $js);
    $js = preg_replace('/void\s+0\s*;/', '', $js);
    $js = preg_replace('/\$\.\s*;/', '', $js);
    
    // Add safe Vite helpers
    $js = "window.__vite__mapDeps = window.__vite__mapDeps || function(deps) { return deps || []; };\n" .
          "window.__vite__preload = window.__vite__preload || function(url) { return Promise.resolve(); };\n" .
          $js;
    
    // Wrap in IIFE to prevent global pollution
    if (!preg_match('/^\s*\(function\s*\(\)/', $js)) {
        $js = "(function(){\n'use strict';\n" . $js . "\n})();";
    }
    
    return $js;
}

echo "\nAsset download complete!\n";
?>

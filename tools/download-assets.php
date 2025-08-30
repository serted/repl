
<?php
/**
 * Asset downloader - downloads missing assets from original site
 */

$assets_to_download = [
    'title_bg-Di__fMUt.jpg' => 'https://pc.dfbiu.com/assets/title_bg-Di__fMUt.jpg',
    'app_download_btn_bg1-oNFq8O70.png' => 'https://pc.dfbiu.com/assets/app_download_btn_bg1-oNFq8O70.png',
    'app_download_btn_bg2-32SGOt7u.png' => 'https://pc.dfbiu.com/assets/app_download_btn_bg2-32SGOt7u.png'
];

$assets_dir = __DIR__ . '/../assets/';

if (!is_dir($assets_dir)) {
    mkdir($assets_dir, 0755, true);
}

foreach ($assets_to_download as $filename => $url) {
    $filepath = $assets_dir . $filename;
    
    if (file_exists($filepath)) {
        echo "✓ {$filename} already exists\n";
        continue;
    }
    
    echo "Downloading {$filename}... ";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
    
    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200 && $data !== false) {
        file_put_contents($filepath, $data);
        echo "✓ Downloaded\n";
    } else {
        echo "✗ Failed (HTTP {$httpCode})\n";
        
        // Create a simple placeholder file
        $placeholder = '<!-- Placeholder for ' . $filename . ' -->';
        file_put_contents($filepath, $placeholder);
    }
}

echo "\nDone! Assets downloaded to /assets/\n";

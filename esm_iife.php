<?php
require_once __DIR__.'/inc/bootstrap.php';
/**
 * Very simple ESM->IIFE shim to avoid "Unexpected token export".
 * Usage: /dev/esm_iife.php?f=assets/index-XXXX.js
 * - Reads the JS file from disk
 * - Strips "export ..." and "import ..." statements
 * - Wraps remaining code in an IIFE
 * NOTE: This is a pragmatic shim. For production, prefer prebuilt IIFE bundles.
 */
$f = $_GET['f'] ?? '';
$f = ltrim($f, '/');
$path = __DIR__ . '/' . $f;
if (!preg_match('~^assets/.*\.js$~', $f) || !is_file($path)) {
    http_response_code(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Not found";
    exit;
}
$js = file_get_contents($path);

// Remove BOM
$js = preg_replace('/^\xEF\xBB\xBF/', '', $js);

// Strip import/export lines (naive but safe for many Vite outputs)
$js = preg_replace('~^\s*import\s+[^;]+;\s*~m', '', $js);
$js = preg_replace('~^\s*export\s+\{[^}]*\};?\s*~m', '', $js);
$js = preg_replace('~^\s*export\s+default\s+~m', '', $js);
$js = preg_replace('~^\s*export\s+const\s+~m', 'const ', $js);
$js = preg_replace('~^\s*export\s+let\s+~m', 'let ', $js);
$js = preg_replace('~^\s*export\s+var\s+~m', 'var ', $js);
$js = preg_replace('~^\s*export\s+function\s+~m', 'function ', $js);
$js = preg_replace('~^\s*export\s+class\s+~m', 'class ', $js);

// Replace dynamic import(...) markers minimally
$js = preg_replace('~\bimport\s*\(~', '/*import*/(', $js);

// Wrap into IIFE
$wrapped = "(function(){\n".$js."\n})();";

header('Content-Type: application/javascript; charset=utf-8');
header('Cache-Control: public, max-age=3600');
echo $wrapped;

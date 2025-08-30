
<?php
/**
 * Helper functions for the application
 */

function asset($path) {
    return BASE_PREFIX . 'assets/' . ltrim($path, '/');
}

function url($path = '') {
    return BASE_PREFIX . ltrim($path, '/');
}

function urlp($path) {
    return BASE_PREFIX . ltrim($path, '/');
}

function is_logged_in() {
    return !empty($_SESSION['uid']);
}

function get_user_balance() {
    $user = current_user();
    return $user ? floatval($user['balance']) : 0;
}

function format_currency($amount, $currency = 'USD') {
    return number_format($amount, 4) . ' ' . $currency;
}

function safe_redirect($url) {
    header('Location: ' . $url);
    exit;
}

function render_template($template, $data = []) {
    extract($data);
    ob_start();
    include $template;
    return ob_get_clean();
}

function csrf_field() {
    return '<input type="hidden" name="_csrf" value="' . csrf_token() . '">';
}

function old($key, $default = '') {
    return $_SESSION['_old'][$key] ?? $default;
}

function flash($key, $message = null) {
    if ($message === null) {
        $value = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }
    $_SESSION['_flash'][$key] = $message;
}

function is_admin_user() {
    $user = current_user();
    return $user && !empty($user['is_admin']);
}

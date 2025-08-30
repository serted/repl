
<?php
require_once __DIR__ . '/../../inc/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    json_response(['error' => 'Method not allowed'], 405);
}

// Get token from Authorization header or session
$token = null;
$authHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';
if (preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
    $token = $matches[1];
}

$user = null;

if ($token) {
    // Validate token
    try {
        global $pdo;
        $stmt = $pdo->prepare('SELECT u.* FROM users u JOIN sessions s ON u.id = s.user_id WHERE s.id = ? AND s.expires_at > NOW()');
        $stmt->execute([$token]);
        $user = $stmt->fetch();
    } catch (Exception $e) {
        app_log('Token validation error: ' . $e->getMessage());
    }
} else {
    // Fallback to session
    $user = current_user();
}

if (!$user) {
    json_response(['error' => 'Unauthorized'], 401);
}

json_response([
    'id' => $user['id'],
    'username' => $user['username'],
    'nickname' => $user['nickname'],
    'balance' => floatval($user['balance']),
    'is_admin' => (bool)($user['is_admin'] ?? false)
]);

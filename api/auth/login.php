
<?php
require_once __DIR__ . '/../../inc/bootstrap.php';

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    json_response(['error' => 'Method not allowed'], 405);
}

$input = json_decode(file_get_contents('php://input'), true);

if (!$input || !isset($input['username']) || !isset($input['password'])) {
    json_response(['error' => 'Username and password required'], 400);
}

$username = trim($input['username']);
$password = $input['password'];

if (empty($username) || empty($password)) {
    json_response(['error' => 'Username and password cannot be empty'], 400);
}

try {
    global $pdo;
    
    $stmt = $pdo->prepare('SELECT id, username, password_hash, nickname, balance, is_admin FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if (!$user || !password_verify($password, $user['password_hash'])) {
        json_response(['error' => 'Invalid credentials'], 401);
    }
    
    // Generate session token
    $token = bin2hex(random_bytes(32));
    $expires_at = date('Y-m-d H:i:s', time() + 86400); // 24 hours
    
    // Store session
    $stmt = $pdo->prepare('INSERT INTO sessions (id, user_id, expires_at) VALUES (?, ?, ?)');
    $stmt->execute([$token, $user['id'], $expires_at]);
    
    // Update session
    $_SESSION['uid'] = $user['id'];
    regenerate_session();
    
    json_response([
        'access_token' => $token,
        'expires_in' => time() + 86400,
        'user' => [
            'id' => $user['id'],
            'username' => $user['username'],
            'nickname' => $user['nickname'],
            'balance' => floatval($user['balance']),
            'is_admin' => (bool)$user['is_admin']
        ]
    ]);
    
} catch (Exception $e) {
    app_log('Login error: ' . $e->getMessage());
    json_response(['error' => 'Internal server error'], 500);
}

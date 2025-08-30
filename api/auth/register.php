
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
$nickname = trim($input['nickname'] ?? $username);

if (empty($username) || empty($password)) {
    json_response(['error' => 'Username and password cannot be empty'], 400);
}

if (strlen($username) < 3 || strlen($username) > 50) {
    json_response(['error' => 'Username must be 3-50 characters'], 400);
}

if (strlen($password) < 6) {
    json_response(['error' => 'Password must be at least 6 characters'], 400);
}

try {
    global $pdo;
    
    // Check if username exists
    $stmt = $pdo->prepare('SELECT id FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        json_response(['error' => 'Username already exists'], 409);
    }
    
    // Create user
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare('INSERT INTO users (username, password_hash, nickname, balance) VALUES (?, ?, ?, 0.00)');
    $stmt->execute([$username, $password_hash, $nickname]);
    
    $user_id = $pdo->lastInsertId();
    
    // Generate session token
    $token = bin2hex(random_bytes(32));
    $expires_at = date('Y-m-d H:i:s', time() + 86400);
    
    // Store session
    $stmt = $pdo->prepare('INSERT INTO sessions (id, user_id, expires_at) VALUES (?, ?, ?)');
    $stmt->execute([$token, $user_id, $expires_at]);
    
    // Update session
    $_SESSION['uid'] = $user_id;
    regenerate_session();
    
    json_response([
        'access_token' => $token,
        'expires_in' => time() + 86400,
        'user' => [
            'id' => $user_id,
            'username' => $username,
            'nickname' => $nickname,
            'balance' => 0.00,
            'is_admin' => false
        ]
    ]);
    
} catch (Exception $e) {
    app_log('Register error: ' . $e->getMessage());
    json_response(['error' => 'Internal server error'], 500);
}

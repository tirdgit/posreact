// sync_upload_users.php
<?php
require 'db.php';
require 'auth.php';

$payload = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("REPLACE INTO users (id, username, password_hash, role, updated_at)
                       VALUES (?, ?, ?, ?, NOW())");
$stmt->execute([
    $payload['id'],
    $payload['username'],
    $payload['password_hash'],
    $payload['role']
]);

echo json_encode(['status' => 'ok']);

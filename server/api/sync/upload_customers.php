<!-- sync_upload_customers.php -->
<?php
require 'db.php';
require 'auth.php';

$payload = json_decode(file_get_contents('php://input'), true);

$stmt = $pdo->prepare("REPLACE INTO customers (id, name, phone, email, member_points, updated_at)
                       VALUES (?, ?, ?, ?, ?, NOW())");
$stmt->execute([
    $payload['id'],
    $payload['name'],
    $payload['phone'],
    $payload['email'],
    $payload['member_points']
]);

echo json_encode(['status' => 'ok']);

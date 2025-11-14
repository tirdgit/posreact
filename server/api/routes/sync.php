 <!-- routes/sync.php -->
<?php
require 'db.php';
require 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_GET['table']; // เช่น orders, products
    $payload = json_decode(file_get_contents('php://input'), true);

    if ($table === 'orders') {
        $stmt = $pdo->prepare("INSERT INTO orders (order_no, subtotal, vat_amount, total, payment_method, cashier_id, created_at) 
                               VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $payload['order']['order_no'],
            $payload['order']['subtotal'],
            $payload['order']['vat_amount'],
            $payload['order']['total'],
            $payload['order']['payment_method'],
            $payload['order']['cashier_id']
        ]);
        echo json_encode(['status' => 'ok']);
    }
}

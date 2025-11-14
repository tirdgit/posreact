// sync_upload.php
<?php
require 'db.php';
require 'auth.php';

$table = $_GET['table']; // เช่น products, orders
$payload = json_decode(file_get_contents('php://input'), true);

if ($table === 'products') {
    $stmt = $pdo->prepare("REPLACE INTO products (id, barcode, name, price, vat_rate, stock_qty, cost, updated_at)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $payload['id'],
        $payload['barcode'],
        $payload['name'],
        $payload['price'],
        $payload['vat_rate'],
        $payload['stock_qty'],
        $payload['cost'],
        date('Y-m-d H:i:s')
    ]);
    echo json_encode(['status' => 'ok']);
}

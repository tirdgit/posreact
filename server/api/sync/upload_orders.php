// sync_upload_orders.php
<?php
require 'db.php';
require 'auth.php';

$payload = json_decode(file_get_contents('php://input'), true);
$order = $payload['order'];
$items = $payload['items'];

$stmt = $pdo->prepare("REPLACE INTO orders (id, order_no, datetime, subtotal, vat_amount, discount, total, payment_method, cashier_id, updated_at)
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
$stmt->execute([
    $order['id'], $order['order_no'], $order['datetime'], $order['subtotal'],
    $order['vat_amount'], $order['discount'], $order['total'],
    $order['payment_method'], $order['cashier_id']
]);

foreach ($items as $i) {
    $stmt2 = $pdo->prepare("REPLACE INTO order_items (id, order_id, product_id, qty, unit_price, vat_rate)
                            VALUES (?, ?, ?, ?, ?, ?)");
    $stmt2->execute([$i['id'], $order['id'], $i['product_id'], $i['qty'], $i['unit_price'], $i['vat_rate']]);
}

echo json_encode(['status' => 'ok']);

// sync_download_orders.php
<?php
require 'db.php';
require 'auth.php';

$stmt = $pdo->query("SELECT * FROM orders WHERE updated_at > NOW() - INTERVAL 1 DAY");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($orders as &$o) {
    $stmt2 = $pdo->prepare("SELECT * FROM order_items WHERE order_id=?");
    $stmt2->execute([$o['id']]);
    $o['items'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
}

echo json_encode($orders);

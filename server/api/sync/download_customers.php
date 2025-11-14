// sync_download_customers.php
<?php
require 'db.php';
require 'auth.php';

$stmt = $pdo->query("SELECT * FROM customers WHERE updated_at > NOW() - INTERVAL 1 DAY");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

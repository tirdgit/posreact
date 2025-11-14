// sync_download_users.php
<?php
require 'db.php';
require 'auth.php';

$stmt = $pdo->query("SELECT * FROM users WHERE updated_at > NOW() - INTERVAL 1 DAY");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

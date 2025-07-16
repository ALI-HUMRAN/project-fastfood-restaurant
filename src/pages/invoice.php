<?php
session_start();
require '../includes/db.php';

$orderId = $_GET['id'] ?? 0;
$order = $pdo->prepare("SELECT * FROM orders WHERE id = ? AND user_id = ?");
$order->execute([$orderId, $_SESSION['user_id']]);
$order = $order->fetch();

if (!$order) die("Not found.");

$items = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
$items->execute([$orderId]);
?>

<h2>Invoice #<?= $orderId ?></h2>
<p>Address: <?= $order['delivery_address'] ?></p>
<p>Total: $<?= $order['total'] ?></p>
<ul>
  <?php foreach ($items as $item): ?>
    <li><?= $item['item_name'] ?> x <?= $item['quantity'] ?> = $<?= $item['price'] * $item['quantity'] ?></li>
  <?php endforeach; ?>
</ul>

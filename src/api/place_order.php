<?php
session_start();
require '../includes/db.php';
require '../includes/send_email.php';

if (!isset($_SESSION['user_id'])) {
  http_response_code(403);
  echo "Login required.";
  exit;
}

// Read JSON data
$data = json_decode(file_get_contents("php://input"), true);
$cart = $data['cart'] ?? [];
$address = $data['address'] ?? '';

if (empty($cart) || empty($address)) {
  http_response_code(400);
  echo "Missing cart or address.";
  exit;
}

// Calculate total
$total = 0;
foreach ($cart as $item) {
    $total += $item['price'] * $item['qty'];
}

// Insert into orders table
$stmt = $pdo->prepare("INSERT INTO orders (user_id, total, delivery_address) VALUES (?, ?, ?)");
$stmt->execute([$_SESSION['user_id'], $total, $address]);
$order_id = $pdo->lastInsertId();

// Insert each item into order_items table
foreach ($cart as $item) {
    $sub = $pdo->prepare("INSERT INTO order_items (order_id, item_name, price, quantity) VALUES (?, ?, ?, ?)");
    $sub->execute([$order_id, $item['name'], $item['price'], $item['qty']]);
}

// Fetch order and user info for email
$order = [
    'id' => $order_id,
    'total' => $total,
    'delivery_address' => $address
];

$user = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$user->execute([$_SESSION['user_id']]);
$user = $user->fetch();

// Send confirmation email
sendInvoiceEmail($user['email'], $user['username'], $order, $cart);

echo "Order placed successfully!";

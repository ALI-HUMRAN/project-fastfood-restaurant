<?php
session_start();
require '../includes/db.php';

...........

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Example: Sample data with IDs (simulate database)
$menu = [
    'Fast Food' => [
        ['id' => 1, 'name' => 'Cheeseburger', 'price' => 5.99],
        ['id' => 2, 'name' => 'Fries', 'price' => 2.50],
        ['id' => 3, 'name' => 'Chicken Nuggets', 'price' => 4.00],
    ],
    'Grills' => [
        ['id' => 4, 'name' => 'Grilled Chicken', 'price' => 7.99],
        ['id' => 5, 'name' => 'Lamb Chops', 'price' => 9.99],
        ['id' => 6, 'name' => 'Grilled Kebab', 'price' => 6.50],
    ],
    'Drinks' => [
        ['id' => 7, 'name' => 'Coca-Cola', 'price' => 1.50],
        ['id' => 8, 'name' => 'Lemonade', 'price' => 1.75],
        ['id' => 9, 'name' => 'Iced Tea', 'price' => 2.00],
    ],
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Menu - FastFood</title>
    <link rel="stylesheet" href="../css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .category {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fefefe;
        }
        .category h2 {
            border-bottom: 2px solid #e91e63;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .item {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
        }
        .item button {
            padding: 5px 10px;
            background-color: #4caf50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .item button:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>

<h1>🍽️ Our Menu</h1>
<p><a href="cart.php">🛒 View Cart</a></p>

<?php foreach ($menu as $category => $items): ?>
    <div class="category">
        <h2><?= htmlspecialchars($category) ?></h2>
        <?php foreach ($items as $item): ?>
            <div class="item">
                <span><?= htmlspecialchars($item['name']) ?> - $<?= number_format($item['price'], 2) ?></span>
                <button onclick="addToCart(<?= $item['id'] ?>)">Add</button>
            </div>
        <?php endforeach; ?>
    </div>
<?php endforeach; ?>

<script src="../js/cart.js"></script>
</body>
</html>

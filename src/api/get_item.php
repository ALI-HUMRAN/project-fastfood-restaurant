
<?php
require '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid item ID']);
    exit;
}

$id = (int) $_GET['id'];
$stmt = $conn->prepare("SELECT id, name, price FROM menu_items WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($item = $result->fetch_assoc()) {
    echo json_encode($item);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Item not found']);
}

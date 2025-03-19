<?php
require '../db.php'; // เชื่อมต่อฐานข้อมูล

$type = $_GET['type'] ?? null;
$id = $_GET['id'] ?? null;

if (!$type || !$id) {
    die("Error: Missing parameters");
}

$table = ($type == 'course') ? "courses" : "books";

// อัปเดตค่า is_popular ให้เป็นค่าตรงข้าม (0 -> 1, 1 -> 0)
$sql = "UPDATE $table SET is_popular = NOT is_popular WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();

header("Location: admin_dashboard.php?type=$type");
exit();
?>

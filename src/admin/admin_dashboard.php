<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$type = isset($_GET['type']) ? $_GET['type'] : 'course';
$sql = ($type == 'course') ? "SELECT id, course_name AS name, instructor AS author, price, is_popular FROM courses" 
                            : "SELECT id, book_title AS name, author, price, is_popular FROM books";

$result = $conn->query($sql);
$products = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - จัดการคอร์สและหนังสือ</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <h1>จัดการคอร์สเรียนและหนังสือ</h1>
    <div class="admin-controls">
        <a href="admin_add_course.php" class="btn">เพิ่มคอร์ส</a>
        <a href="admin_add_book.php" class="btn">เพิ่มหนังสือ</a>
        <button onclick="loadProducts('course')">แสดงคอร์ส</button>
        <button onclick="loadProducts('book')">แสดงหนังสือ</button>
    </div>

    <table>
        <thead>
            <tr>
                <th>ชื่อ</th>
                <th>ผู้สอน/ผู้เขียน</th>
                <th>ราคา</th>
                <th>ยอดนิยม</th>
                <th>จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['author']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?> บาท</td>
                    <td>
                        <a href="toggle_popular.php?type=<?= $type ?>&id=<?= $product['id'] ?>" 
                           class="btn <?= $product['is_popular'] ? 'btn-popular' : 'btn-normal' ?>">
                            <?= $product['is_popular'] ? '⭐ ยอดนิยม' : '☆ ไม่เป็นยอดนิยม' ?>
                        </a>
                    </td>
                    <td>
                        <a href="admin_edit_<?= $type ?>.php?id=<?= $product['id'] ?>" class="btn btn-edit">แก้ไข</a>
                        <a href="admin_delete.php?type=<?= $type ?>&id=<?= $product['id'] ?>" class="btn btn-delete" onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function loadProducts(type) {
            window.location.href = `admin_dashboard.php?type=${type}`;
        }
    </script>
</body>
</html>

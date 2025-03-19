<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$book_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($book_id == 0) {
    die("<p class='error'>ไม่พบหนังสือที่ต้องการแก้ไข</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    
    $sql = "UPDATE books SET book_title=?, author=?, description=?, price=?, pages=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdis", $book_title, $author, $description, $price, $pages, $book_id);
    
    if ($stmt->execute()) {
        echo "<p class='success'>อัปเดตข้อมูลหนังสือเรียบร้อย!</p>";
    } else {
        echo "<p class='error'>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
    }
    $stmt->close();
}

$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();
$result = $stmt->get_result();
$book = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขหนังสือ</title>
    <link rel="stylesheet" href="../admin_styles.css">
</head>
<body>
    <h1>แก้ไขหนังสือ</h1>
    <form action="admin_edit_book.php?id=<?= $book_id ?>" method="POST">
        <label>ชื่อหนังสือ:</label>
        <input type="text" name="book_title" value="<?= htmlspecialchars($book['book_title']) ?>" required>
        
        <label>ผู้เขียน:</label>
        <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
        
        <label>รายละเอียด:</label>
        <textarea name="description" required><?= htmlspecialchars($book['description']) ?></textarea>
        
        <label>ราคา (บาท):</label>
        <input type="number" name="price" value="<?= $book['price'] ?>" required>
        
        <label>จำนวนหน้า:</label>
        <input type="number" name="pages" value="<?= $book['pages'] ?>" required>
        
        <button type="submit">บันทึกการแก้ไข</button>
    </form>
</body>
</html>
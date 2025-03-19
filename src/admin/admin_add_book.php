<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงหมวดหมู่หนังสือจากฐานข้อมูล
$categories = [];
$sql = "SELECT id, category_name FROM categories WHERE category_name LIKE 'หนังสือ%'";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $pages = $_POST['pages'];
    $category_id = $_POST['category']; // 🆕 ดึงค่าหมวดหมู่
    $image = $_FILES['image']['name'];
    $target = "../product_display/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO books (book_title, author, description, price, pages, image, category_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdisi", $book_title, $author, $description, $price, $pages, $image, $category_id);
        
        if ($stmt->execute()) {
            echo "<p class='success'>เพิ่มหนังสือเรียบร้อย!</p>";
        } else {
            echo "<p class='error'>เกิดข้อผิดพลาด: " . $conn->error . "</p>";
        }
        $stmt->close();
    } else {
        echo "<p class='error'>อัปโหลดไฟล์ไม่สำเร็จ</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มหนังสือ</title>
    <link rel="stylesheet" href="../admin_styles.css">
</head>
<body>
    <h1>เพิ่มหนังสือ</h1>
    <form action="admin_add_book.php" method="POST" enctype="multipart/form-data">
        <label>ชื่อหนังสือ:</label>
        <input type="text" name="book_title" required>
        
        <label>ผู้เขียน:</label>
        <input type="text" name="author" required>
        
        <label>หมวดหมู่:</label>
        <select name="category" required>
            <?php foreach ($categories as $category): ?>
                <option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['category_name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label>รายละเอียด:</label>
        <textarea name="description" required></textarea>
        
        <label>ราคา (บาท):</label>
        <input type="number" name="price" required>
        
        <label>จำนวนหน้า:</label>
        <input type="number" name="pages" required>
        
        <label>อัปโหลดรูปภาพ:</label>
        <input type="file" name="image" accept="image/*" required>
        
        <button type="submit">เพิ่มหนังสือ</button>
    </form>
</body>
</html>

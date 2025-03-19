<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงหมวดหมู่คอร์สจากฐานข้อมูล
$categories = [];
$sql = "SELECT id, category_name FROM categories";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $categories[] = $row;
}

$add_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $instructor = $_POST['instructor'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    $category_id = $_POST['category'];
    $image = $_FILES['image']['name'];
    $target = "../product_display/" . basename($image);
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $sql = "INSERT INTO courses (course_name, instructor, description, price, duration, image, category_id) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssdisi", $course_name, $instructor, $description, $price, $duration, $image, $category_id);
        
        if ($stmt->execute()) {
            $add_success = true;
        }
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มคอร์สเรียน</title>
    <link rel="stylesheet" href="styles2.css">
    <script>
        function showSuccessPopup() {
            alert("เพิ่มคอร์สเรียบร้อย!");
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>เพิ่มคอร์สเรียน</h1>
        
        <form action="admin_add_course.php" method="POST" enctype="multipart/form-data" class="form-group" onsubmit="showSuccessPopup()">
            <label>ชื่อคอร์ส:</label>
            <input type="text" name="course_name" required>
            
            <label>ผู้สอน:</label>
            <input type="text" name="instructor" required>
            
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
            
            <label>ระยะเวลาเรียน (ชั่วโมง):</label>
            <input type="number" name="duration" required>
            
            <label>อัปโหลดรูปภาพ:</label>
            <input type="file" name="image" accept="image/*" required>
            
            <button type="submit">เพิ่มคอร์ส</button>
        </form>
    </div>
    <?php if ($add_success): ?>
        <script>
            showSuccessPopup();
        </script>
    <?php endif; ?>
</body>
</html>

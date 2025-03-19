<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$course_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($course_id == 0) {
    die("<p class='error'>ไม่พบคอร์สที่ต้องการแก้ไข</p>");
}

$update_success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_name = $_POST['course_name'];
    $instructor = $_POST['instructor'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $duration = $_POST['duration'];
    
    $sql = "UPDATE courses SET course_name=?, instructor=?, description=?, price=?, duration=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdis", $course_name, $instructor, $description, $price, $duration, $course_id);
    
    if ($stmt->execute()) {
        $update_success = true;
    }
    $stmt->close();
}

$sql = "SELECT * FROM courses WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $course_id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขคอร์ส</title>
    <link rel="stylesheet" href="styles22.css">
    <script>
        function showSuccessPopup() {
            alert("อัปเดตคอร์สเรียบร้อย!");
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>แก้ไขคอร์ส</h1>
        <form action="admin_edit_course.php?id=<?= $course_id ?>" method="POST" class="form-group" onsubmit="showSuccessPopup()">
            <label>ชื่อคอร์ส:</label>
            <input type="text" name="course_name" value="<?= htmlspecialchars($course['course_name']) ?>" required>
            
            <label>ผู้สอน:</label>
            <input type="text" name="instructor" value="<?= htmlspecialchars($course['instructor']) ?>" required>
            
            <label>รายละเอียด:</label>
            <textarea name="description" required><?= htmlspecialchars($course['description']) ?></textarea>
            
            <label>ราคา (บาท):</label>
            <input type="number" name="price" value="<?= $course['price'] ?>" required>
            
            <label>ระยะเวลาเรียน (ชั่วโมง):</label>
            <input type="number" name="duration" value="<?= $course['duration'] ?>" required>
            
            <button type="submit">บันทึกการแก้ไข</button>
        </form>
    </div>
    <?php if ($update_success): ?>
        <script>
            showSuccessPopup();
        </script>
    <?php endif; ?>
</body>
</html>

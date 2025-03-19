<!-- แก้เเล้ว -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store"; // ใช้ฐานข้อมูลใหม่

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ตรวจสอบว่าต้องการดึงข้อมูลคอร์ส (`courses`) หรือหนังสือ (`books`)
$type = isset($_GET['type']) ? $_GET['type'] : 'all';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id == 0) {
    die(json_encode(["error" => "Invalid ID"]));
}

// คำสั่ง SQL เพื่อดึงข้อมูลเฉพาะตัวที่เลือก
if ($type == 'course') {
    $sql = "SELECT id, course_name AS name, instructor, description, price, duration, image FROM courses WHERE id = ?";
} elseif ($type == 'book') {
    $sql = "SELECT id, book_title AS name, author, description, price, pages, image FROM books WHERE id = ?";
} else {
    die(json_encode(["error" => "Invalid type"]));
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// ส่งข้อมูลเป็น JSON
header('Content-Type: application/json');
echo json_encode($product);

$stmt->close();
$conn->close();
?>
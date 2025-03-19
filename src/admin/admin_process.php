<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error]));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $name = $_POST['name'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $extra = $_POST['extra']; // จำนวนหน้า (หนังสือ) หรือ ระยะเวลา (คอร์ส)
    $image = $_POST['image'];

    if ($type == "course") {
        $sql = "INSERT INTO courses (course_name, instructor, description, price, duration, image) VALUES (?, ?, ?, ?, ?, ?)";
    } elseif ($type == "book") {
        $sql = "INSERT INTO books (book_title, author, description, price, pages, image) VALUES (?, ?, ?, ?, ?, ?)";
    } else {
        die(json_encode(["error" => "ประเภทไม่ถูกต้อง"]));
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssdis", $name, $author, $description, $price, $extra, $image);

    if ($stmt->execute()) {
        echo json_encode(["success" => "เพิ่มข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["error" => "เกิดข้อผิดพลาด: " . $conn->error]);
    }
    $stmt->close();
}

$conn->close();
?>
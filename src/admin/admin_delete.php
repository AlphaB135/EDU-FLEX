<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "education_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "เชื่อมต่อฐานข้อมูลล้มเหลว: " . $conn->connect_error]));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = intval($_GET['id']);

    if ($type == 'course') {
        $sql = "DELETE FROM courses WHERE id = ?";
    } elseif ($type == 'book') {
        $sql = "DELETE FROM books WHERE id = ?";
    } else {
        die(json_encode(["error" => "ประเภทไม่ถูกต้อง"]));
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["message" => "ลบข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["error" => "เกิดข้อผิดพลาด: " . $conn->error]);
    }
    $stmt->close();
}

$conn->close();
?>
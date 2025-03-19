<?php
header('Content-Type: application/json; charset=UTF-8');
require 'db.php'; // เชื่อมต่อฐานข้อมูล

try {
    // ตรวจสอบว่าต้องการดึงเฉพาะยอดนิยมหรือไม่
    $isPopularOnly = isset($_GET['popular']) && $_GET['popular'] === "true";

    // ✅ เงื่อนไข SQL: ถ้าต้องการเฉพาะยอดนิยม ให้เพิ่ม `WHERE is_popular = 1`
    $whereClause = $isPopularOnly ? "WHERE is_popular = 1" : "";

    // คำสั่ง SQL ดึงข้อมูลจากทั้ง `courses` และ `books`
    $sql = "SELECT id, course_name AS name, instructor, description, price, duration, image, 'course' AS type 
            FROM courses $whereClause
            UNION ALL
            SELECT id, book_title AS name, author AS instructor, description, price, pages AS duration, image, 'book' AS type 
            FROM books $whereClause";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // ดึงข้อมูลทั้งหมด
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ส่ง JSON กลับไปที่ Frontend
    echo json_encode($products, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    echo json_encode(["error" => "❌ Database error: " . $e->getMessage()]);
}

?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $target_dir = "../product_display/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // ตรวจสอบว่าไฟล์เป็นรูปภาพจริงหรือไม่
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check === false) {
        echo json_encode(["error" => "ไฟล์ที่อัปโหลดไม่ใช่รูปภาพ"]);
        $uploadOk = 0;
    }

    // ตรวจสอบขนาดไฟล์ (ไม่เกิน 5MB)
    if ($_FILES['image']['size'] > 5000000) {
        echo json_encode(["error" => "ไฟล์มีขนาดใหญ่เกินไป (สูงสุด 5MB)"]);
        $uploadOk = 0;
    }

    // อนุญาตเฉพาะไฟล์ JPG, PNG, JPEG
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png'])) {
        echo json_encode(["error" => "อนุญาตเฉพาะไฟล์ JPG, JPEG, และ PNG เท่านั้น"]);
        $uploadOk = 0;
    }

    // ถ้าผ่านทุกการตรวจสอบ ให้ทำการอัปโหลดไฟล์
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            echo json_encode(["success" => "อัปโหลดไฟล์สำเร็จ", "file" => basename($_FILES['image']['name'])]);
        } else {
            echo json_encode(["error" => "เกิดข้อผิดพลาดในการอัปโหลดไฟล์"]);
        }
    }
} else {
    echo json_encode(["error" => "ไม่มีไฟล์ถูกส่งมา"]);
}
?>

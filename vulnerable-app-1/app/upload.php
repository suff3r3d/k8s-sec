<?php
$upload_dir = "uploads/";

// Lấy trực tiếp tên file từ ô input (biến POST) mà không kiểm tra
$filename = $_POST["filename"]; 
$target = $upload_dir . $filename;

echo "Đang cố gắng lưu file vào: <b>" . $target . "</b><br>";

if (move_uploaded_file($_FILES["file"]["tmp_name"], $target)) {
    echo "<span style='color:green'>Upload Thành công!</span>";
} else {
    echo "<span style='color:red'>Upload Thất bại!</span>";
}
?>
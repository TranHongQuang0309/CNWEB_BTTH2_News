<?php
include 'db_connection.php';  // Kết nối cơ sở dữ liệu
include 'functions.php';      // Các hàm đã viết sẵn

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (delete_category($db, $id)) {
        echo "Danh mục đã được xóa!";
    } else {
        echo "Lỗi khi xóa danh mục.";
    }
    header("Location: categories.php");
    exit();
}
?>

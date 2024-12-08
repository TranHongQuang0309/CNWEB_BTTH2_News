<?php
// Thông tin kết nối đến cơ sở dữ liệu MySQL
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tlunews";
try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Thiết lập chế độ báo lỗi
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Truy vấn dữ liệu từ bảng 'news'
    $stmt = $conn->prepare("SELECT * FROM news");
    $stmt->execute();
    // Truy vấn dữ liệu từ bảng 'news'
    $stmt = $conn->prepare("SELECT * FROM  users");
    $stmt->execute(); // Truy vấn dữ liệu từ bảng 'news'
    $stmt = $conn->prepare("SELECT * FROM categories");
    $stmt->execute();

    // Lấy dữ liệu dưới dạng mảng liên kết
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    $news = []; // Gán mảng rỗng nếu lỗi
}
?>

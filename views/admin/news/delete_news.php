<?php
// Bước 1: Kết nối CSDL
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tlunews";

try {
    // Lấy ID bài viết từ URL
    $new_id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Kiểm tra xem bài viết có tồn tại không
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $new_id, PDO::PARAM_INT);
    $stmt->execute();
    $new = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$new) {
        echo "<div class='alert alert-danger'>Bài viết không tồn tại.</div>";
        exit;
    }

    // Xóa bài viết
    $sql = "DELETE FROM news WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $new_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Xóa bài viết thành công!</div>";
        // Chuyển hướng về trang danh sách bài viết
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<div class='alert alert-danger'>Xóa bài viết thất bại!</div>";
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    // Đóng kết nối
    $conn = null;
}
?>
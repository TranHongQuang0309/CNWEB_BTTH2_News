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

    // Bước 2: Truy vấn lấy chi tiết bài viết theo ID
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $new_id, PDO::PARAM_INT);
    $stmt->execute();
    $new = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$new) {
        // Nếu không tìm thấy bài viết
        echo "Bài viết không tồn tại.";
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    // Bước 3: Đóng kết nối
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1 class="text-primary text-center">CHI TIẾT BÀI VIẾT</h1>

        <div class="card">
            <div class="card-body">
                <p><strong>Bài viết:</strong> <?php echo htmlspecialchars($new['id']); ?></p>
                <p><strong>Tiêu đề:</strong> <?php echo htmlspecialchars($new['title']); ?></p>
                <p><strong>Nội dung:</strong> <?php echo htmlspecialchars($new['content']); ?></p>
                <p><strong>Ngày đăng:</strong> <?php echo htmlspecialchars($new['created_at']); ?></p>
            </div>
        </div>

        <a href="dashboard.php" class="btn btn-secondary mt-3">Trở lại danh sách bài viết</a>
        <a href="edit_news.php?id=<?php echo $new['id']; ?>" class="btn btn-secondary mt-3">Sửa bài viết</a>
        <a href="delete_news.php?id=<?php echo $new['id']; ?>" class="btn btn-secondary mt-3">Xóa bài viết</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
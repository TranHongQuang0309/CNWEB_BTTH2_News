<?php
// Bước 1: Kết nối CSDL
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tlunews";

try {
    // Tạo kết nối
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    // Lấy ID bài viết từ URL
    $new_id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Nếu người dùng gửi form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Cập nhật dữ liệu bài viết
        $sql = "UPDATE news SET title = :title, content = :content WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':id', $new_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Cập nhật bài viết thành công!</div>";
        } else {
            echo "<div class='alert alert-danger'>Cập nhật bài viết thất bại!</div>";
        }
    }

    // Lấy thông tin bài viết hiện tại
    $sql = "SELECT * FROM news WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $new_id, PDO::PARAM_INT);
    $stmt->execute();
    $new = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$new) {
        echo "<div class='alert alert-danger'>Bài viết không tồn tại.</div>";
        exit;
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    // Đóng kết nối
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-primary text-center">SỬA BÀI VIẾT</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control" id="title" name="title"
                    value="<?php echo htmlspecialchars($new['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung</label>
                <textarea class="form-control" id="content" name="content" rows="5"
                    required><?php echo htmlspecialchars($new['content']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Cập nhật</button>
            <a href="dashboard.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
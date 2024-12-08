<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="tlunews/views/news/style.css">
</head>

<body>
   
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/tlunews/tlunews/index.php/news">Trang Tin Tức</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                 
                    <?php
                    if (isset($categories) && !empty($categories)) {
                        foreach ($categories as $category) {
                            echo "
                            <li class='nav-item'>
                                <a class='nav-link' href='/category/" . htmlspecialchars($category['id']) . "'>" . htmlspecialchars($category['name']) . "</a>
                            </li>
                            ";
                        }
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='#'>Chưa có danh mục</a></li>";
                    }
                    ?>
                </ul>

                <!-- Nút Đăng Nhập ở cuối bên phải -->
                <div class="d-flex justify-content-end">
                    <a href="/login" class="btn btn-outline-light">Đăng nhập</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Nút quay lại -->
    <a href="http://localhost/tlunews/tlunews/index.php/news" class="btn btn-primary mt-3">Quay lại danh sách tin tức</a>

    <div class="container mt-4">
        <div class="row">
            <!-- Cột chính -->
            <div class="col-md-12">
            <?php
// Kiểm tra xem biến $news có tồn tại và có dữ liệu không
if (isset($news) && !empty($news)) {
    

    // Hiển thị danh mục và ngày đăng trên cùng một dòng
    echo "<p>
            <strong>Danh mục:</strong> " . htmlspecialchars($news['category_name']) . " | 
            <strong>Ngày đăng:</strong> " . date('d/m/Y', strtotime($news['created_at'])) . "
          </p>";
// Hiển thị tiêu đề tin tức
echo "<h1 class='mb-4'>" . htmlspecialchars($news['title']) . "</h1>";

// Hiển thị hình ảnh bên dưới tiêu đề
echo "<div class='mb-3'>
        <img src='" . htmlspecialchars($news['category_image']) . "' alt='Category Image' style='width: 100%; max-height: 400px; object-fit: cover; border-radius: 10px;'>
      </div>";
    // Hiển thị nội dung tin tức
    echo "<div class='news-content'>";
    echo "<p>" . nl2br(htmlspecialchars($news['content'])) . "</p>";
    echo "</div>";
} else {
    // Nếu không tìm thấy tin tức, hiển thị thông báo lỗi
    echo "<p>Không tìm thấy tin tức này.</p>";
}
?>


    <!-- Liên kết đến JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

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

    // Lấy dữ liệu dưới dạng mảng liên kết
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    $news = []; // Gán mảng rỗng nếu lỗi
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
            position: fixed;
            height: 100%;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #ecf0f1;
            font-size: 1.5em;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
        }

        .sidebar ul li a {
            text-decoration: none;
            color: white;
            display: block;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #34495e;
            border-radius: 4px;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
        }

        .main-content h1 {
            font-size: 28px;
            color: #34495e;
            margin-bottom: 20px;
            text-align: center;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #34495e;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }

        .card p {
            font-size: 14px;
            color: #7f8c8d;
            height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .card a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        .card a:hover {
            background-color: #2980b9;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h2>TRANG QUẢN TRỊ</h2>
        <ul>
            <li><a href="#">Quản lý người dùng</a></li>
            <li><a href="#">Quản lý danh mục</a></li>
            <li><a href="#">Quản lý tin tức</a></li>
            <li><a href="logout.php">Đăng xuất</a></li>
        </ul>
    </div>
    <div class="main-content">
        <h1>Chào mừng đến với ADMIN!</h1>
        <div class="d-flex justify-content-between mb-3">
            <a href="add_news.php" class="btn btn-success">Thêm bài viết mới</a>
        </div>
        <div class="cards">
            <?php if (empty($news)): ?>
                <p>Không có tin tức nào được tìm thấy.</p>
            <?php else: ?>
                <?php foreach ($news as $new): ?>
                    <div class="card">
                        <img src="<?= htmlspecialchars($new['image'] ?? '') ?>"
                            style="width: 100%; height: 150px; object-fit: cover;">
                        <h3><?= htmlspecialchars($new['title']); ?></h3>
                        <p><?= htmlspecialchars(substr($new['content'], 0, 100)) . '...'; ?></p>
                        <a href="detail.php?id=<?= $new['id']; ?>">Xem chi tiết</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
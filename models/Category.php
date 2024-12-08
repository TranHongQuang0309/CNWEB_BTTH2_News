<?php
include 'db_connection.php'; // Kết nối cơ sở dữ liệu
include 'functions.php'; // Các hàm đã viết sẵn

// Lấy danh sách các category
$categories = dashboard($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<div class="container mt-5">
    <h1>Quản Lý Danh Mục</h1>

    <!-- Thêm Danh Mục -->
    <a href="add_category.php" class="btn btn-success mb-3">Thêm Danh Mục</a>

    <!-- Hiển thị bảng danh mục -->
    <?php if (count($categories) > 0): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên Danh Mục</th>
                <th>Miêu Tả</th>
                <th>Vị Trí</th>
                <th>Trạng Thái</th>
                <th>Hành Động</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?= htmlspecialchars($category['id']); ?></td>
                    <td><?= htmlspecialchars($category['name']); ?></td>
                    <td><?= htmlspecialchars($category['description']); ?></td>
                    <td><?= htmlspecialchars($category['position']); ?></td>
                    <td><?= htmlspecialchars($category['status']); ?></td>
                    <td>
                        <a href="edit_category.php?id=<?= $category['id']; ?>" class="btn btn-primary">Sửa</a>
                        <a href="delete_category.php?id=<?= $category['id']; ?>" class="btn btn-danger"
                           onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>
        <p>Không có danh mục nào.</p>
    <?php endif; ?>
</div>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

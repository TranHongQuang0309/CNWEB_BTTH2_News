<?php
include 'db_connection.php'; // Kết nối cơ sở dữ liệu
include 'functions.php'; // Các hàm đã viết sẵn

$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        "name" => $_POST["name"],
        "description" => $_POST["description"],
        "slug" => $_POST["slug"],
        "title_tag" => $_POST["title_tag"],
        "keywords_tag" => $_POST["keywords_tag"],
        "description_tag" => $_POST["description_tag"],
        "image" => $_POST["image"],
        "alt" => $_POST["alt"],
        "position" => categories($db),
        "robot_tag" => $_POST["robot_tag"],
        "status" => $_POST["status"],
        "parent_id" => $_POST["parent_id"] ?? 0,
        "created_at" => date("Y-m-d H:i:s")
    ];

    add($db, $data, $error); // Hàm thêm category
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Danh Mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
<div class="container mt-5">
    <h1>Thêm Danh Mục Mới</h1>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger">
            <?php foreach ($error as $msg): ?>
                <p><?= htmlspecialchars($msg); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Tên Danh Mục</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Miêu Tả</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <!-- Các trường khác tương tự như slug, title_tag, v.v. -->
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

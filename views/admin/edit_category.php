<?php
include 'db_connection.php';  // Kết nối cơ sở dữ liệu
include 'functions.php';      // Các hàm đã viết sẵn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = [
        'id' => $_POST['id'],
        'name' => $_POST['name']
    ];

    if (edit_category($db, $data)) {
        echo "Danh mục đã được cập nhật!";
        header("Location: categories.php");
        exit();
    } else {
        echo "Lỗi khi cập nhật danh mục.";
    }
} else {
    $id = $_GET['id'];
    $result = $db->query("SELECT * FROM categories WHERE id = $id");
    $category = $result->fetch_assoc();
}
?>

<h2>Sửa Danh Mục</h2>
<form method="post">
    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
    Tên danh mục: <input type="text" name="name" value="<?php echo $category['name']; ?>" required>
    <button type="submit">Cập Nhật</button>
</form>

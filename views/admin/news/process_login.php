<?php
session_start();

// Kết nối đến cơ sở dữ liệu
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "tlunews";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Lấy thông tin từ form
$user = $_POST['username'];
$pass = $_POST['password'];

// Truy vấn kiểm tra username và password
$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Đăng nhập thành công
    $row = $result->fetch_assoc();
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['role'] = $row['role'];

    if ($row['role'] == 1) {
        // Quản trị viên
        header('Location: /tlunews/views/admin/dashboard.php');
    } else {
        // Người dùng khách
        header('Location: /tlunews/views/home/index.php');
    }
} else {
    // Sai thông tin đăng nhập
    echo "<script>alert('Invalid username or password!'); window.location.href='login.php';</script>";
}

// Đóng kết nối
$stmt->close();
$conn->close();
?>
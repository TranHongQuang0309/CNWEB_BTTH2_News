<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<style>
    /* Toàn bộ thân trang */
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #74b9ff, #0984e3);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: #fff;
    }

    /* Container đăng nhập */
    .login-container {
        background: #ffffff;
        color: #333;
        padding: 2rem;
        border-radius: 8px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        text-align: center;
        width: 400px;
    }

    /* Tiêu đề */
    .login-container h1 {
        margin-bottom: 1.5rem;
        font-size: 2rem;
        color: #0984e3;
    }

    /* Các nhóm biểu mẫu */
    .form-group {
        margin-bottom: 1.5rem;
        text-align: left;
    }

    /* Label */
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    /* Input */
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
    }


    .btn {
        display: inline-block;
        width: 100%;
        padding: 10px;
        font-size: 1.2rem;
        background: #0984e3;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background 0.3s;
    }

    .btn:hover {
        background: #74b9ff;
    }
</style>


<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="process_login.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    <?php if (isset($error)) {
        echo "<p style='color: red;'>$error</p>";
    } ?>
</body>

</html>
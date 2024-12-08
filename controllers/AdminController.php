<?php

class AdminController
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // 1. Hiển thị danh sách bài viết
    public function index()
    {
        $stmt = $this->db->query("SELECT id, title, created_at FROM news ORDER BY created_at DESC");
        $newsList = $stmt->fetchAll(PDO::FETCH_ASSOC);
        require_once "views/admin/news/index.php";
    }

    // 2. Xem chi tiết bài viết
    public function show($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$news) {
            die("Bài viết không tồn tại.");
        }

        require_once "views/admin/news/detail.php";
    }

    // 3. Hiển thị form thêm bài viết
    public function create()
    {
        require_once "views/admin/news/add_news.php";
    }

    // 4. Xử lý thêm bài viết
    public function store($data)
    {
        $stmt = $this->db->prepare("INSERT INTO news (title, content, created_at) VALUES (:title, :content, :created_at)");
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $stmt->bindValue(':created_at', date('Y-m-d H:i:s'), PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: index.php?controller=admin&action=index");
            exit;
        } else {
            die("Thêm bài viết thất bại.");
        }
    }

    // 5. Hiển thị form chỉnh sửa bài viết
    public function edit($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM news WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $news = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$news) {
            die("Bài viết không tồn tại.");
        }

        require_once "views/admin/news/edit_news.php";
    }

    // 6. Cập nhật bài viết
    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE news SET title = :title, content = :content WHERE id = :id");
        $stmt->bindValue(':title', $data['title'], PDO::PARAM_STR);
        $stmt->bindValue(':content', $data['content'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?controller=admin&action=index");
            exit;
        } else {
            die("Cập nhật bài viết thất bại.");
        }
    }

    // 7. Xóa bài viết
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM news WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: index.php?controller=admin&action=index");
            exit;
        } else {
            die("Xóa bài viết thất bại.");
        }
    }

}


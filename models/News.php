<?php
// models/NewsModel.php
class NewsModel {
    private $pdo;

    public function __construct($pdo) {
        // Khởi tạo PDO instance
        $this->pdo = $pdo;
    }

    // Lấy tất cả các tin tức từ cơ sở dữ liệu
    public function getAllNews() {
        try {
            // Truy vấn lấy danh sách tin tức và tên danh mục
            $stmt = $this->pdo->prepare("SELECT n.id, n.title, c.name AS category_name, n.created_at 
                                         FROM news n 
                                         LEFT JOIN categories c ON n.category_id = c.id");
            $stmt->execute();
            
            // Lấy tất cả dữ liệu và trả về dưới dạng mảng
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Nếu không có tin tức nào, trả về mảng rỗng
            if (empty($result)) {
                return [];
            }

            return $result;
        } catch (PDOException $e) {
            // Nếu có lỗi xảy ra, xử lý và trả về thông báo lỗi
            die("Error: " . $e->getMessage());
        }
    }

    // Lấy tin tức theo ID từ cơ sở dữ liệu
    public function getNewsById($id) {
        try {
            // Truy vấn lấy thông tin chi tiết về tin tức, bao gồm thời gian tạo (created_at) và tên danh mục
            $stmt = $this->pdo->prepare("SELECT n.id, n.title, n.content, n.created_at, c.name AS category_name
                                         FROM news n 
                                         LEFT JOIN categories c ON n.category_id = c.id 
                                         WHERE n.id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Trả về tin tức duy nhất hoặc false nếu không tìm thấy
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
}
?>

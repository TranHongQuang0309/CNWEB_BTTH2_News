<?php
// controllers/NewsController.php
require_once '/tlunews/models/News.php';

class NewsController {
    private $model;

    public function __construct($pdo) {
        $this->model = new NewsModel($pdo);
    }

    public function index() {
        $newsList = $this->model->getAllNews();
        
        require '/tlunews/views/news/index.php';
    }

    public function detail($id) {
        $news = $this->model->getNewsById($id);
        if (!$news) {
            die("News not found!");
        }
       
        require '/tlunews/views/news/detail.php';
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Tin Tức</title>

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    
    <link rel="stylesheet" href="tlunews\views\news\style.css">
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
          
                 <div class="d-flex justify-content-end"">
                    <a href="tlunews/admin/news/login" class="btn btn-outline-light">Đăng nhập</a>
                </div>
            </div>
        </div>
        

    </nav>

   


    <div class="container mt-4">
        <div class="row">
           
            <div class="col-md-12">
                
                <?php
                if (isset($newsList) && !empty($newsList)) {
                    $firstNews = $newsList[0];
                    echo "
                    <div class='row mb-4'>
                        <div class='col-md-12'>
                            <div class='card mb-4'>
                                <img src='https://via.placeholder.com/1200x600' class='card-img-top' alt='Image'>
                                <div class='card-body'>
                                    <h2 class='card-title'>" . htmlspecialchars($firstNews['title']) . "</h2>
                                    <a href='/tlunews/tlunews/index.php/news/" . $firstNews['id'] . "' class='btn btn-danger btn-lg'>Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                    
                    array_shift($newsList);
                }
                ?>

               
                <div class="row">
                    <?php
                    foreach ($newsList as $news) {
                        echo "
                        <div class='col-md-4 mb-4'>
                            <div class='card'>
                                <img src='https://via.placeholder.com/350x200' class='card-img-top' alt='Image'>
                                <div class='card-body'>
                                    <h5 class='card-title'>" . htmlspecialchars($news['title']) . "</h5>
                                    <a href='/tlunews/tlunews/index.php/news/" . $news['id'] . "' class='btn btn-primary'>Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

</body>

</html>

<?php
session_start(); // 啟動 session

// 檢查是否有購物車存在於 session 中，如果沒有則建立一個空購物車
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// 模擬商品資料
$products = [
    "1" => ["name" => "Pixel 8 Pro", "image" => "./images/Pixel-8-Pro.webp"],
    "2" => ["name" => "iPhone 15 Pro", "image" => "./images/iPhone-15-Pro.jpeg"],
    "3" => ["name" => "NVIDIA GeForce RTX 4090", "image" => "./images/RTX-4090.png"]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ari4IV商店</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            height: 600px; /* 設定卡片的固定高度 */
        }
        .card-img-top {
            height: 300px;
            object-fit: cover; /* 確保圖片覆蓋整個區域，不失真 */
        }
        .card-body {
            overflow: auto; /* 確保內容過多時可以滾動 */
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Ari4IV商店</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="./cart.php">購物車</a>
                </li>
                <li class="nav-item">
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                        <a class="nav-link" href="logout.php">登出</a>
                    <?php else: ?>
                        <a class="nav-link" href="login.php">登入</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($products as $id => $product): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $product['image']; ?>" class="card-img-top" alt="商品圖片">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        </div>
                        <a style="width:50%" href="add_to_cart.php?product_id=<?php echo $id; ?>" class="btn btn-primary mx-auto mb-5">加入購物車</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

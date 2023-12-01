<?php
session_start(); // 啟動 session

// 檢查使用者是否已登入
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 如果使用者未登入，重定向到登入頁面
    header('Location: login.php');
    exit;
}

// 假設的商品資訊
$products = [
    "1" => ["name" => "Pixel 8 Pro", "price" => 999],
    "2" => ["name" => "iPhone 15 Pro", "price" => 1199],
    "3" => ["name" => "NVIDIA GeForce RTX 4090", "price" => 1499]
];

// 檢查購物車是否存在於 session 中，如果不存在則建立一個空購物車
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// 處理清空購物車
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    $_SESSION['cart'] = array();
}

// 處理移除特定商品
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id = $_GET['id'];
    unset($_SESSION['cart'][$id]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>購物車</title>
    <!-- 引入 Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>購物車</h2>
        <a href="index.php" class="btn btn-primary">返回首頁</a>
        <a href="?action=clear" class="btn btn-danger">清空購物車</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">商品名稱</th>
                    <th scope="col">價格</th>
                    <th scope="col">數量</th>
                    <th scope="col">總計</th>
                    <th scope="col">操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $quantity):
                    if (isset($products[$id])):
                        $product = $products[$id];
                        $subtotal = $product['price'] * $quantity;
                        $total += $subtotal;
                ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td><?php echo htmlspecialchars($quantity); ?></td>
                        <td>$<?php echo htmlspecialchars($subtotal); ?></td>
                        <td>
                            <a href="?action=remove&id=<?php echo $id; ?>" class="btn btn-danger btn-sm">移除</a>
                        </td>
                    </tr>
                <?php
                    endif;
                endforeach;
                ?>
                <tr>
                    <td colspan="4" class="text-right">總計</td>
                    <td>$<?php echo htmlspecialchars($total); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!-- 引入 Bootstrap JavaScript 和依賴 -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
session_start(); // 啟動 session

// 檢查使用者是否已登入
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // 如果使用者未登入，重定向到登入頁面
    header('Location: login.php');
    exit;
}

// 檢查是否已存在購物車，如果沒有則建立一個空購物車
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// 檢查是否傳遞了商品 ID
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // 檢查商品是否已經在購物車中
    if (isset($_SESSION['cart'][$productId])) {
        // 如果已經在購物車中，增加其數量
        $_SESSION['cart'][$productId]++;
    } else {
        // 如果不在購物車中，添加進去並設數量為 1
        $_SESSION['cart'][$productId] = 1;
    }

    // 商品添加後重定向回商店頁面
    header('Location: index.php');
    exit();
} else {
    // 如果沒有商品 ID，顯示錯誤訊息
    echo "未指定商品 ID";
}
?>

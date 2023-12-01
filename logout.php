<?php
session_start(); // 啟動 session

// 清除所有 session 變數
$_SESSION = array();

// 銷毀 session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy(); // 銷毀 session

// 重定向到首頁
header("Location: index.php");
exit;
?>

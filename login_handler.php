<?php
session_start(); // 啟動 session

$userId = $_POST['user_id'];
$pwd = $_POST['pwd'];

$host = 'localhost'; // Database所在主機
$dbName = 'db_course'; // 資料庫名稱
$user = 'root'; // 連線帳號
$pass = ''; // 連線密碼
$dsn = "mysql:host=" . $host . ";dbname=" . $dbName;

try {
    $pdo = new PDO($dsn, $user, $pass);
    $query = "SELECT * FROM user WHERE user_id = :userId AND pwd = PASSWORD(:pwd)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':pwd', $pwd);
    $stmt->execute();

    if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // 存儲使用者資訊到 session
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['loggedin'] = true; // 標記使用者為已登入

        $message = $row['name'] . '您好，即將進入賣場...';
        $redirect = true;
    } else {
        $message = '帳號或密碼錯誤';
        $redirect = false;
    }
} catch (PDOException $ex) {
    $message = $ex->getMessage();
    $redirect = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登入結果</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .result-container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container result-container">
        <div class="alert alert-<?php echo $redirect ? 'success' : 'danger'; ?>" role="alert">
            <?php echo $message; ?>
        </div>
        <?php if ($redirect): ?>
            <script>
                setTimeout(function() {
                    window.location.href = 'index.php'; // 跳轉到首頁
                }, 3000); // 3秒後跳轉
            </script>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

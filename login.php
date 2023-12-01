<!DOCTYPE html>
<html lang="en">
<head>
    <title>登入</title>
    <meta charset="utf-8">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .login-form {
            width: 300px;
            margin: 50px auto;
        }
        .login-form form {
            margin-bottom: 15px;
            background: #f7f7f7;
            box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
            padding: 30px;
        }
        .login-form h2 {
            margin: 0 0 15px;
        }
    </style>
</head>
<body>
    <div class="login-form">
        <form action="login_handler.php" method="post">
            <h2 class="text-center">登入</h2>       
            <div class="form-group">
                <input type="text" class="form-control" name="user_id" placeholder="帳號" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="pwd" placeholder="密碼" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">登入</button>
            </div>       
        </form>
    </div>
</body>
</html>

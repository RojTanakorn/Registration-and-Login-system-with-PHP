<?php
    session_start();
    include 'server.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าล็อกอิน</title>
</head>
<body>
    <div class='login-container'>
        <div class='header'>
            <h2>ล็อกอิน</h2>
        </div>
        <form action="login_process.php" method='post'>
        <div class='form_group'>
                <label for="email">อีเมล์</label>
                <input type="email" name="email">
            </div>
            <div class='form_group'>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password">
            </div>
            <div class='form_group'>
                <button type="submit" name="login_user">เข้าสู่ระบบ</button>
                <p>หรือยังไม่มีบัญชี? <a href="register.php">ลงทะเบียน</a></p>
            </div>
        </form>

        <div>
            <?php include 'display_login_errors.php' ?>
        </div>
    </div>
</body>
</html>
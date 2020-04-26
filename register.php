<?php
    session_start();
    include 'server.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าลงทะเบียน</title>

    <link rel="stylesheet" type="text/css" 
    href='http://localhost/ENE463/Register_and_Login_System/style.css?ts=<?=time()?>' />
    <link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">
</head>
<body>
    <div class='container'>
        <div class='header'>
            <h2>ลงทะเบียน</h2>
        </div>
        <form action="register_process.php" method='post' autocomplete="on">
            <div class='form_group'>
                <label for="email">อีเมล์</label>
                <input type="email" name="email">
                <span class="filled_in_error">* </span>
            </div>
            <div class='form_group'>
                <label for="password">รหัสผ่าน</label>
                <input type="password" name="password">
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="password_confirm">ยืนยันรหัสผ่าน</label>
                <input type="password" name="password_confirm">
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="name">ชื่อ</label>
                <input type="text" name="name">
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="surname">นามสกุล</label>
                <input type="text" name="surname">
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="citizen_id">เลขบัตรประชาชน</label>
                <input type="text" name="citizen_id" maxlength="13" size="13" />
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="date_of_birth">วัน เดือน ปี เกิด</label>
                <input type="date" name="date_of_birth">
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <label for="address">ที่อยู่</label>
                <input type="text" name="address">
            </div>
            <div class='form_group'>
                <label for="tel">เบอร์ติดต่อ</label>
                <input type="text" name="tel" maxlength="10" size="10" />
                <span class='filled_in_error'>*</span>
            </div>
            <div class='form_group'>
                <button type="submit" name="reg_user">สมัครสมาชิก</button>
                <p>หรือมีบัญชีอยู่แล้ว? <a href="login.php">เข้าสู่ระบบ</a></p>
            </div>
        </form>

        <div>
            <?php include 'display_reg_errors.php' ?>
        </div>
    </div>
</body>
</html>
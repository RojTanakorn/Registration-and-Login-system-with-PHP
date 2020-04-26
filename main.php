<?php
    session_start();
    include 'server.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main</title>
</head>
<body>
    <h2>นี่คือหน้าหลัก</h2>
    <?php echo "เข้าสู่ระบบแล้ว! เลขไอดีของคุณคือ: ".$_SESSION['member_id']; ?>
</body>
</html>
<?php
    if (isset($_SESSION['empty_error'])) {
        echo "<p>".$_SESSION['empty_error']."</p>";
        unset($_SESSION['empty_error']);
    }

    if (isset($_SESSION['password_error'])) {
        echo "<p>".$_SESSION['password_error']."</p>";
        unset($_SESSION['password_error']);
    }

    if (isset($_SESSION['citizen_id_error'])) {
        echo "<p>".$_SESSION['citizen_id_error']."</p>";
        unset($_SESSION['citizen_id_error']);
    }

    if (isset($_SESSION['tel_error'])) {
        echo "<p>".$_SESSION['tel_error']."</p>";
        unset($_SESSION['tel_error']);
    }

    if (isset($_SESSION['duplicate_info_errors'])) {
        $duplicate_info_error_message = join(" ", $_SESSION['duplicate_info_errors']);
        echo "<p>".$duplicate_info_error_message." นี้มีอยู่ในระบบแล้ว</p>";
        unset($_SESSION['duplicate_info_errors']);
    }
?>
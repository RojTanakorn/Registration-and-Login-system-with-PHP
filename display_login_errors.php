<?php
    if (isset($_SESSION['empty_login_error'])) {
        echo "<p>".$_SESSION['empty_login_error']."</p>";
        unset($_SESSION['empty_login_error']);
    }

    if (isset($_SESSION['login_error'])) {
        echo "<p>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']);
    }
?>
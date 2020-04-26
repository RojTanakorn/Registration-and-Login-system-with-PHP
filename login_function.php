<?php
    session_start();
    include 'server.php';

    $email = $password = "";

    function login_process($conn) {
        get_login_info($conn);
        validate_login_info($conn);
    }

    function get_login_info($conn) {
        if (isset($_POST['login_user'])) {
            $GLOBALS['email'] = mysqli_real_escape_string($conn, $_POST['email']);
            $GLOBALS['password'] = mysqli_real_escape_string($conn, $_POST['password']);
        }  
    }

    function validate_login_info($conn) {
        global $email, $password;
        if(empty($email) or empty($password)) {
            $_SESSION['empty_login_error'] = "กรุณากรอกอีเมล์และรหัสผ่านให้ครบ";
            header("location: login.php");
        } else {
            $password = md5($password);
            $sql = "SELECT customer_id FROM CUSTOMER_DATA WHERE customer_email = '$email' AND customer_password = '$password'";
            $query = mysqli_query($conn, $sql);
            $result = mysqli_fetch_assoc($query);

            if (mysqli_num_rows($query) == 1) {
                $_SESSION['member_id'] = $result['customer_id'];
                header("location: main.php");
            } else {
                $_SESSION['login_error'] = "อีเมล์หรือรหัสผ่านไม่ถูกต้อง";
                header("location: login.php");
            }
        }
    }
?>
<?php
    session_start(); // Start session.
    include 'server.php'; // Connect to server.

    // Declare variable for get filled-in data from user.
    $email = $password = $password_confirm = $name = $surname = $citizen_id = $date_of_birth = $address = $tel = "";
    
    $duplicate_info_errors = array(); // Store array of KEY which make duplicate error, when check data in database.

    // Main function (1st Called function) of registration.
    function reg_process($conn) {
        get_reg_info($conn); //Get filled-in data from HTML form.
        
        validate_reg_info_from_form(); // Check appropriate filling in

        // if that is improper filling in, go back to register page for displaying errors to user.
        // else, continue validating filled-in information.
        if (isset($_SESSION['empty_error']) or isset($_SESSION['password_error']) or 
            isset($_SESSION['citizen_id_error']) or isset($_SESSION['tel_error'])) {
            header("location: register.php");
        } else {
            validate_reg_info_from_database($conn); // Check duplicated filled-in data from database.

            // If there is duplicate error, go back to register page for displaying error to user.
            // else, store filled-in data into database.
            if (isset($_SESSION['duplicate_info_errors'])) {
                header("location: register.php");
            } else {
                store_reg_info($conn);

                // Get member_id of new user to create session for login.
                //Then go to MAIN page.
                global $email;
                $query_member_id = "SELECT customer_id FROM CUSTOMER_DATA
                WHERE customer_email = '$email'";
                $query = mysqli_query($conn, $query_member_id);
                $result = mysqli_fetch_assoc($query);
                $_SESSION['member_id'] = $result['customer_id'];
                header("location: main.php");
            }
        }
    }

    // This function will receive filled-in user's information with POST method
    function get_reg_info($conn) {
        if(isset($_POST['reg_user'])) {
            // mysqli_real_escape_string is for preventing special character to store in SQL Database
            $GLOBALS['email'] = mysqli_real_escape_string($conn, $_POST['email']);
            $GLOBALS['password'] = mysqli_real_escape_string($conn, $_POST['password']);
            $GLOBALS['password_confirm'] = mysqli_real_escape_string($conn, $_POST['password_confirm']);
            $GLOBALS['name'] = mysqli_real_escape_string($conn, $_POST['name']);
            $GLOBALS['surname'] = mysqli_real_escape_string($conn, $_POST['surname']);
            $GLOBALS['citizen_id'] = mysqli_real_escape_string($conn, $_POST['citizen_id']);
            $GLOBALS['date_of_birth'] = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
            $GLOBALS['address'] = mysqli_real_escape_string($conn, $_POST['address']);
            $GLOBALS['tel'] = mysqli_real_escape_string($conn, $_POST['tel']);
        }
    }

    // This function will check about empty form or mismatched passwords, and display error
    function validate_reg_info_from_form() {

        // Check empty form. If required textboxes are empty, set session for displaying empty error.
        if(empty($GLOBALS['email']) or empty($GLOBALS['password']) or empty($GLOBALS['password_confirm']) or
            empty($GLOBALS['name']) or empty($GLOBALS['surname']) or empty($GLOBALS['citizen_id']) or
            empty($GLOBALS['date_of_birth']) or empty($GLOBALS['tel'])) {

                $_SESSION['empty_error'] = "กรุณากรอกข้อมูลที่มี * ให้ครบถ้วน"; 
        }

        // Check mismatch passwords. If mismatching, set session for displaying mismatched password error.
        if($GLOBALS['password'] != $GLOBALS['password_confirm']) {

            $_SESSION['password_error'] = "รหัสผ่านไม่ตรงกัน";
        } 

        // Check length of cutizen ID. If it is improper, set session for displaying error.
        if((strlen($GLOBALS['citizen_id']) > 0) and (strlen($GLOBALS['citizen_id']) < 13)) {

            $_SESSION['citizen_id_error'] = "เลขบัตรประชาชนไม่ถูกต้อง";
        }

        if((strlen($GLOBALS['tel']) > 0) and (strlen($GLOBALS['tel']) < 10)) {

            $_SESSION['tel_error'] = "เบอร์โทรศัพท์ไม่ถูกต้องหรือไม่ครบ";
        }
    }

    // This function will check about duplicated data comparing with database
    function validate_reg_info_from_database($conn) {
        // Query data from database, if filled-in data is matched.
        // Then, display which is similar to field in database.

        global $email, $name, $surname, $citizen_id, $duplicate_info_errors;

        $user_check_query = "SELECT customer_email, customer_name, customer_surname, customer_citizen_id FROM CUSTOMER_DATA
                            WHERE customer_email = '$email' OR 
                            (customer_name = '$name' AND customer_surname = '$surname') OR
                            customer_citizen_id = '$citizen_id'";

        $query = mysqli_query($conn, $user_check_query);
        $result = mysqli_fetch_assoc($query);

        if ($result) {
            if ($result['customer_email'] === $email) {
                array_push($duplicate_info_errors, "อีเมล์");
            }
            if ($result['customer_name'] === $name and $result['customer_surname'] === $surname) {
                array_push($duplicate_info_errors, "ชื่อ-นามสกุล");
            }
            if ($result['customer_citizen_id'] === $customer_citizen_id) {
                array_push($duplicate_info_errors, "เลขบัตรประชาชน");
            }

            // set duplicate_info error session.
            $_SESSION['duplicate_info_errors'] = $duplicate_info_errors;
        }
    }

    function store_reg_info($conn) {
        global $email, $password, $name, $surname, $citizen_id, $date_of_birth, $address, $tel;
        $password = md5($password);

        $sql = "INSERT INTO CUSTOMER_DATA (`customer_email`, `customer_password`, `customer_name`, `customer_surname`, 
                `customer_citizen_id`, `customer_dob`, `customer_address`, `customer_tel`, 
                `customer_point`, `customer_status`) 
                VALUES ('$email', '$password', '$name', '$surname', '$citizen_id', '$date_of_birth', '$address', '$tel', 0, 'N')";

        mysqli_query($conn, $sql);
    }
?>
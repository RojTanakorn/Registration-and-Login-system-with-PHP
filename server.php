<?php 
    $Hostname = "localhost";
    $Username = "root";
    $Pass = "";
    $Database = "ENE463";

    // Create Connection
    $conn = mysqli_connect($Hostname, $Username, $Pass, $Database);

    //Check Connection
    if(!$conn) {
        die("Connection Failed" . mysqli_connect_error());
    }
?>
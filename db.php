<?php
        $host = "localhost";
        $username ="root";
        $dbpassword = "";
        $dbName = "code_test";

        $conn = mysqli_connect($host, $username, $dbpassword,$dbName); //to connect with to the database which is alaajo
        if (!$conn) {//check if there is an error in connecting
            die("Connection failed: " . mysqli_connect_error()); //stops connection when error occurs
          }

?>
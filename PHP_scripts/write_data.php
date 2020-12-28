<?php

    // Prepare variables for database connection
   
    $dbusername = "testuser";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "testpass";  // enter database password, I used "arduinotest" in step 2.2
    $server = "www.test.com"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"

    // Connect to your database

    $dbconnect = mysql_pconnect($server, $dbusername, $dbpassword);
    $dbselect = mysql_select_db("dbaycom_monitor",$dbconnect);

    // Prepare the SQL statement

    $sql = "INSERT INTO dbaycom_monitor.temp (value) VALUES ('".$_GET["value"]."')";    

    // Execute SQL statement

    mysql_query($sql);

?>

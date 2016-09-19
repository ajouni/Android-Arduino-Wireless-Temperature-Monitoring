<?php

    // Prepare variables for database connection
   
    $dbusername = "dbaycom_ahmad";  // enter database username, I used "arduino" in step 2.2
    $dbpassword = "Mypass2016";  // enter database password, I used "arduinotest" in step 2.2
    $server = "www.2dbay.com"; // IMPORTANT: if you are using XAMPP enter "localhost", but if you have an online website enter its address, ie."www.yourwebsite.com"

    // Connect to your database

    $dbconnect = mysql_pconnect($server, $dbusername, $dbpassword);
    $dbselect = mysql_select_db("dbaycom_monitor",$dbconnect);

    // Prepare the SQL statement

    $sql = "INSERT INTO dbaycom_monitor.temp (value) VALUES ('".$_GET["value"]."')";    

    // Execute SQL statement

    mysql_query($sql);

?>
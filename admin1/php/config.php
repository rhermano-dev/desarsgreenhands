<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'desarsgr_admin');
   define('DB_PASSWORD', 'Des@rs_plants2020');
   define('DB_DATABASE', 'desarsgr_database');

  //$sql = new mysqli(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   
    //Check connection
    //if ($sql->connect_error) {
    //die("Connection failed: " . $sql->connect_error);
    //}
    //echo "Connected successfully";
    $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

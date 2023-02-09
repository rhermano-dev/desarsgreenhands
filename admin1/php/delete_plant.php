<?php

include("config.php");

$product_id = htmlspecialchars($_GET["id"]);

$sql_del_info = "DELETE FROM `plants_info` WHERE id = $product_id";
$sql_del_pictures = "DELETE FROM `plant_pictures` WHERE id = $product_id";

if(mysqli_query($db, $sql_del_info) && mysqli_query($db, $sql_del_pictures)){
    echo "Record deleted successfully.";
    header( "location: https://admin.desarsgreenhands.com/");
}
<?php

include("config.php");

$product_id = htmlspecialchars($_GET["id"]);

$sql_del_info = "UPDATE `plants_info` SET deleted = 1 WHERE id = $product_id";
$sql_del_pictures = "UPDATE `plant_pictures` SET deleted = 1 WHERE id = $product_id";

if(mysqli_query($db, $sql_del_info) && mysqli_query($db, $sql_del_pictures)){
    echo "Record deleted successfully.";
    header( "location: https://admin.desarsgreenhands.com/listplants.php");
}
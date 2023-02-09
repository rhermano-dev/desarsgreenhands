<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */

include("config.php");
//$link = mysqli_connect("localhost", "root", "", "demo");
 
// Check connection
// if($link === false){
//     die("ERROR: Could not connect. " . mysqli_connect_error());
// }

//Upload Images
$fileNames = $_FILES['files']['name'];
$tmpNames = $_FILES['files']['tmp_name'];
$fileTypes = $_FILES['files']['type'];
 
// Escape user inputs for security
$name = mysqli_real_escape_string($db, $_REQUEST['name_of_plant']);
$price = mysqli_real_escape_string($db, $_REQUEST['price_of_plant']);
$category = mysqli_real_escape_string($db, $_REQUEST['category_of_plant']);
$color = mysqli_real_escape_string($db, $_REQUEST['color_of_plant']);
$bloom = mysqli_real_escape_string($db, $_REQUEST['bloom_time_of_plant']);
$height = mysqli_real_escape_string($db, $_REQUEST['height_range_of_plant']);
$space = mysqli_real_escape_string($db, $_REQUEST['space_range_of_plant']);
$lowest = mysqli_real_escape_string($db, $_REQUEST['lowest_temperature_of_plant']);
$plant_light = mysqli_real_escape_string($db, $_REQUEST['plant_light_of_plant']);
$usda = mysqli_real_escape_string($db, $_REQUEST['usda_of_plant']);
$pest = mysqli_real_escape_string($db, $_REQUEST['pest_of_plant']);
$description = mysqli_real_escape_string($db, $_REQUEST['description_of_plant']);
// Attempt insert query execution
$sql = "INSERT INTO plants_info (name_of_plant, 
price_of_plant, 
type_of_plant,
color_of_plant,
bloom_time_of_plant,
height_range_of_plant,
space_range_of_plant,
lowest_temperature_of_plant,
plant_light_of_plant,
usda_of_plant,
pest_of_plant,
description_of_plant,
deleted,
date_registered) VALUES ('$name', '$price', '$category', '$color', '$bloom', '$height', '$space', '$lowest', '$plant_light', '$usda', '$pest', '$description', 'false', now())";

if(mysqli_query($db, $sql)){

    $query_last_id = "SELECT id FROM `plants_info` ORDER BY ID DESC LIMIT 1";
    $result_id = mysqli_query($db,$query_last_id) or die('Could not query');
    $row_last_id = $result_id->fetch_assoc();
    $last_id = $row_last_id['id'];
    
    for ($i = 0; $i <= count($tmpNames)-1; $i++)
    {
        $name = addslashes($fileNames[$i]);
        $tmp = addslashes(file_get_contents($tmpNames[$i]));
        $sql1 = "INSERT INTO plant_pictures (id,picture) VALUES ('$last_id','$tmp')";
        if(mysqli_query($db, $sql1)){
            echo "Record added successfully. Please wait to redirect you back to the list";

            // header("location: https://admin.desarsgreenhands.com/listplants.php");
            // header( "Refresh:5; url=https://admin.desarsgreenhands.com/listplants.php", true, 303);
            echo '<meta http-equiv="refresh" content="5;URL=\'https://admin.desarsgreenhands.com/listplants.php\'">';
        }
        else
        {
            echo "failed.";
        }
    }

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>

<?php

include("config.php");


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
$product_id = htmlspecialchars($_GET["id"]);

// Attempt update query execution
$sql = "UPDATE `plants_info` SET 
`name_of_plant`='$name',
`price_of_plant`='$price',
`type_of_plant`='$category', 
`color_of_plant`='$color',
`bloom_time_of_plant`='$bloom',
`height_range_of_plant`='$height',
`space_range_of_plant`='$space',
`lowest_temperature_of_plant`='$lowest',
`plant_light_of_plant`='$plant_light',
`usda_of_plant`='$usda',
`pest_of_plant`='$pest',
`description_of_plant`='$description'
WHERE id = $product_id";


if(mysqli_query($db, $sql)){
    echo "Record edited successfully. Please Wait To redirect you back to the list";
    echo '<meta http-equiv="refresh" content="5;URL=\'https://admin.desarsgreenhands.com/listplants.php\'">';
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Display status message 
echo $statusMsg; 
// Close connection
mysqli_close($link);
?>

<!-- 
$sql_del = "DELETE FROM `plant_pictures` WHERE id = $product_id";
for ($i = 0; $i <= count($tmpNames)-1; $i++)
    {
        $name = addslashes($fileNames[$i]);
        $tmp = addslashes(file_get_contents($tmpNames[$i]));
        $sql1 = "INSERT INTO plant_pictures (id,picture) VALUES ('$product_id','$tmp')";
        if(mysqli_query($db, $sql1)){
            echo "Record update successfully.";
        }
        else
        {
            echo "failed.";
        }
    } -->
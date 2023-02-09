<?php

include("config.php");


//Upload Images
 $fileNames = $_FILES['files']['name'];
 $tmpNames = $_FILES['files']['tmp_name'];
 $fileTypes = $_FILES['files']['type'];

// Escape user inputs for security
$name = mysqli_real_escape_string($db, $_REQUEST['name_of_plant']);
$category = mysqli_real_escape_string($db, $_REQUEST['category_of_plant']);
$price = mysqli_real_escape_string($db, $_REQUEST['price_of_plant']);
$description = mysqli_real_escape_string($db, $_REQUEST['description_of_plant']);
$product_id = htmlspecialchars($_GET["id"]);

// Attempt update query execution
$sql = "UPDATE `plants_info` SET 
`name_of_plant`='$name', 
`type_of_plant`='$category', 
`price_of_plant`='$price', 
`description_of_plant`='$description'
WHERE id = $product_id";

$sql_del = "DELETE FROM `plant_pictures` WHERE id = $product_id";
if(mysqli_query($db, $sql) && mysqli_query($db, $sql_del)){
    echo "Record update successfully.";

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
    }

} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

 
// Display status message 
echo $statusMsg; 
// Close connection
mysqli_close($link);
?>
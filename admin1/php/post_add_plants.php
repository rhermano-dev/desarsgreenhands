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
$category = mysqli_real_escape_string($db, $_REQUEST['category_of_plant']);
$price = mysqli_real_escape_string($db, $_REQUEST['price_of_plant']);
$description = mysqli_real_escape_string($db, $_REQUEST['description_of_plant']);
 
// Attempt insert query execution
$sql = "INSERT INTO plants_info (name_of_plant, price_of_plant, type_of_plant, description_of_plant) VALUES ('$name', '$price', '$category', '$description')";

if(mysqli_query($db, $sql)){
    echo "Records added successfully.";

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
 
// Close connection
mysqli_close($link);
?>
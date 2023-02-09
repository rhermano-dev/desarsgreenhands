<?php

include("config.php");


//Upload Images
 $fileNames = $_FILES['files']['name'];
 $tmpNames = $_FILES['files']['tmp_name'];
 $fileTypes = $_FILES['files']['type'];

// Escape user inputs for security
$product_id = htmlspecialchars($_GET["id"]);

$sql_del = "DELETE FROM `plant_pictures` WHERE id = $product_id";
if(mysqli_query($db, $sql_del)){
$ctr = 0;
for ($i = 0; $i <= count($tmpNames)-1; $i++)
    {
        $name = addslashes($fileNames[$i]);
        $tmp = addslashes(file_get_contents($tmpNames[$i]));
        $sql1 = "INSERT INTO plant_pictures (id,picture) VALUES ('$product_id','$tmp')";
        if(mysqli_query($db, $sql1)){
            $ctr++;
        }
        else
        {
            echo "failed.";
        }
    }
    if ($ctr-- == $i)
    {
        echo "Record edited successfully. Please wait to redirect you back to the list";
        echo '<meta http-equiv="refresh" content="5;URL=\'https://admin.desarsgreenhands.com/listplants.php\'">';
    }
}

 
// Display status message 
echo $statusMsg; 
// Close connection
mysqli_close($link);
?>

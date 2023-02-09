<?php
include("config.php");

$transaction_order_number = htmlspecialchars($_GET["id"]);
$aResult = array();
//$transaction_order_number =  $_POST['transactionOrderNumber'];
$sql_check_info = "UPDATE `transaction_orders` SET `checked` = 1, `checked_date` = now() WHERE transaction_order_number = '$transaction_order_number'";
if(mysqli_query($db, $sql_check_info)){
    echo "Record edited successfully. Please Wait To redirect you back to the list";
    echo '<meta http-equiv="refresh" content="5;URL=\'https://admin.desarsgreenhands.com/orders.php\'">';
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

// Display status message 
echo $statusMsg; 
// Close connection
mysqli_close($link);
?>
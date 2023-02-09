<?php

$myemail = "reynaldo.bronze8@gmail.com";//<—–Put Your email address here. 


// $name = $_POST['listOfProducts'];
// $array = "";
// foreach ($i = 0; $i < count($name); $i++) {
//     $array += $name[$i] + "&"; 
// }
$phone = $_POST['phone'];
$email = $_POST['email'];
// $listOfProducts = $_POST['listOfProducts'];
$listOfProducts = array("plant1", "plant2");
$name = $_POST['lastName'];
$we = "";
foreach ($listOfProducts as $item) {
    $we .= $item." ";
}

//  echo $we;

// $to = $myemail;


// $email_subject = "Contact form submission: aaaaa";

$email_body = "You have received a new message. ".

"Here are the details:\nName: $name \n".

"Phone Number: $phone \n".

"Email: $email\nMessage \n-------------------------\n $we";

$headers = "From: $myemail\n";

$headers .= "Reply-To: $email";

echo $email_body;

// mail($to,$email_subject,$email_body,$headers);

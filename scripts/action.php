<?php
header('Content-Type: application/json');
$rest_json = file_get_contents("php://input");
$_POST = json_decode($rest_json, true);

if(isset($_POST)) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "example@email.com";
 
    $email_subject = "Form Enquiry";
 
   
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    $firstName = $_POST['firstName'];
 
    $lastName = $_POST['lastName'];
 
    $email_from = $_POST['email'];
 
    $telephone = $_POST['telephone'];
 
    $startDate = substr($_POST['startDate'], 0, strpos($_POST['startDate'], "T"));
    $startDate = date('Y-m-d H:i:s', strtotime($startDate . ' + 1 day'));
    $startDate = str_replace(' 00:00:00', '', $startDate);

    $endDate = substr($_POST['endDate'], 0, strpos($_POST['endDate'], "T"));
    $endDate = date('Y-m-d H:i:s', strtotime($endDate . ' + 1 day'));
    $endDate = str_replace(' 00:00:00', '', $endDate);

    $totalDays = $_POST['totalDays'];

    $groupSize = $_POST['groupSize'];

    $mealType = $_POST['mealType'];

    $messageDetails = $_POST['message'];

    $percentage = number_format($_POST['percentage'], 2, '.', ',');

    $total = number_format($_POST['total'], 2, '.', ',');
 
    $email_message = "Form details below.\n\n";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
 
    $email_message .= "First Name: ".clean_string($firstName)."\n";
 
    $email_message .= "Last Name: ".clean_string($lastName)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Start Date: ".clean_string($startDate)."\n";

    $email_message .= "End Date: ".clean_string($endDate)."\n";

    $email_message .= "Total Days: ".clean_string($totalDays)."\n";

    $email_message .= "Group Size: ".clean_string($groupSize)."\n";

    $email_message .= "Meal Type: ".clean_string($mealType)."\n";

    $email_message .= "Message Details: ".clean_string($messageDetails)."\n";

    $email_message .= "Discount: $".clean_string($percentage)."\n";

    $email_message .= "Total: $".clean_string($total)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
/*----
Un-comment to enable email sending
----*/
// mail($email_to, $email_subject, $email_message, $headers); 
 
?>
{
    <!-- console degugger check to see if the form submitted correctly -->
    "success": true,
} 
 
<?php
 
} else {

?>   
{
    "success": false
} 

<?php
}


 
?>

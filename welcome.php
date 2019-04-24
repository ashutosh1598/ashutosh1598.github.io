<?php
if(!isset($_POST['submit']))
{
	echo "This page should not be accessed directly. Need to submit the form.\n\n";
	//echo "error. you need to submit the form!";
    exit;
}
$name = $_POST['first'];
$last = $_POST['last'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];
$color = $_POST['col'];
//Validate first
if(empty($name)||empty($visitor_email)) 
{
    echo "Name and email are mandatory!";
    exit;
}
if(  !preg_match("/^[a-zA-Z ]*$/",$name)  )
{
	echo "Only letters and spaces allowed in name";
	exit;
}
if(filter_var($email, FILTER_VALIDATE_EMAIL))
{
    echo "Bad email value!";
    exit;
}
if($color!="pink")
{
    echo "Wrong color";
    exit;
}

$email_from = 'kimsun1599@gmail.com';//<== update the email address
$email_subject = "New Form submission";
$email_body = "You have received a new message from the user $name with email $visitor_email.\n".
    "Here is the message:\n $message \n".
    
$to = "kimsun1598@gmail.com";//== update the email address
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
//Send the email!
mail($to,$email_subject,$email_body,$headers);
//done. redirect to thank-you page.
header('Location: thank-you.html');


// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 

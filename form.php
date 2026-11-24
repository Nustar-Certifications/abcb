 <?php 
 
if(isset($_POST['feedback']))
{
	$Subject = 'Feedback '; 
	$ToEmail = 'info@ab-cb.org';
	$me=$_POST['name'];
	$mailheader = 'From : '.$_POST['email'].'\r\n'; 
	$mailheader .= "Reply-To: ".$_POST["email"]."\r\n"; 
	$mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
	$MESSAGE_BODY .= "Name : ".$_POST["name"]."<br>"; 
    $MESSAGE_BODY .= "Mobile : ".$_POST["phone"]."<br>";
	$MESSAGE_BODY .= "Email : ".$_POST["email"]."<br>";
	$MESSAGE_BODY .= "Message : ".$_POST["comment"]."<br>";  
	//$MESSAGE_BODY .= "Message : ".nl2br($_POST["Message"])."<br>"; 

	mail($ToEmail, $Subject, $MESSAGE_BODY, $mailheader); 



echo "<script>alert('Thank You " .$me. " your message was sent')</script>";
echo "<script>window.location.href='feedback.html';</script>";
		 }
?>

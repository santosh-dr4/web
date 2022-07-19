<?php
include_once"../MPDF57/mpdf.php";
$mpdf=new mPDF();
$mpdf->SetTitle('Yeluguri');
//$mpdf->SetDisplayMode('fullpage');
$html="
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8'>
  
</head>
<div style='margin-top:5px;margin-bottom:15px;width:100%;'>
<div style='margin-bottom:70px;height:100px; text-align:center;'>
<img src='http://yeluguri.techieheal.com/img/yeluguri.png'style='margin-top:30px;'/>
</div>
</div>
		<div style='text-align:center;color:#0078D7;font-size:20px;'>BIRTHDAY</div>	
<div style='width:100%;'>	
	<table  style='border:2px solid #999999;width:100%;'>      
	 
        
	  <tr>
        <td>NAME</td>
        <td>$name</td>
      <td style='text-align:center;'>EMAIL</td>
        <td style='text-align:center;'>$email</td>
	  </tr>
      
		 <tr>
        <td>NUMBER</td>
        <td>$phno</td>
		<td style='text-align:center;'>REQUEST RECEIVED</td>
        <td style='text-align:center;'>$todaydate</td>
        </tr>
		
  </table>
</div>			
<table width=100%;>
    <tr>
<th colspan='2' style='width:100%;text-align:center;border:2px solid #999999;'>$eventname</th>
	  </tr>

	 
  </table>

<div style='width:100%;'>
	<div style='width:40%;float:left;'>
	  <table style='border-right:2px solid #999999;border-bottom:2px solid #999999;border-left:2px solid #999999;'>

   <tr>
        <td>Traditional Photographers</td>
        <td>$tp</td>
      </tr>
      <tr>
        <td>Traditional Videographers</td>
        <td>$tv</td>
             </tr>
      <tr>
        <td>Candid Photographers</td>
        <td>$cp</td>
        </tr>
		 <tr>
        <td>Cenimatic Videographers</td>
        <td>$cv</td>
        </tr>
<tr>
        <td>Crowd & Food Coverage Photographers</td>
        <td>$cfcp</td>
        </tr>
		<tr>
        <td>Crowd & Food Coverage Videographers</td>
        <td>$cfcv</td>
        </tr>
	</table>
	</div>
	<div style='width:30%;float:left;'>
<table style='border-bottom:2px solid #999999;margin-bottom:10px;'>
            <tr>
        <td>Jimmy Crane</td>
        <td>$jimmy</td>
        </tr>
		
		 <tr>
        <td>Fly Cameras</td>
        <td>$fly</td>
      </tr>
      <tr>
        <td>GoPro</td>
        <td>$Gopro</td>
             </tr>
      
		 <tr>
        <td>Instant Photo</td>
        <td>$instant</td>
        </tr>
				 <tr>
        <td>Steadicam</td>
        <td>$steadicam</td>
        </tr>
<tr>
        <td>Live streaming</td>
        <td>$live</td>
        </tr>
<tr>
        <td>City</td>
        <td>$City</td>
        </tr>

		
		 </table>
		 </div>
		 <div style='width:30%;float:left;'>

<table style='border-right:2px solid #999999;border-bottom:2px solid #999999;border-left:2px solid #999999;'>

  <tr> 
  <td>Album</td>
        <td>$album</td>
      </tr>
      <tr>
        <td>DVD</td>
        <td>$fullhd</td>
             </tr>
 <tr>
        <td>LED Screens</td>
        <td>$led</td>
        </tr>
		 <tr>
        <td>Starting Time</td>
        <td>$est</td>
        </tr>
<tr>
        <td>Ending Time</td>
        <td>$Eet</td>
        </tr>

		 <tr>
	   <td>starting date</td>
        <td>$esd</td>
      </tr>
      <tr>
        <td>Ending date</td>
        <td>$Eed</td>
             </tr>

 
  </table>
</div>

</div>
</body>
</html>
";
$mpdf->WriteHTML($html);
$mpdf->Output('new_event.pdf', 'I');
?>
<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output


// $mail->isSMTP();                                      // Set mailer to use SMTP
// $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'sandeepv1256@gmail.com';                 // SMTP username
// $mail->Password = 'letmein@1256';                           // SMTP password
// $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 25; 

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.sendgrid.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'sandeepv56';                 // SMTP username
$mail->Password = '08tk1a0405';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('v.sandeep@live.com', 'SANDEEP');
$mail->addAddress('sandeepv1256@gmail.com', 'Sandeep');     // Add a recipient
$mail->addAddress('vasuodela49@gmail.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');


$mail->AddAttachment('new_event.pdf', $name = 'new_event.pdf',  $encoding = 'base64', $type = 'application/pdf');
//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Yeluguri Bookings';
$mail->Body    = 'Welcome To Yeluguri Bookings';
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
?>
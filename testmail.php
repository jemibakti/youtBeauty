<?php
// The message
#$message = "Line 1\r\nLine 2\r\nLine 3";

// In case any of our lines are larger than 70 characters, we should use wordwrap()
#$message = wordwrap($message, 70, "\r\n");

// Send
#mail('rifky.nandiansyah@bni.co.id', 'My Subject', $message, null, 'admin@rookie46.com');

// Multiple recipients
$to = 'jhee.ananda@gmail.com'; // note the comma

// Subject
$subject = 'Registration at Rookie 46';

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
<p>Thank you for registering at <strong>Rookie46 : '.date("Y-m-dHis").'</strong>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Jemi <jhee.ananda@gmail.com>';
$headers[] = 'From: Rookie46 <admin@rookie46.com>';
#$headers[] = 'Cc: birthdayarchive@example.com';
#$headers[] = 'Bcc: birthdaycheck@example.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
?>
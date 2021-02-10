
<?php

// Cannot use mailers on BlueHost, so we write our own.

/**************************************************************************
MIT License

Copyright (c) 2021 Scott Auge

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
**************************************************************************/

class clsMailer {

  public $To;
  public $From;
  public $Subject;
  public $HTMLMessage;
  public $CC;
  public $BCC;
  
  function SendMail() {
	  
	  $headers[] = 'MIME-Version: 1.0';
	  $headers[] = 'Content-type: text/html; charset=iso-8859-1';
	  $headers[] = 'From: ' . $this->From;
	  $headers[] = 'Cc: ' . $this->CC;
	  $headers[] = 'Bcc: ' . $this->BCC;

	  mail($this->To, $this->Subject, $this->HTMLMessage, implode("\r\n", $headers));
  }
  
}

/****************************    HOW TO USE    *******************************

include "clsMailer.php";

$Mailer = new Mailer();

$Mailer->From = "scottauge@localhost";
$Mailer->To = "scottauge@localhost";
$Mailer->Subject = "Hi there!";
$Mailer->HTMLMessage = "<html><body>Scott <b>bold</b></body></html>";

$Mailer->SendMail();

******************************************************************************/

/*    From php.net

// Multiple recipients
$to = 'johny@example.com, sally@example.com'; // note the comma

// Subject
$subject = 'Birthday Reminders for August';

// Message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';

// Additional headers
$headers[] = 'To: Mary <mary@example.com>, Kelly <kelly@example.com>';
$headers[] = 'From: Birthday Reminder <birthday@example.com>';
$headers[] = 'Cc: birthdayarchive@example.com';
$headers[] = 'Bcc: birthdaycheck@example.com';

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));
*/
?>

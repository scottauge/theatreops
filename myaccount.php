<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/myaccount.php 31 2019-08-09 03:09:48Z scottauge $

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

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsLogins.php";


// To determine if the user should be here.  In the demo code,
// execute this, else not.  WARNING: CAN ONLY TEST IN LIVE ENVIRONMENT!

if ($_SERVER["SERVER_NAME"] == "demotheatre.amduus.com") {
 	include_once "incIsSuperUser.php";

	if (!IsSuperUser($_COOKIE["MailListLogin"])) {
		LoadScreen("restricted.php");
		return;
	} // if
} // if


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$Login = new clsLogins($DB);
$Login->FindByID($Session->SessionValue);  // Assuming still "Login"

// We denote a POST by $_POST["RecID"] <> ""

if ($_POST["RecID"] <> "") {
	$Login->UserID = $_POST["UserID"];
	$Login->Password = $_POST["Password"];
    $Login->EMail = $_POST["EMail"];
    $Login->Question1 = $_POST["Question1"];
    $Login->Answer1 = $_POST["Answer1"];
    $Login->Question2 = $_POST["Question2"];
    $Login->Answer2 = $_POST["Answer2"];
	$Login->Update();
}

?><!DOCTYPE html  "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - My Account</title>
</head>


<!--
$Id: myaccount.php 31 2019-08-09 03:09:48Z scottauge $
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


-->

<?php include_once "incMenu.php" ?>
<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<p align="center">Modify Your Account</p>
<form action="" method="post">
<input type="hidden" name="RecID" value="<?php print $Login->RecID ?>" />
<table align="center" width="70%">
  <tr>
    <td colspan="2"><hr />
      <p>If you wish your User ID or password changed, enter them below. You will need them to relogin to the system.</p><hr /></td>
    </tr>
  <tr>
    <td><div align="right">UserID</div></td>
    <td><input name="UserID" type="text" id="UserID" value="<?php print $Login->UserID ?>" /></td>
  </tr>
  <tr>
    <td><div align="right">Password</div></td>
    <td><input name="Password" type="password" id="Password" value="<?php print $Login->Password ?>" /></td>
  </tr>
  <tr>
    <td colspan="2"><hr />
      <p>Your email address could be used when a task is assigned to you. Other information important to users will be emailed here.</p>
<hr /></td>
    </tr>
  <tr>
    <td><div align="right">Email</div></td>
    <td><input name="EMail" type="text" id="EMail" size="60" maxlength="60" value="<?php print $Login->EMail ?>"/></td>
  </tr>
  <tr>
    <td colspan="2"><hr />
      <p>These questions will be asked of you should you forget your password/userid. If answered correctly, your User ID and password will be mailed to the Email address above.</p>
      <hr /></td>
    </tr>
  <tr>
    <td><div align="right">Question 1</div></td>
    <td><input name="Question1" type="text" id="Question1" size="60" maxlength="60" value="<?php print $Login->Question1 ?>"/></td>
  </tr>
  <tr>
    <td><div align="right">Answer 1</div></td>
    <td><input name="Answer1" type="text" id="Answer1" size="60" maxlength="60" /value="<?php print $Login->Answer1 ?>"></td>
  </tr>
  <tr>
    <td><div align="right">Question 2</div></td>
    <td><input name="Question2" type="text" id="Question2" size="60" maxlength="60" value="<?php print $Login->Question2 ?>"/></td>
  </tr>
  <tr>
    <td><div align="right">Answer 2</div></td>
    <td><input name="Answer2" type="text" id="Answer2" size="60" maxlength="60" value="<?php print $Login->Answer2 ?>"/></td>
  </tr>
  <?php
  if ($Login->IsSuperUser) {
  ?>
  <tr>
    <td colspan="2"><hr />
      <p>As a Superuser, you access to other peoples accounts. Click the account to change that account:      </p>
      <hr /></td>
    </tr>
  <tr>
    <td colspan="2"><p><a href="suaccount.php?RecID=New" target="_new">New</a></p></td>
  </tr>
    <?php
	$SQL = "SELECT RecID,UserID FROM Logins ORDER BY UserID DESC";
	$Results = $DB->Connection->query($SQL);
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
	  ?>
      <tr>
      <td colspan="2"><p><a href="suaccount.php?RecID=<?php print $Data["RecID"]; ?>" target="_new"><?php print $Data["UserID"]; ?></a></p></td>
      </tr>
      <?php
	} // while
  } // if IsSuperUser
  ?> 
</table>
<p>&nbsp;</p>
<p align="center">
  <input type="submit" name="button" id="button" value="Submit" />
</p>
</form>
<?php include "footer.php" ?>
</body>
</html>
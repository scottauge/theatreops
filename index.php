<?php

/* setcookie("MailListLogin", $S, 0, "/", $_SERVER['SERVER_NAME']); */
// I don't know what is going on, but the browser cannot have a cookie for one subdomain
// and another for another subdomain.  Seems the first to get the cookie wins with Firefox.
// setcookie("MailListLogin", $S, 0, "/", "amduus.com");
// This needs to be the first thing

//setcookie("MailListLogin", $S, 0, $_SERVER["SERVER_NAME"]);


include_once "nonotice.php";
include_once "clsUtil.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "incHelp.php";

$Session = new clsUtil();
$S = $Session->RandomString(50);



$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$FrontPageMessage = new clsParameter($DB);
$FrontPageMessage->FindByName("FrontPageMessage");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<script type="application/javascript">
// Seems some browsers/versions are freaking out over cookies sent in the HTTP header, so set it 
// via javascript.  Weakness, the browser must have javascript on or else the user cannot login

document.cookie="MailListLogin=<?php print $S ?>;domain=<?php print $_SERVER["SERVER_NAME"] ?>";
</script>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php  print($Parameter->Value); ?></title>
<link rel="stylesheet" href="theatre.css">
</head>

<!--
$Id: index.php 30 2019-08-09 02:56:34Z scottauge $
/**************************************************************************/
/*                                                                        */
/* AMDUUS INFORMATION WORKS, INC. CONFIDENTIAL                            */
/* ------------------                                                     */
/*                                                                        */
/*  Copyright 2018 Amduus Information Works Incorporated and Scott Auge   */
/*  All Rights Reserved.                                                  */
/*                                                                        */
/* NOTICE:  All information contained herein is, and remains              */
/* the property of Amduus Information Works Incorporated and its          */
/* suppliers, if any.  The intellectual and technical concepts contained  */
/* herein are proprietary to Amduus Information Works Incorporated        */
/* and its suppliers and may be covered by U.S. and Foreign Patents,      */
/* patents in process, and are protected by trade secret or copyright     */
/* law.  Dissemination of this information or reproduction of this        */
/* material is strictly forbidden unless prior written permission is      */
/* obtained from Amduus Information Works Incorporated or Scott Auge.     */
/**************************************************************************/


-->


<body>
<?php include_once "incAppTitle.php" ?>
<center>
<p><?php HelpLink("index") ?></p>
<form action="main.php" method="post">
<?php print ($FrontPageMessage->Value) ?>
<table width="50%" border="0">
  <tr>
    <td><div align="right" class="FormFace">UserID:</div></td>
    <td><input name="UserID" type="text" id="UserID" size="55" maxlength="55" /></td>
  </tr>
  <tr>
    <td><div align="right" class="FormFace">Password:</div></td>
    <td><input name="Password" type="Password" id="Password" size="55" maxlength="55" /></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="button" id="button" value="Login" />
    </div></td>
  </tr>
</table>
</form> 
<p>&nbsp;</p>
<p class="FormFace">This is tested with <a href="https://www.google.com/chrome/" target="_new">Chrome</a> and <a href="https://www.mozilla.org/en-US/firefox/new/" target="_new">Firefox</a>.</p>
<?php include "footer.php" ?>
<p>&nbsp;</p>
</center>


</body>
</html>

<!-- <?php print "Session is $S"; ?> -->

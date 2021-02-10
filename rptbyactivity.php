<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptbyactivity.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsActivity.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");
$Activity = new clsActivity($DB);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Report By Activity</title>
<link href="theatre.css" rel="stylesheet" type="text/css" />
</head>

<!--
$Id: rptbyactivity.php 31 2019-08-09 03:09:48Z scottauge $
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
<p align="center">List members by an activity they are interested in:</p>
<table align="center" width="85%">
<tr><td>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <p>
      <select name="SelectActivity" id="SelectActivity">
        <?php
  $SQL = "SELECT * FROM Activity";
  $Results = $DB->Connection->query($SQL);
	
  while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
  ?>
        <option value="<?php print $Data["RecID"]; ?>"><?php print $Data["Name"]; ?></option>
        <?php
  } // while ()
  ?>
      </select>
      <input type="submit" name="button" id="button" value="Submit" />
    </p>
    <hr />
  </div>
</form>
</td></tr></table>

<?php
if (isset($_REQUEST["SelectActivity"])) {
  $Activity->FindByID($_REQUEST["SelectActivity"]);
  ?>
  
  <p align="center">Results for <?php print $Activity->Name; ?></p>

  <div align="center">
    <table width="75%" border="1">
        
  <?php
  
  $SQL = "SELECT * FROM `ListToActivity`, MainList WHERE `ActivityRecID` = '"
  . $Activity->RecID .
  "' And MainList.RecID = ListToActivity.MainListRecID ";
  
  $Results = $DB->Connection->query($SQL);
	
  while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
  ?>

      <tr>
        <td><?php print $Data["Name"]; ?><br /><?php print $Data["Phone"]; ?><br /><?php print $Data["Email"]; ?> <?php print $Data["IM"]; ?> <?php print $Data["SocialNetwork"]; ?>
        </td>
      </tr>

  <?php
  } // while
  ?>
<?php
} // if
?>

      </table>
  </div>
<?php include "footer.php" ?>  
</body>
</html>
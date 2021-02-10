<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/updateactivity.php 31 2019-08-09 03:09:48Z scottauge $

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
<title><?php print($Parameter->Value)?> - Update Activity</title>
</head>


<!--
$Id: updateactivity.php 31 2019-08-09 03:09:48Z scottauge $
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


<?php include_once "incMenu.php" ?>
<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<p align="center">Update Activity</p>
<form action="updateactivity.php" method="post">
  <input type="hidden" value="<?php $Activity->RecID ?>" name="Activity" />
  <table width="50%" border="0" align="center">
    <tr>
      <td><div align="right">Name:</div></td>
      <td><input type="text" name="Name" value="<?php print $Activity->Name ?>" /></td>
    </tr>
  </table>
  <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
<?php include "footer.php" ?>
</body>
</html>
<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/searchactivity.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsActivity.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$BarColor = new clsParameter($DB);
$BarColor->FindByName("BarColor");

$Activity = new clsActivity($DB);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Search Activity</title>
</head>

<!--
$Id: searchactivity.php 31 2019-08-09 03:09:48Z scottauge $
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
<p align="center">Search Activity</p>
<form action="searchactivity.php" method="post">
<table width="50%" border="0" align="center" class="Listing">
  <tr>
    <td>Delete</td>
    <td>Activity Name</td>
  </tr>
  <?php
  $SQL = "SELECT * FROM Activity";
  $Results = $DB->Connection->query($SQL);
  // print $Results->num_rows;
  
  while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
	  
	  // If we are deleting, we don't want it showing up
	  // print "_POST[$Data[RecID]]:" . $_POST[$Data["RecID"]];
	  
	  if ($_POST[$Data["RecID"]] <> "") {
		  $Activity->FindByID($Data["RecID"]);
		  DeleteActivityChildren($Activity->RecID, $DB);
		  $Activity->Delete();
		  
		  continue;
	  }
	  
	  // Deal with row color
	  $RowColor == "" ? $RowColor = $BarColor->Value : $RowColor = "";
	
    ?>
    <tr bgcolor="<?php print ($RowColor) ?>">
      <td><input type="checkbox" name="<?php print $Data["RecID"] ?>" value="1" </td>
      <td><!-- <a href="updateactivity.php?activity=<?php print $Data["RecID"]?>"> --> <?php print($Data["Name"]) ?><!-- <a/> --></td>
    </tr>
    <?php
  } // while we have results
  ?>
</table>
<p align="center"><input type="submit" /></p>
</form>
<?php include "footer.php" ?>
</body>
</html>
<?php

function DeleteActivityChildren ($ActivityRecID, $DB) {
	
	$SQL = "DELETE FROM ListToActivity WHERE ActivityRecID = ?";
	$S = $DB->Connection->prepare($SQL);
    $S->bind_param("s", $ActivityRecID);
    $S->execute();
    $S->close();  
	
} // DeleteActivityChildren ()
?>

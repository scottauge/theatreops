<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/searchvendor.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsVendor.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$BarColor = new clsParameter($DB);
$BarColor->FindByName("BarColor");

// Handle the deleting of people
if ($_POST["Delete"] == "Delete") {

	$SQL = "SELECT * FROM Vendor WHERE CompanyName LIKE '%$SearchName%' order by CompanyName";
	
	$Results = $DB->Connection->query($SQL);
    // print $Results->num_rows;
  
    while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
		
		// echo $_POST[$Data["RecID"]] . "<br />";
		
		if ($_POST[$Data["RecID"]] == "on") {
			$Vendor = new clsVendor($DB);
			$Vendor->FindByID($Data["RecID"]);
			$Vendor->Delete();
		}
		
	} // while
	
} // Deleting


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value) ?> - Search Vendor</title>
</head>

<!--
$Id: searchvendor.php 31 2019-08-09 03:09:48Z scottauge $
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


<?php include "incMenu.php" ?>

<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>

<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table align="center" width="80%" border="0">
    <tr><td>
    <p align="center">Search Criteria</p>
    </td></tr>
      <tr align="center">
        <td align="right">Vendor Name:</td>
        <td align="left"><input name="SearchName" type="text" id="textfield" size="60" maxlength="60" /></td>
      </tr>
    </table>
    <p align="center">
      <input type="submit" name="button" id="button" value="Submit" />
    </p>
    <hr width="80%" align="center"/>
  </div>
</form>
<p>&nbsp;</p>
<form id="form2" name="form2" method="post" action="">
<div align="center">
  <table width="50%" border="0">
    <tr>
      <td align="center">Delete</td>
      <td>Name</td>
      <td>&nbsp;</td>
    </tr>
    
    <?php
	$SQL = "SELECT * FROM Vendor WHERE CompanyName LIKE '%$SearchName%' order by CompanyName";
	
	$Results = $DB->Connection->query($SQL);
    // print $Results->num_rows;
  
    while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
		
	// Deal with row color
	$RowColor == "" ? $RowColor = $BarColor->Value : $RowColor = "";
	?>
    
    <tr bgcolor="<?php echo $RowColor ?>">
      <td align="center"><input type="checkbox" name="<?php print $Data["RecID"] ?>" id="<?php print $Data["RecID"] ?>" /></td>
      <td><a href="updatevendor.php?RecID=<?php print $Data["RecID"] ?>"><?php print $Data["CompanyName"] ?></a></td>
    </tr>
    
    <?php
	
	} // while()
	?>

  </table>
</div>
    <p align="center">
      <input type="submit" name="Delete" id="Delete" value="Delete" />
    </p>
<p>&nbsp;</p>
</form>
<?php include "footer.php" ?>
</body>
</html>
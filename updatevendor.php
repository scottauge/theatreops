<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/updatevendor.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsVendor.php";
include_once "incHelp.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$Vendor = new clsVendor($DB);

$RecID = $_REQUEST["RecID"];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value) ?> - Update Vendor</title>
</head>


<!--
$Id: updatevendor.php 31 2019-08-09 03:09:48Z scottauge $
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

<?php include "incMenu.php" ?>

<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<?php HelpLink("newvendor") ?>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php 
$Vendor->FindByID($_REQUEST["RecID"]);

$HasUserData = $_POST["CompanyName"]
           . $_POST["ContactEmail"]
		   . $_POST["Address1"];


// We've got an ID and password and user information.  Look up the record
// and update... if not available, then create and update.

if ($HasUserData <> "") {
	
	$Vendor->CompanyName = $_POST["CompanyName"];
	$Vendor->Address1 = $_POST["Address1"];
	$Vendor->Address2 = $_POST["Address2"];
	$Vendor->City = $_POST["City"];
	$Vendor->State = $_POST["State"];
	$Vendor->Zip = $_POST["Zip"];
	$Vendor->ContactPhone = $_POST["ContactPhone"];
	$Vendor->ContactName = $_POST["ContactName"];
	$Vendor->ContactEmail = $_POST["ContactEmail"]; 
	$Vendor->Note = $_POST["Note"]; 
	
	$Vendor->Update();
	
	
	print "<p align=\"center\">Created " . $Vendor->CompanyName . "</p>";	
}

?>


<form id="form1" name="form1" method="post" action=""  >
	<input type="hidden" value="<?php print ($_REQUEST["RecID"]) ?>" name="VendorRecID" id="VendorRecID" />
  <div align="center">
    <table width="50%" border="0">
      <tr>
        <td><div align="right">Company Name:</div></td>
        <td><input type="text" maxlength="60" name="CompanyName" id="CompanyName" value="<?php print $Vendor->CompanyName; ?>" /></td>
      </tr>
      <tr>
        <td><div align="right">Address1:</div></td>
        <td><input type="text" maxlength="60" name="Address1" id="Address1" value="<?php print $Vendor->Address1; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Address2:</div></td>
        <td><input type="text" maxlength="60" name="Address2" id="Address2" value="<?php print $Vendor->Address2; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">City:</div></td>
        <td><input type="text" maxlength="60" name="City" id="City" value="<?php print $Vendor->City; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">State:</div></td>
        <td><input type="text" maxlength="4" name="State" id="State" value="<?php print $Vendor->State; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Zip:</div></td>
        <td><input type="text" maxlength="10" name="Zip" id="Zip" value="<?php print $Vendor->Zip; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Contact Name:</div></td>
        <td><input type="text" maxlength="60" name="ContactName" id="ContactName" value="<?php print $Vendor->ContactName; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Contact Email:</div></td>
        <td><input type="text" maxlength="60" name="ContactEmail" id="ContactEmail" value="<?php print $Vendor->ContactEmail; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Contact Phone:</div></td>
        <td><input type="text" maxlength="60" name="ContactPhone" id="ContactPhone" value="<?php print $Vendor->ContactPhone; ?>"/></td>
      </tr>
    </table>
  </div>
  <p align="center">Other information you would like us to know (additional internet contact methods, etc.)</p>
  <p align="center">
    <textarea name="Note" id="Note" cols="45" rows="5" ><?php print $Vendor->Note; ?></textarea>
  </p>

  <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
<?php include "footer.php" ?>
</body>
</html>
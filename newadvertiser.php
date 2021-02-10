<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/newadvertiser.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";

include_once "clsAdvertisers.php";
include_once "clsContact.php";
include_once "clsAdvertiserSale.php";
include_once "clsNotes.php";

include_once "sqltous.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$User = new clsLogins($DB);
$User->FindByID($Session->SessionValue);


// Determine if we have needed info

if (isset($_REQUEST["CompanyName"]) && $_REQUEST["CompanyName"] != "") {
	
	$Advertisers = new clsAdvertisers($DB);
	$Advertisers->Create();
	
	$Advertisers->AdvertiserName = $_REQUEST['CompanyName'];
	$Advertisers->Address1 = $_REQUEST['Address1'];
	$Advertisers->Address2 = $_REQUEST['Address2'];
 	$Advertisers->City = $_REQUEST['City'];
 	$Advertisers->State = $_REQUEST['State'];
	$Advertisers->Zip = $_REQUEST['Zip'];
	$Advertisers->Note = $_REQUEST['AdvertisersNote'];
	$Advertisers->ContactName = $_REQUEST['MainContactName'];
	$Advertisers->ContactPhone = $_REQUEST['MainContactPhone'];
	$Advertisers->ContactEmail = $_REQUEST['MainContactEmail'];
	
	$Advertisers->Update();
	
	
	// Determine if we have a new contact
	
	if ($_REQUEST['ContactFullName'] != "") {
		
		$Contact = new clsContact($DB);
		$Contact->Create();
		
		$Contact->ContactName = $_REQUEST["ContactFullName"];
		$Contact->Phone = $_REQUEST["ContactPhone"];
		$Contact->Email = $_REQUEST["ContactEMail"];
		$Contact->RelationRecID = $Advertisers->RecID;
		$Contact->RelationTable = "Advertisers";		
		
		$Contact->Update();
		
	}
	
	
	// Determine if we have a new sale
	
	if ($_REQUEST['AdSaleNote'] != "") {
		
		$AdvertiserSale = new clsAdvertiserSale($DB);
		$AdvertiserSale->Create();
		
		$AdvertiserSale->AdvertisersRecID = $Advertisers->RecID;
		$AdvertiserSale->StartDate = ustosql($_REQUEST["AdSaleStartDate"]);
		$AdvertiserSale->EndDate = ustosql($_REQUEST["AdSaleEndDate"]);
		$AdvertiserSale->Amount = $_REQUEST["AdSaleAmount"];
		$AdvertiserSale->Note = $_REQUEST["AdSaleNote"];
		
		$AdvertiserSale->Update();
		
	}
	
	
	// Determine if we have a new interaction
	
	if ($_REQUEST['Interactions'] != "") {
		
		$Note = new clsNotes($DB);
		$Note->Create();
		
		$Note->RelationTable = "Advertisers";
		$Note->RelationRecID = $Advertisers->RecID;
		$Note->Text = $_REQUEST["Interactions"];

		$Note->Update();
		
	}
	
		
} // if ($_REQUEST["CompanyName"] != "")
	

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value) ?> - New Advertiser</title>
</head>

<!--
$Id: newadvertiser.php 31 2019-08-09 03:09:48Z scottauge $
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
<br /><form action="">
  <p align="center"><br />
  <strong>Company Information </strong> </p>
  <table width="80%" border="0" align="center">
    <tr>
    <td align="right">Company Name</td>
    <td><input type="text" name="CompanyName" id="CompanyName" /></td>
  </tr>
  <tr>
    <td align="right">Address 1</td>
    <td><input type="text" name="Address1" id="Address1" /></td>
  </tr>
  <tr>
    <td align="right">Address 2</td>
    <td><input type="text" name="Address2" id="Address2" /></td>
  </tr>
  <tr>
    <td align="right">City</td>
    <td><input type="text" name="City" id="City" /></td>
  </tr>
  <tr>
    <td align="right">State</td>
    <td><input type="text" name="State" id="State" /></td>
  </tr>
  <tr>
    <td align="right">Zip</td>
    <td><input type="text" name="Zip" id="Zip" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p>General Note:</p>
      <p>
        <textarea name="AdvertisersNote" id="AdvertisersNote" cols="45" rows="5"></textarea>
      </p>
      <p><strong>Main Contact (Letters &amp; EMail)</strong></p></td>
  </tr>
  <tr>
    <td align="right">Contact Name</td>
    <td><input type="text" name="MainContactName" id="MainContactName" /></td>
  </tr>
  <tr>
    <td align="right">Contact Phone</td>
    <td><input type="text" name="MainContactPhone" id="MainContactPhone" /></td>
  </tr>
  <tr>
    <td align="right">Contact EMail</td>
    <td><input type="text" name="MainContactEmail" id="MainContactEmail" /></td>
  </tr>
  </table>
<p align="center"><strong>Other Contact Information</strong></p>
<hr width="50%" />
<table width="80%" border="0" align="center">
  <tr>
    <td>Full Name</td>
    <td><input type="text" name="ContactFullName" id="ContactFullName" /></td>
    <td>Phone</td>
    <td><input type="text" name="ContactPhone" id="ContactPhone" /></td>
    <td>Email</td>
    <td><input type="text" name="ContactEMail" id="ContactEMail" /></td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center"><strong>Sales Information</strong></p>
<hr width="50%"/>
<table width="80%" border="0" align="center">
  <tr>
    <td>Start Date</td>
    <td><input type="text" name="AdSaleStartDate" id="AdSaleStartDate" /></td>
    <td>End Date</td>
    <td><input type="text" name="AdSaleEndDate" id="AdSaleEndDate" /></td>
    <td>Amount</td>
    <td><input type="text" name="AdSaleAmount" id="AdSaleAmount" /></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><p>Note:</p>
      <p>
        <textarea name="AdSaleNote" id="AdSaleNote" cols="70" rows="5"></textarea>
      </p></td>
    </tr>
</table>
<p>&nbsp;</p>
<p align="center"><strong>Interactions</strong></p>
<hr width="50%" />
<p>&nbsp;</p>
<p align="center">
  <textarea name="Interactions" id="Interactions" cols="70" rows="5"></textarea>
</p>
<p>&nbsp;</p>
<p align="center">
  <input type="submit" name="button" id="button" value="Submit" />
</p>
<p>&nbsp;</p>
</form>
<?php include "footer.php" ?>
</body>
</html>
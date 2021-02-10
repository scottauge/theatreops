<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/newpeople.php 31 2019-08-09 03:09:48Z scottauge $

include_once "clsUtil.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsMainList.php";
include_once "clsNotes.php";
include_once "incActivities.php";
include_once "clsListToActivity.php";
include_once "clsNotes.php";
include_once "incMembership.php";
include_once "clsMembership.php";
include_once "sqltous.php";
include_once "incHelp.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);

$ListToActivity = new clsListToActivity($DB);

$Person = new clsMainList($DB);
$Note = new clsNotes($DB);

$Parameter->FindByName("title");

$Notes = new clsNotes($DB);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - New Person</title>
</head>


<!--
$Id: newpeople.php 31 2019-08-09 03:09:48Z scottauge $
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
<?php HelpLink("enterpeople") ?>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php 

$HasUserData = $_POST["Name"]
           . $_POST["Email"]
		   . $_POST["Address1"];


// We've got an ID and password and user information.  Look up the record
// and update... if not available, then create and update.

if ($HasUserData <> "") {
	//  print "Create or update a record<br>";
	
	$Person->FindByUserIDPassword($_POST["UserID"], $_POST["Password"]);
	
	if ( ! $Person->Available()) {
		$Person->Create();
		// print "Created<br>";
	}
	
	
	
	// For some reason $Person->Name will not accept the $_POST["Name"]
	// So putting it into a variable and assigning that way.  Makes no
	// sense.
	
	$Name = $_POST["Name"];
	$Person->Name = $Name;
	
	$Person->Address1 = $_POST["Address1"];
	$Person->Address2 = $_POST["Address2"];
	$Person->City = $_POST["City"];
	$Person->State = $_POST["State"];
	$Person->Zip = $_POST["Zip"];
	$Person->Email = $_POST["Email"];
	$Person->Phone = $_POST["Phone"];
	$Person->IM = $_POST["IM"];
	$Person->SocialNetwork = $_POST["SocialNetwork"]; 
	
	$Person->PersonalUserID = $_POST["UserID"];
	$Person->PersonalPassword = $_POST["Password"];
	
	$Person->Update();
	
	
	
	// Here we set the activity to user connections for what is
	// interesting
	
	$SQL = "SELECT * FROM Activity";
	$Results = $DB->Connection->query($SQL);
	
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 
	
	  // If the value is one, it is checked. Determine if we have a Activity
	  // to User already defined.  If we don't, define one.
	  
	  if ($_POST[$Data["RecID"]] == 1) 
	    $ListToActivity->LinkActivityToUser($Data["RecID"], $Person->RecID);

		
      // Otherwise, if it is not checked, we want to insure there is no
	  // User to Activity
		
	  else 
		$ListToActivity->UnlinkActivityToUser($Data["RecID"], $Person->RecID);
		
	} // while ()
	
	
	
	// Here we determine if the Notes area has a record and if not, make one
	// and populate it.
	
	// $Notes->FindByID("1530573709uJ0Zk5h1ATsNngHgvioRUHfBEkGTNzPA6LruSf6y");
	$Notes->FindByTableID("MainList", $Person->RecID);
	
	if ( ! $Notes->Available()) {
		//print "Notes NOT AVAILABLE!<br>";
		$Notes->Create();
		$Notes->RelationTable = "MainList";
		$Notes->RelationRecID = $Person->RecID;
		//print $Notes->RelationRecID;
		//print "Main RecID: " . $Notes->RecID;
		//print "RelationTable: " . $Notes->RelationTable;
	}
	
	$Notes->Text = $_POST["Note"];
	$Notes->Update();
	
	// print "Notes updated<br>" . $_POST["Note"] . ":" . $Notes->Text;
	
	// Handle Membership info if it exists (some places don't charge)
	// Find these input names in incMembership.php
	
	/*
	echo "Test:" . $_REQUEST["MembershipStartDate"]
	     . " " . $_REQUEST["MembershipEndDate"]
	     . " " . $_REQUEST["MembershipPayment"]
		 . " " . $Person->RecID;
	*/
	
	if (isset($_REQUEST["MembershipEndDate"]) && isset($_REQUEST["MembershipPayment"])) {
		
		$Membership = new clsMembership($DB);
		$Membership->Create();
		$Membership->StartDate = ustosql($_REQUEST["MembershipStartDate"]);
		$Membership->EndDate = ustosql($_REQUEST["MembershipEndDate"]);
		$Membership->Payment = $_REQUEST["MembershipPayment"];
		$Membership->MainListRecID = $Person->RecID;	
		$Membership->Update();
			
	}

	print "<p align=\"center\">Created " . $Person->Name . "</p>";	
}

else {
	// AlertBox("New Page");
}

//print "Result:" . $IsLookup . $HasUserData;

?>


<form id="form1" name="form1" method="post" action=""  >
  <div align="center">
    <table width="50%" border="0">
      <tr>
        <td><div align="right">Name:</div></td>
        <td><input type="text" maxlength="60" name="Name" id="Name" value="<?php print $Person->Name; ?>" /></td>
      </tr>
      <tr>
        <td><div align="right">Address1:</div></td>
        <td><input type="text" maxlength="60" name="Address1" id="Address1" value="<?php print $Person->Address1; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Address2:</div></td>
        <td><input type="text" maxlength="60" name="Address2" id="Address2" value="<?php print $Person->Address2; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">City:</div></td>
        <td><input type="text" maxlength="60" name="City" id="City" value="<?php print $Person->City; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">State:</div></td>
        <td><input type="text" maxlength="4" name="State" id="State" value="<?php print $Person->State; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Zip:</div></td>
        <td><input type="text" maxlength="10" name="Zip" id="Zip" value="<?php print $Person->Zip; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Email:</div></td>
        <td><input type="text" maxlength="60" name="Email" id="Email" value="<?php print $Person->Email; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Social Network:</div></td>
        <td><input type="text" maxlength="60" name="SocialNetwork" id="SocialNetwork" value="<?php print $Person->SocialNetwork; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">Phone:</div></td>
        <td><input type="text" maxlength="60" name="Phone" id="Phone" value="<?php print $Person->Phone; ?>"/></td>
      </tr>
      <tr>
        <td><div align="right">IM:</div></td>
        <td><input type="text" maxlength="60" name="IM" id="IM" value="<?php print $Person->IM; ?>"/></td>
      </tr>
    </table>
  </div>
  <p align="center">Other information you would like us to know (additional internet contact methods, etc.)</p>
  <p align="center">
    <textarea name="Note" id="Note" cols="45" rows="5" ><?php print $Notes->Text; ?></textarea>
  </p>
  
  <?php DisplayActivities($Person->RecID, $DB); ?>
  <?php DisplayMembership($Person->RecID, $DB, "yes", "no"); ?>
  
  <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
<?php include "footer.php" ?>
</body>
</html>
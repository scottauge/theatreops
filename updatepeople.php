<?php
// $Header: file:///Users/scottauge/Documents/SVN/theatre/updatepeople.php 31 2019-08-09 03:09:48Z scottauge $

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
$Notes = new clsNotes($DB);

$Parameter->FindByName("title");


$RecID = $_REQUEST["RecID"];

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Update Person</title>
</head>

<!--
$Id: updatepeople.php 31 2019-08-09 03:09:48Z scottauge $
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
<?php HelpLink("enterpeople") ?>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php 


// We've got an ID and password and user information.  Look up the record
// and update... if not available, then nothing.

$Person->FindByID($RecID);
	
// print "RecID: " . $RecID;

$Notes->FindByTableID("MainList", $Person->RecID);
	
	// For some reason $Person->Name will not accept the $_POST["Name"]
	// So putting it into a variable and assigning that way.  Makes no
	// sense.
if ($_POST["Name"] <> "") {	

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

    // Here we delete Memberships
	
	$SQL = "SELECT * FROM Membership WHERE MainListRecID = '" 
	     . $Person->RecID 
		 . "'";
	$Results = $DB->Connection->query($SQL);
	
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
		
		if ($_REQUEST[$Data["RecID"]] == "yes") {
			$Membership->FindByID($Data["RecID"]);
			$Membership->Delete();
		} // if
		
	} // while
		
	print "<p align=\"center\">Updated " . $Person->Name . "</p>";	
}

else {
	
}

//print "Result:" . $IsLookup . $HasUserData;

?>


<form id="form1" name="form1" method="post" action=""  >
  <input type="hidden" name="RecID" value="<?php print $RecID ?>" />
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
  <?php DisplayMembership($Person->RecID, $DB, "yes", "yes"); ?>
  
  <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
<?php include "footer.php" ?>
</body>
</html>
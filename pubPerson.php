<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/pubPerson.php 2 2019-06-20 18:03:22Z scottauge $

include_once "clsUtil.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsMainList.php";
include_once "clsNotes.php";
include_once "incActivities.php";
include_once "clsListToActivity.php";
include_once "clsNotes.php";

//$Session = new clsUtil();
//$S = $Session->RandomString(50);
//setcookie("MailListLogin", $S);

$DB = new clsDB();
$Parameter = new clsParameter($DB);

$ListToActivity = new clsListToActivity($DB);

$Person = new clsMainList($DB);
$Note = new clsNotes($DB);

$Parameter->FindByName("title");

$Notes = new clsNotes($DB);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php  print($Parameter->Value); ?></title>
</head>


<!--
$Id: pubPerson.php 2 2019-06-20 18:03:22Z scottauge $
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

<?php
$Parameter->FindByName("Organization");
?>
<body>
<h1 align="center"><?php print($Parameter->Value) ?></h1>
<p>&nbsp;</p>


<?php

// Determine if adding a record or doing an update.  Have a user id and password
// but nothing else?  Look up.  Otherwise creating something.

$IsLookup = $_POST["UserID"] . $_POST["Password"];

$HasUserData = $_POST["Name"]
           . $_POST["Email"]
		   . $_POST["Address1"];

// AlertBox($_POST["Name"] . " "
//           . $_POST["UserID"] . $_POST["Password"]);

// We've got an ID and password, but no information.  Look up
// the user by their userid and password for pre-filling the
// user data screen.

if ($IsLookup <> "" && $HasUserData == "") {
	// print "Look up a record";
	
	$Person->FindByUserIDPassword($_POST["UserID"], $_POST["Password"]);
		
}

// We've got an ID and password and user information.  Look up the record
// and update... if not available, then create and update.

else if ($IsLookup <> "" && $HasUserData <> "") {
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
	
}

else {
	// AlertBox("New Page");
}

//print "Result:" . $IsLookup . $HasUserData;

?>

<table width="50%" border="0" align="center">
  <tr>
    <td><p>This is where you can add or update your information by interacting with our system of record directly.</p>
    <p>Be sure to set your password and user id and write them down, you will need that to go into your information again!</p>
    <p>Entry into this system does NOT make you a member, but letting the theatre staff and committee chairpersons know that you are interested in the helping out.</p>
    <p><strong>THIS INFORMATION WILL NOT BE SHARED EXCEPT FOR THEATER PLANNED EVENTS.</strong></p></td>
  </tr>
</table>
<p>&nbsp;</p>
<form id="form1" name="form1" method="post" action="pubPerson.php"  >
  <p align="center">If you already have a user id and password, enter those alone to bring up your information.</p>
  <div align="center">
    <table width="50%" border="0" align="center">
      <tr>
        <td width="37%"><div align="right">User ID:</div></td>
        <td width="63%"><input maxlength="60" type="text" name="UserID" id="UserID" value="<?php print $Person->PersonalUserID; ?>" /></td>
      </tr>
      <tr>
        <td><div align="right">Password:</div></td>
          <td><input maxlength="60" type="password" name="Password" id="Password" value="<?php print $Person->PersonalPassword; ?>"></td>
          </tr>
          </table>
          
           <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
  <p align="center">&nbsp;</p>
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
  
  <p align="center">
    <input type="submit" name="button" id="button" value="Submit" />
  </p>
</form>
<p align="center"><a href="whoarewe.html" target="_blank">Who is Amduus Information Works, Inc?</a></p>
</body>
</html>
<?php



function AlertBox ($Message) {
	print "<script language=\"javascript\">window.alert(\""
	      . $Message
		  . "\");"
		  . "</script>";
} // AlertBox ()











?>
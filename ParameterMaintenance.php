<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/ParameterMaintenance.php 31 2019-08-09 03:09:48Z scottauge $

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsDB.php";
include_once "clsParameter.php";



// To determine if the user should be here

include_once "incIsSuperUser.php";

if (!IsSuperUser($_COOKIE["MailListLogin"])) {
	LoadScreen("restricted.php");
	return;
}



$DB = new clsDB();
$Parameter = new clsParameter($DB);


// If we any result, we need to update
//echo $_SERVER['REQUEST_METHOD'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
	//print_r($_REQUEST);
	
	// First the existing
	
	$SQL = "select * from Parameter";
	
	$Results = $DB->Connection->query($SQL);

	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
		
		// Are we deleting this?
		
		// print "Checking Deletes " . $Data["RecID"] . "<br>";
		
		$Arg = $Data["RecID"] . "_Delete";
		if ($_REQUEST[$Arg] == 1) {
			
			$Parameter->FindByID($Data["RecID"]);
			$Parameter->Delete();
			
		}
		
		// Are we updating this?
		
		//print "Checking updates<br>";
		
		$Parameter->FindByID($Data["RecID"]);
		$Parameter->Name = $_REQUEST[$Data["RecID"] . "_Name"];
		$Parameter->Value =  $_REQUEST[$Data["RecID"] . "_Value"];
		$Parameter->Update();
		
	} // while ($Data = $Results->fetch_array(MYSQLI_ASSOC))
	
	// Now if News have been added
	//echo "New.Name:" . $_REQUEST["New_Name"];
	if ($_REQUEST["New_Name"] != "") {
		
		// echo "Creating...";
		
		$Parameter->Create();
		$Parameter->Name = $_REQUEST["New_Name"];
		$Parameter->Value = $_REQUEST["New_Value"];
		$Parameter->Update();
		
	} // if (isset($_REQUEST["New.Name"]))
	
} // if ($_SERVER['REQUEST_METHOD'] === 'POST')


?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Parameter Maintenance</title>
</head>

<!--
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
<body class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>

<p></p>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="80%" border="0">
      <tr>
        <td>Delete</td>
        <td>Name</td>
        <td>Value</td>
      </tr>
      <tr>
        <td valign="top"><div align="center">New</div></td>
        <td valign="top"><input type="text" name="New_Name" id="New_Name"></td>
        <td><textarea name="New_Value" id="New_Value" cols="60" rows="3"></textarea></td>
      </tr>
    <?php
	
	$SQL = "select * from Parameter order by Name";
	
	$Results = $DB->Connection->query($SQL);

	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
				
	?>
      <tr>
        <td valign="top"><div align="center">
          <input name="<?php print $Data["RecID"] . "_Delete"; ?>" type="checkbox" id="<?php print $Data["RecID"] . "_Delete"; ?>" value="1" />
        </div></td>
        <td valign="top"><input type="text" name="<?php print $Data["RecID"] . "_Name"?>" value="<?php print $Data["Name"] ?>" /></td>
        <td><textarea name="<?php print $Data["RecID"] . "_Value"?>" cols="60" rows="3"><?php print $Data["Value"] ?></textarea></td>
      </tr>
	<?php
	} // while
	?>
    </table>
  </div>
  <div align="center">
    <input type="submit" />
  </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
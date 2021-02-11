<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptbymembership.php 31 2019-08-09 03:09:48Z scottauge $

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsMembership.php";
include_once "clsMainList.php";
include_once "sqltous.php";

include_once "incTimeDiff.php";

$CRLF = "<br>";

// needed by date()

date_default_timezone_set("America/Detroit");

$DB = new clsDB();
$DB1 = new clsDB();

$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$Membership = new clsMembership($DB);
$MainList = new clsMainList($DB);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Report By Membership</title>
<link href="theatre.css" rel="stylesheet" type="text/css" />
</head>
<!--
$Id: rptbymembership.php 31 2019-08-09 03:09:48Z scottauge $
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

Keyword Substitution
svn propset svn:keywords "Id Header" file.txt

-->

<?php include_once "incMenu.php" ?>
<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <table width="85%" border="0">
      <tr>
        <td><p align="center">Member Type
          <select name="MemberType" id="MemberType">
            <option value="ActiveMember">ActiveMember</option>
            <option value="ExpiredMember">ExpiredMember</option>
            <option value="All">All</option>
            </select>
          </p>
          <p align="center">As Of
            <input type="text" name="AsOfDate" id="AsOfDate" value="<?php print date("n/j/Y") ?>"/>
            <br />
            <input type="submit" name="button" id="button" value="Submit" />
        </p>
          <hr />
        <p align="center">&nbsp;</p></td>
      </tr>
    </table>
  </div>
  <p align="center">&nbsp;</p>
  <?php // echo "Select " . $_REQUEST["MemberType"] ?>
</form>
<div align="center">
<?php 




if (isset($_REQUEST["MemberType"])) {
	
	// if membership is active as of
	
	if ($_REQUEST["MemberType"] == "ActiveMember") {
		
		$SQL = "select * from MainList, Membership " .
		       "where Membership.MainListRecID = MainList.RecID " .
			   "and Membership.EndDate > '". ustosql($_REQUEST["AsOfDate"]) . "' " .
			   "order by MainList.Name, Membership.EndDate desc ";
	
		// print $SQL;
	
		$Results = $DB->Connection->query($SQL);
	
 		?>
  		<table width="85%" border="1" align="center">
  		<?php while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {	?>
        
    		<tr>
          		<td width="50%" valign="top"><?php print $Data["Name"]?><br>
          		<?php if (isset($Data["Address1"])) print $Data["Address1"]?><br>
          		<?php if (isset($Data["Address2"])) print $Data["Address2"]?><br>
          		<?php print $Data["City"]?><br>
          		<?php print $Data["State"]?> <?php print $Data["Zip"]?><br>
          		<?php if (isset($Data["StartDate"])) { print "Member " . sqltous($Data["StartDate"]) . " thru " . sqltous($Data["EndDate"]); } ?> <br />
          		</td>

		      	<?php if($Data = $Results->fetch_array(MYSQLI_ASSOC)) { ?>
                
          		<td width="50%" valign="top"><?php print $Data["Name"]?><br>
          		<?php if (isset($Data["Address1"])) print $Data["Address1"]?><br>
          		<?php if (isset($Data["Address2"])) print $Data["Address2"]?><br>
          		<?php print $Data["City"]?><br>
          		<?php print $Data["State"]?> <?php print $Data["Zip"]?>
          		<?php if (isset($Data["StartDate"])) print "Member " . sqltous($Data["StartDate"]) . " thru " . sqltous($Data["EndDate"]); } ?><br />
         		 </td>
    		</tr>
  		<?php
  		} // while 
  		?></table><?php
  
  	} // If ActiveMember
	
	
	
	
	
	
	// if membership is not active as of
	
	if ($_REQUEST["MemberType"] == "ExpiredMember") {
		
		$SQL = "select * from MainList";

		// print $SQL;
	
		$Results = $DB->Connection->query($SQL);
	
 		?>
  		<table width="85%" border="1" align="center">
  		<?php 
	
		while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {	
		
			// Find the last membership for this user
			// If there is no membership or it's EndDate > ustosql($_REQUEST["AsOfDate"])
			// then skip to the next MainList
			

			$SQL1 = "SELECT * FROM Membership " .
					"WHERE Membership.MainListRecID = '" . $Data["RecID"] . "' " .
					"ORDER BY Membership.EndDate DESC LIMIT 1";		
					
			// print $SQL1 . "<br>";	
			
			$Results1 = $DB1->Connection->query($SQL1);
			if ($Results1->num_rows == 0) continue;
			
			$Data1 = $Results1->fetch_array(MYSQLI_ASSOC);
	
	
			// Obtain the difference of dates
			
			$interval = TimeDiff($Data1["EndDate"], ustosql($_REQUEST["AsOfDate"]));
			
			// print "Data " . $Data1["EndDate"] . $CRLF;
			// print "Limit: " . ustosql($_REQUEST["AsOfDate"]) . $CRLF;
			// print "Interval " . $interval . "<br>";
			
			if ($interval < 0) continue;

			?>
        
    		<tr>
          		<td width="50%" valign="top"><?php print $Data["Name"]?><br>
          		<?php if (isset($Data["Address1"])) print $Data["Address1"]?><br>
          		<?php if (isset($Data["Address2"])) print $Data["Address2"]?><br>
          		<?php print $Data["City"]?><br>
          		<?php print $Data["State"]?> <?php print $Data["Zip"]?><br>
          		<?php if (isset($Data1["StartDate"])) { print "Member " . sqltous($Data1["StartDate"]) . " thru " . sqltous($Data1["EndDate"]); } ?> <br />
          		</td>
    		</tr>
  		<?php
  		} // while 
  		?></table>
		
		<?php

	} // ExpiredMember
	
	
	
	
	// all members regardless of status
	
	if ($_REQUEST["MemberType"] == "All") { 
	
		$SQL="select * from MainList"; 

		// print $SQL;
	
		$Results = $DB->Connection->query($SQL);
	
 		?>
  		<table width="85%" border="1" align="center">
  		<?php while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {	?>
        
    		<tr>
          		<td width="50%" valign="top"><?php print $Data["Name"]?><br>
          		<?php if (isset($Data["Address1"])) print $Data["Address1"]?><br>
          		<?php if (isset($Data["Address2"])) print $Data["Address2"]?><br>
          		<?php print $Data["City"]?><br>
          		<?php print $Data["State"]?> <?php print $Data["Zip"]?><br>
          		<?php if (isset($Data["StartDate"])) { print "Member " . sqltous($Data["StartDate"]) . " thru " . sqltous($Data["EndDate"]); } ?> <br />
          		</td>

		      	<?php if($Data = $Results->fetch_array(MYSQLI_ASSOC)) { ?>
                
          		<td width="50%" valign="top"><?php print $Data["Name"]?><br>
          		<?php if (isset($Data["Address1"])) print $Data["Address1"]?><br>
          		<?php if (isset($Data["Address2"])) print $Data["Address2"]?><br>
          		<?php print $Data["City"]?><br>
          		<?php print $Data["State"]?> <?php print $Data["Zip"]?>
          		<?php if (isset($Data["StartDate"])) print "Member " . sqltous($Data["StartDate"]) . " thru " . sqltous($Data["EndDate"]); } ?><br />
         		 </td>
    		</tr>
  		<?php
  		} // while 
  		?></table><?php
  
  	} // If All
		
} // if isset() 
?>
</div>
<?php include "footer.php" ?>
</body>
</html>
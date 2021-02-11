<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptletterprint.php 22 2019-07-13 02:04:19Z scottauge $


// TODO: If no membership record on non-members, will not print their letter when Non-members chosen

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsLetter.php";

include_once "incSubstitutionRules.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");



?>

<!--
$Id: rptletterprint.php 22 2019-07-13 02:04:19Z scottauge $
/**************************************************************************/
/*                                                                        */
/* AMDUUS INFORMATION WORKS, INC. CONFIDENTIAL                            */
/* ------------------                                                     */
/*                                                                        */
/*  Copyright 2012 Amduus Information Works Incorporated and Scott Auge   */
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Letter Print</title>
<style media="print" type="text/css">
.pagebreak { page-break-before: always; } /* page-break-after works, as well */

        @page 
        {
            size: auto;   /* auto is the current printer page size */
            margin-bottom: 0mm;  
			margin-top: 0mm;
			margin-right: 20mm;
			margin-left: 20mm;
        }

</style>
</head>

<body>
<?php
//echo $_REQUEST["GroupDescription"];

switch ($_REQUEST["GroupDescription"]) {
	
	
	
	case "All Members":
		$SQL = "SELECT * FROM MainList";
		OneTablePrint($SQL, $DB);		 			 
		break;
		 
		 
		 
	case "Members":
		MembersPrint();
		break;
		 	
			
			
	case "NonMembers":
		 NonMembersPrint();
		 break;
		 
		 
		 
	case "All Advertisers":
		$SQL = "SELECT * FROM `Advertisers` ORDER BY AdvertiserName";
		print $SQL . "<br>";
		OneTablePrint($SQL, $DB);
		break;		 
		 
		 
		 
	case "All Vendors":
		$SQL = "SELECT * FROM `Vendor` ORDER BY `CompanyName` ";
		OneTablePrint($SQL, $DB);	 
		break;		 
		 
		 	
} // switch



function OneTablePrint ($SQL, $DB) {
	
	$Letter = new clsLetter($DB);
	$Letter->FindByID($_REQUEST["LetterRecID"]);	
	
	// print "Inside OneTablePrint<br>";
	
	$Results = $DB->Connection->query($SQL);
		 
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 

		// print "Looping";
		
    	print "<br>";
		print ApplySubstitutionRule($Letter->Body, $Data);
	
		?>
    	<div class="pagebreak"></div>
    	<?php
			
	} // while
		
} // OneTablePrint()



function MembersPrint () {
	
	$DB1 = new clsDB();
	$DB2 = new clsDB();
	
	$Letter = new clsLetter($DB1);
	$Letter->FindByID($_REQUEST["LetterRecID"]);	
	
	$SQL = "SELECT * FROM `MainList` ORDER BY `Name`";
	//print $SQL . "<br>";
	
	$MainListResults = $DB1->Connection->query($SQL);
	
	//print gettype($MainListResults) . "<br>";

	
	while ($MainListData = $MainListResults->fetch_array(MYSQLI_ASSOC)) { 
	
		$SQL = "SELECT * FROM `Membership` " . 	
			   "WHERE Membership.EndDate > NOW() " .
			   "AND Membership.MainListRecID = '" . $MainListData["RecID"] . "' " .
			   "ORDER BY `EndDate` DESC LIMIT 1";
			   
		//print $SQL . "<br>";
		
		$MembershipResults = $DB2->Connection->query($SQL);

//print "Isset MembershipResults " . isset($MembershipResults) . "<br>";
//print gettype($MembershipResults) . " " . $MembershipResults . "<br>";
//var_dump($MembershipResults);

		while ($MembershipData = $MembershipResults->fetch_array(MYSQLI_ASSOC)) {
			
			
//print "Isset MembershipData " . isset($MembershipData) . "<br>";
//print gettype($MembershipData) . " " . $MembershipData . "<br>";
			
			print "<br>";
			
			$TempLetter = ApplySubstitutionRule($Letter->Body, $MembershipData);
			print ApplySubstitutionRule($TempLetter, $MainListData);
	
			?>
    		<div class="pagebreak"></div>
    		<?php
			
		} // Membership query
		
	} // MainList query
		

}



function NonMembersPrint () {

	//print "In NonMembersPrint() <br>";
	
	$DB1 = new clsDB();
	$DB2 = new clsDB();
		
	$Letter = new clsLetter($DB1);
	$Letter->FindByID($_REQUEST["LetterRecID"]);	
	
	$SQL = "SELECT * FROM `MainList` ORDER BY `Name`";
	//print $SQL . "<br>";
	
	$MainListResults = $DB1->Connection->query($SQL);
	
	//print gettype($MainListResults) . "<br>";

	
	while ($MainListData = $MainListResults->fetch_array(MYSQLI_ASSOC)) { 
	
		$SQL = "SELECT * FROM `Membership` " . 	
			   "WHERE Membership.EndDate < NOW() " .
			   "AND Membership.MainListRecID = '" . $MainListData["RecID"] . "' " .
			   "ORDER BY `EndDate` DESC LIMIT 1";
			   
		//print $SQL . "<br>";
		
		$MembershipResults = $DB2->Connection->query($SQL);

//print "Isset MembershipResults " . isset($MembershipResults) . "<br>";
//print gettype($MembershipResults) . " " . $MembershipResults . "<br>";
//var_dump($MembershipResults);

		while ($MembershipData = $MembershipResults->fetch_array(MYSQLI_ASSOC)) {
			
			
//print "Isset MembershipData " . isset($MembershipData) . "<br>";
//print gettype($MembershipData) . " " . $MembershipData . "<br>";
			
			print "<br>";
			
			$TempLetter = ApplySubstitutionRule($Letter->Body, $MembershipData);
			print ApplySubstitutionRule($TempLetter, $MainListData);
	
			?>
    		<div class="pagebreak"></div>
    		<?php
			
		} // Membership query
		
	} // MainList query
	
} // NonMembersPrint ()


//echo $SQL;
?>

</body>
</html>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptletteremail.php 21 2019-07-10 22:58:44Z scottauge $

// use PHPMailer\PHPMailer;

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsLetter.php";
include_once "clsMailer.php";
include_once "incSubstitutionRules.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);

$Parameter->FindByName("EmailDebug");
$EmailDebug = $Parameter->Value;

$Parameter->FindByName("SendEmail");
$SendEmail = $Parameter->Value;

$Parameter->FindByName("title");

$Letter = new clsLetter($DB);
$Letter->FindByID($_REQUEST["LetterRecID"]);

$Mailer = new clsMailer();
?>

<!--
$Id: rptletteremail.php 21 2019-07-10 22:58:44Z scottauge $
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

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Letter EMail</title>
</head>

<body>
Here we go<br /><hr /><br />
<?php
if ($EmailDebug == "On")print $_REQUEST["GroupDescription"] . "<br><hr>";

$StartDate = date("Y-m-d");
$EndDate = date("Y-m-d");

switch ($_REQUEST["GroupDescription"]) {
	
	case "All Members":
		 $SQL = "SELECT * FROM MainList";
		 if ($EmailDebug == "On") print "SQL = " . $SQL . "<br><hr>";
		 break;
		 
	case "Members":
		 $SQL = "select * from MainList, Membership where Membership.MainListRecID = MainList.RecID and Membership.EndDate > '". $EndDate . "' order by MainList.Name, Membership.EndDate desc ";
		 if ($EmailDebug == "On") print "SQL = " . $SQL . "<br><hr>";
		 break;
		 	
	case "Expired Members":
		 $SQL = "select * from MainList, Membership where Membership.MainListRecID = MainList.RecID and Membership.EndDate < '". $EndDate . "' order by MainList.Name, Membership.EndDate desc ";
		 if ($EmailDebug == "On") print "SQL = " . $SQL . "<br><hr>";		 
		 break;
		 
case "All Vendors":
		$SQL = "SELECT * FROM `Vendor` ORDER BY `CompanyName` ";
		break;	
		 
case "All Advertisers":
		$SQL = "SELECT * FROM `Advertisers` ORDER BY AdvertiserName";
		break;		 		 
		 	
} // switch


$Parameter->FindByName("ReturnEmail");
$From = $Parameter->Value;

//echo $SQL;

$Results = $DB->Connection->query($SQL);

while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 

    if ($Data["Email"] <> "") $EMail = $Data["Email"];
	else if ($Data["ContactEmail"] <> "") $EMail = $Data["ContactEmail"];
	
    if ($EMail == "") {
		print "<hr>No email address for " . $Data["Name"] . " skipping...<br><hr><br>";
		continue;
	}

	$Body = ApplySubstitutionRule($Letter->Body, $Data);
	
	print "Sending to: " . $EMail . "<br>";
	print "Subject: " . $_REQUEST["Subject"] . "<br>";
	print "Body:<br>" . $Body . "<br>";
	print "<hr><br>";

	
	$Mailer->From = $From;
	$Mailer->To = $EMail; // "scott_auge@yahoo.com";
	$Mailer->Subject = $_REQUEST["Subject"];
	$Mailer->HTMLMessage = $Body;
	 
	if ($SendEmail == "On") $Mailer->SendMail();

} // while
?>
<hr />Done!<br />
</body>
</html>

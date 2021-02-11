<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptletterlabelprint.php 2 2019-06-20 18:03:22Z scottauge $


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

$Letter = new clsLetter($DB);

$Letter->FindByID($_REQUEST["LetterRecID"]);

?>

<!--
$Id: rptletterlabelprint.php 2 2019-06-20 18:03:22Z scottauge $
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
	
	case "All":
		 $SQL = "SELECT * FROM MainList";
		 break;
		 
	case "Members":
	     $StartDate = date("Y-m-d");
		 $EndDate = date("Y-m-d");
		 $SQL = "SELECT * FROM `Membership`, MainList WHERE Membership.StartDate < $StartDate and Membership.EndDate > $EndDate and MainList.RecID = Membership.MainListRecID ";
		 
		 // echo $SQL;
		 break;
		 	
	case "NonMembers":
		 $StartDate = date("Y-m-d");
		 $EndDate = date("Y-m-d");
		 $SQL = "SELECT * FROM `Membership`, MainList WHERE NOT (Membership.StartDate < $StartDate AND Membership.EndDate > $EndDate) AND MainList.RecID = Membership.MainListRecID";
		 break;
		 	
} // switch

//echo $SQL;

$Results = $DB->Connection->query($SQL);

while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 

    print "<br>";
	print ApplySubstitutionRule($Letter->Body, $Data);
	
	?>
    <div class="pagebreak"></div>
    <?php
}
?>
</body>
</html>

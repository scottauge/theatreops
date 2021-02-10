<?php
include_once "clsDB.php";
include_once "clsParameter.php";
include_once "incLoginSession.php";

include_once "sqltous.php";

include_once "clsRecordSet.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);

$BarColor = new clsParameter($DB);
$BarColor->FindByName("BarColor");

// needed by date()
$Parameter->FindByName("TimeZone");
date_default_timezone_set($Parameter->Value);

$Parameter->FindByName("title");
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Advertiser</title>
</head>

<!--
$Id: rptAdvertiser.php 31 2019-08-09 03:09:48Z scottauge $
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

<?php
if (!isset($_REQUEST["interaction"]) || $_REQUEST["interaction"] == "") {
?>
<form id="form1" name="form1" method="post" action="">
  <p>&nbsp;</p>
  <table width="50%" border="0" align="center">
    <!--<tr>
      <td align="right">Expired Contracts:</td>
      <td><input type="radio" name="expired" id="radio" value="yes" checked />
      Yes 
      <input type="radio" name="expired" id="radio" value="no" />
      No</td>
    </tr> -->
    <tr>
      <td align="right">No Interactions Since:</td>
      <td><input type="text" name="interaction" id="interaction" value="<?php print (date("n-j-Y")); ?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="button" id="button" value="Submit" /></td>
    </tr>
  </table>
  <hr width="80%" align="center" />
  <p>&nbsp;</p>
</form>
<?php

} // Show inputs to the report

else {
	
	//print("Running report");
	
	?><br /><table><?php
	
	// -------------------------------------------------------------------
	// In effect for each advertiser
	// -------------------------------------------------------------------
		
	$AdvertiserResults = $DB->Connection->query("SELECT * FROM Advertisers ORDER BY AdvertiserName");
	
	$AdvertiserRow = $AdvertiserResults->fetch_all(MYSQLI_ASSOC);
	$AdvertiserResults->free();
	
	// -------------------------------------------------------------------		
	// Check if has an expired contract
	// This won't bring up advertisers with no AdvertiserSales record
	// -------------------------------------------------------------------		
	
	//if (isset($_REQUEST["expired"]) && $_REQUEST["expired"] == "yes") {
			
		//print ("Expired!");
		$AdvertiserSaleRow = new clsRecordSet();
		
		foreach ($AdvertiserRow as $Row) { 
		
		 	$SQL = "SELECT * FROM AdvertiserSale " .
			       "WHERE AdvertiserSale.AdvertisersRecID = '" . $Row['RecID'] . "'" .
					" AND AdvertiserSale.EndDate < '" . date ("Y-m-j") . "'" .
					" ORDER BY AdvertiserSale.EndDate LIMIT 1";
			
		    // print ($SQL . "<br />");
															
			$AdvertiserSaleResults = $DB->Connection->query($SQL);
														
			if ($AdvertiserSaleResults && $AdvertiserSaleResults->num_rows > 0) {
	
				$AdvertiserSaleRow->Add($AdvertiserSaleResults->fetch_all(MYSQLI_ASSOC));
	
				$AdvertiserSaleResults->free();
				
			} // if
		
		}  // foreach
	
		
	//} // if check box for expired is ticked
	
	// -------------------------------------------------------------------				
	// Check if the last interaction is before the date
	// -------------------------------------------------------------------		
	
	$NotesRow = new clsRecordSet();
	
	foreach ($AdvertiserRow as $Row) {
		
		$SQL= "SELECT * FROM Notes " .
		      "WHERE Notes.RelationRecID = '" . $Row['RecID'] . "'" .
			  " AND Notes.RelationTable = 'Advertisers' " .
			  " ORDER BY CreateDate DESC";
										
		// print ($SQL . "<br />");
												
		$Notes = $DB->Connection->query($SQL);
		if ($Notes && $Notes->num_rows > 0) {	
		
			$NotesRow->Add( $Notes->fetch_all(MYSQLI_ASSOC));
				
			$Notes->free();
			
		}
	
	} // foreach				
	
	// -------------------------------------------------------------------	
	// Dispay info about results.  Future programmers are going to need
	// this to figure out what the h is going on.
	// -------------------------------------------------------------------	
	/*
	print ("Advertisers " . count($AdvertiserRow) . "<br />");
	print ("AdvertiserSale " . $AdvertiserSaleRow->Count() . "<br />");
	print ("Notes " . $NotesRow->Count() . "<br />");	
	
	print ("Advertisers<br><pre>");
	print_r($AdvertiserRow);
	print ("<br />NotesRow<br>");
	print_r($NotesRow);
	print ("</pre><br />");
	
	$R = $NotesRow->FindByKey("RelationRecID", "1562630892fwoy1vYg2HxYGGPyGdcBkEj1zOvwlidlfx0Ft0W6");
	print ($R["Text"]);
	*/
	
	
	
	
	foreach ($AdvertiserRow as $Row) {
		
		// Determine if we got an expire contract
		
		
		// Row Color
	
	(!isset($RowColor) || $RowColor == "") ? $RowColor = $BarColor->Value : $RowColor = "";
	?>
	
    <tr bgcolor="<?php print($RowColor) ?>">
      <td>Company Name: <a href="updateadvertiser.php?RecID=<?php print ($Row["RecID"])?>" target="_new"><?php print ($Row["AdvertiserName"])?></td>
    </tr>
    
    <tr bgcolor="<?php print($RowColor) ?>">
      <td>Last Note: <?php $R = $NotesRow->FindByKey("RelationRecID", $Row["RecID"]);
	            if (isset($R)) print ($R["CreateDate"] . " " . $R["Text"]);
		  ?></td>
    </tr>
        
    <tr bgcolor="<?php print($RowColor) ?>">
      <td>Expired When: <?php $R = $AdvertiserSaleRow->FindByKey("AdvertisersRecID", $Row["RecID"]);
	            if (isset($R)) print ($R["EndDate"]);
				else print ("No Sale Ever");
		  ?></td>
    </tr>
            
    <tr>
      <td colspan="2"><hr width="20%" align="center" /></td>
    </tr>
    
    <?php
	
	} // for each
	
	?>
    
	</table>
	<?php
} // generate the report


?>
<?php include "footer.php" ?>
</body>
</html>
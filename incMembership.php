<?php

// Use this to include the activities a user may be involved in
// If updating, should be in a form and updating should be else where
// $Header: file:///Users/scottauge/Documents/SVN/theatre/incMembership.php 13 2019-07-09 02:18:15Z scottauge $
//
// $ShowHistory = yes, show the history of previous payments
// $ShowUpdate = yes, show empty entries for update (usually in another program)

include_once "nonotice.php";
include_once "clsMembership.php";
include_once "clsDB.php";
include_once "sqltous.php";

function DisplayMembership ($UserID, $DB, $ShowUpdate, $ShowHistory) {
	
	setlocale(LC_MONETARY, 'en_US');  // format US style
	
	$Membership = new clsMembership($DB);
	
	$SQL = "SELECT * FROM Membership WHERE MainListRecID = '$UserID'";
    $Results = $DB->Connection->query($SQL);
  // print $Results->num_rows;
  
  // print "ShowHistory " . $ShowHistory . " ShowUpdate " . $ShowUpdate;
  
	
?><div align="center"><br />Memberships<br /><hr width="50%" />
  <table width="50%" border="0">
    <tr>
      <td>Delete</td>
      <td>Start Date</td>
      <td>End Date</td>
      <td>Payment</td>
    </tr>
    <?php 
    if ($ShowHistory == "yes") {
	// looks like my php doesn't have this!
	// $formatter = new NumberFormatter('us', NumberFormatter::CURRENCY);
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 
    ?>
	<tr>
      <td><input type="checkbox" name="<?php print $Data["RecID"] ?>" value="yes"/>
      <td><?php print sqltous($Data["StartDate"]) ?></td>
      <td><?php print sqltous($Data["EndDate"]) ?></td>
	  <td><?php print (number_format($Data["Payment"], 2, '.', ',')) ?></td>
	  
	  <!-- <td><?php //print ($formatter->formatCurrency($Data["Payment"], 'USD')) ?></td> -->
	  
      <!-- <td><?php // print money_format('%.2n', $Data["Payment"]) ?></td> -->
    </tr>
    <?php 
	} // while 
	} // if
	
	if ($ShowUpdate == "yes") {?>
    <tr>
    <td></td>
    <td><input type="text" name="MembershipStartDate" id="MembershipStartDate" /></td>
    <td><input type="text" name="MembershipEndDate" id="MembershipEndDate" /></td>
    <td><input type="text" name="MembershipPayment" id="MembershipPayment" /></td>
    </tr>
    <?php } // if ($ShowUpdate = "yes") ?>
  </table>
</div>

<?php
} // DisplayActivities ()
?>
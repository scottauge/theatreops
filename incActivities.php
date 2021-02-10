<?php

// Use this to include the activities a user may be involved in
// If updating, should be in a form and updating should be else where
// $Header: file:///Users/scottauge/Documents/SVN/theatre/incActivities.php 2 2019-06-20 18:03:22Z scottauge $

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

include_once "clsActivity.php";
include_once "clsDB.php";

function DisplayActivities ($UserID, $DB) {

	$ColumnCount = 0;
	
	$UserActivity = new clsListToActivity($DB);
	
	$SQL = "SELECT * FROM Activity";
    $Results = $DB->Connection->query($SQL);
  // print $Results->num_rows;
	
?><div align="center">
  <br />Activities<br /><hr width="50%" />
  <table width="50%" border="0">
    <?php 
    while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 
    
	if ($ColumnCount % 2 == 0) print "<tr>";
    ?>
      <td> <input type="checkbox" value="1" name="<?php print $Data["RecID"]?>" <?php $UserActivity->FindByActivityMainList($Data["RecID"], $UserID);
	  if ($UserActivity->Available()) print "checked" ?>> <?php print $Data["Name"] ?></td>
      
    <?php
	$ColumnCount++;
	if ($ColumnCount % 2 == 0) print "</tr><tr>";
	
	} // while ?>
    </tr>
  </table>
</div>

<?php
} // DisplayActivities ()
?>
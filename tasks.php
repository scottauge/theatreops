<?php


// $Header: file:///Users/scottauge/Documents/SVN/theatre/tasks.php 31 2019-08-09 03:09:48Z scottauge $

include_once "nonotice.php";
include_once "clsDB.php";
include_once "clsTasks.php";
include_once "clsParameter.php";
include_once "incGenerateSelect.php";

include_once "incLoginSession.php";

$DB = new clsDB();
$Tasks = new clsTasks($DB);

$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$BarColor = new clsParameter($DB);
$BarColor->FindByName("BarColor");

// If we are creating a task, then lets make it now so it appears on the list

if (isset($_REQUEST["task"])) {
	
	$Tasks->Create();
	$Tasks->Status = $_REQUEST["Status"];
	$Tasks->MainLoginRecID = $_REQUEST["Assigned"];
	$Tasks->Description = $_REQUEST["task"];
	$Tasks->Title = $_REQUEST["title"];
	$Tasks->Priority = $_REQUEST["priority"];
	$Tasks->Update();
	
} // if



// If we are deleteing, do that before showing the list

if (isset($_REQUEST["deleterecid"])) {
	$Tasks->FindByID($_REQUEST["deleterecid"]);
	$Tasks->Delete();
} // if



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Tasks</title>
<link href="theatre.css" rel="stylesheet" type="text/css" />
</head>

<!--

$Id: tasks.php 31 2019-08-09 03:09:48Z scottauge $
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
<div align="center">
<br />
  <table width="75%" class="TableColor">
    <tr>
      <td><form id="form1" name="form1" method="post" action="">
        <p align="center">
        <table align="left">
          <tr>
          <td>
          Title: </td>
          <td><input name="title" type="text" size="60" maxlength="60" width="60" /></td>
          </tr>
          <tr>
          <td>
          Priority:</td><td> <input name="priority" type="text" size="2" maxlength="2" width="2" /></td>
          </tr>
          <tr>
            <td>Text:</td>
            <td><textarea name="task" cols="70" rows="5" id="task"></textarea></td>
          </tr>
          </table>
          <br />
          </p>
        <div align="center">
          <table width="75%" border="0">
            <tr>
            
            
              <td width="50%">
                <?php print GenerateSelect("Status", "StatusOptions", $DB) ?>
              </td>
              <td width="50%"><div align="right">
                <select name="Assigned" id="Assigned">
                <?php 
				$SQL = "SELECT * FROM Logins";
				$Results = $DB->Connection->query($SQL);
				while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
				?>
                <option value="<?php print $Data["RecID"]; ?>"><?php print $Data["UserID"]; ?></option>     
                <?php
				}
				?>           
                </select>
              </div></td>
              </tr>
          </table>
          <input type="submit" name="button" id="button" value="Create" />
        </div>
      </form></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</div>
<div align="center">
  <table width="75%" border="0">
    <tr>
      <td></td>
      <td><strong>Title</strong></td>
      <td><strong>Owned By</strong></td>
      <td><strong>Status</strong></td>
      <td><strong>Priority</strong></td>
    </tr>
    
    <?php 
	$SQL="SELECT *, Tasks.RecID as TaskRecID FROM `Tasks` LEFT JOIN Logins ON (Tasks.MainLoginRecID = Logins.RecID)";
	$Results = $DB->Connection->query($SQL);
	while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
		
	// Deal with row color
	$RowColor == "" ? $RowColor = $BarColor->Value : $RowColor = "";
	?>
    
    <tr bgcolor="<?php print ($RowColor) ?>">

      <td><a href="updatetask.php?recid=<?php print $Data["TaskRecID"]?>">Edit</a>/<a href="tasks.php?deleterecid=<?php print $Data["TaskRecID"]?>">Delete</a></td>
      <td><?php print $Data["Title"] ?></td>
      <td><?php print $Data["UserID"] ?></td>
      <td><?php print $Data["Status"] ?></td>
      <td><?php print $Data["Priority"] ?></td>

    </tr>
    
    <?php
	} // while
	?>
  </table>
</div>
<p>&nbsp;</p>
<?php include "footer.php" ?>
</body>
</html>
<?php
include_once "nonotice.php";
include_once "clsDB.php";
include_once "clsParameter.php";

$DB = new clsDB();
$Parameter = new clsParameter($DB);


$Parameter->FindByName("title");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Update Task</title>
<link href="theatre.css" rel="stylesheet" type="text/css" />
</head>

<!--
$Id: updatetask.php 31 2019-08-09 03:09:48Z scottauge $
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

// $Header: file:///Users/scottauge/Documents/SVN/theatre/updatetask.php 31 2019-08-09 03:09:48Z scottauge $

include_once "clsDB.php";
include_once "clsTasks.php";
include_once "clsParameter.php";
include_once "incGenerateSelect.php";

$DB = new clsDB();
$Tasks = new clsTasks($DB);
$Parameter = new clsParameter($DB);


$Parameter->FindByName("title");
$Tasks->FindByID($_REQUEST["recid"]);

// If we are creating a task, then lets make it now so it appears on the list

if (isset($_REQUEST["task"])) {
	

	$Tasks->Status = $_REQUEST["Status"];
	$Tasks->MainLoginRecID = $_REQUEST["Assigned"];
	$Tasks->Description = $_REQUEST["task"];
	$Tasks->Title = $_REQUEST["title"];
	$Tasks->Priority = $_REQUEST["priority"];
	$Tasks->Update();
	
		// echo $Tasks->Title . " " . $Tasks->Priority;
	
} // if


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php print($Parameter->Value)?> - Update Task</title>
</head>

<?php include_once "incMenu.php" ?>
<body  class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<div align="center">
<br />
  <table width="75%" border="0" class="TableColor">
    <tr>
      <td><form id="form1" name="form1" method="post" action="">
        <input type="hidden" value="<?php print $_REQUEST["recid"] ?>" name="recid"/>
        <table width="75%" border="0">
          <tr>
            <td>Title</td>
            <td><input type="text" name="title" value="<?php print $Tasks->Title; ?>" /></td>
          </tr>
          <tr>
            <td>Priority</td>
            <td><input type="text" name="priority" value="<?php print $Tasks->Priority; ?>" /></td>
          </tr>
          <tr>
            <td>Text:</td>
            <td><textarea name="task" cols="70" rows="5" id="task"><?php print $Tasks->Description ?></textarea></td>
          </tr>
        </table>
        <p align="center">&nbsp;</p>
        <div align="center">
          <table width="75%" border="0">
            <tr>
            
            
              <td width="50%">
                <?php print GenerateSelectWithDefault("Status", "StatusOptions", $Tasks->Status, $DB) ?>
              </td>
              <td width="50%"><div align="right">
                <select name="Assigned" id="Assigned">
                <?php 
				$SQL = "SELECT * FROM Logins";
				$Results = $DB->Connection->query($SQL);
				while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) {
				?>
                <option value="<?php print $Data["RecID"]; ?>" <?php if ($Data["RecID"] == $Tasks->MainLoginRecID) print "selected";?>><?php print $Data["UserID"];  ?></option>     
                <?php
				}
				?>           
                </select>
              </div></td>
              </tr>
          </table>
          <input type="submit" name="button" id="button" value="Update" />
        </div>
      </form></td>
    </tr>
  </table>
<?php include "footer.php" ?>
</body>
</html>
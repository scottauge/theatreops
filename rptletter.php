<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/rptletter.php 31 2019-08-09 03:09:48Z scottauge $

include_once "nonotice.php";
include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

?>


<!--
$Id: rptletter.php 31 2019-08-09 03:09:48Z scottauge $
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
<title><?php print($Parameter->Value)?> - Print Letters</title>
</head>

<?php include_once "incMenu.php" ?>
<body class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>

<form target="_blank" id="form1" name="form1" method="post" action="rptletterprint.php">
  <div align="center">
    <p>Create Letters To A Group On A Printer</p>
    <p>(When you hit submit, another window will appear with the letters.<br />
      Press CTRL-P or Command-P
    and they should print out 1 letter per page(s).)</p>
    <table width="25%" border="0">
      <tr>
        <td>Which Letter</td>
      </tr>
      <tr>
        <td><select name="LetterRecID" >
          <?php
			$SQL="SELECT * FROM Letter";

			$Results = $DB->Connection->query($SQL);

			while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 
		  ?>
          <option value="<?php print $Data["RecID"]; ?>"><?php print $Data["Name"]; ?></option>
          <?php
		  } // while
		  ?>
        </select>
        </td>
      </tr>
      <tr>
        <td>Which Group</td>
      </tr>
      <tr>
        <td><select name="GroupDescription" >
          <option value="Members">Members</option>
          <option value="NonMembers">Non-Members</option>
          <option value="All Members">All Members</option>
          <option value="All Vendors">All Vendors</option>
          <option value="All Advertisers">All Advertisers</option>
        </select></td>
      </tr>
    </table>
    <p>
      <input type="submit" name="button" id="button" value="Submit" />
    </p>
    <p>&nbsp;</p>
  </div>
</form>
<?php include "footer.php" ?>
</body>
</html>
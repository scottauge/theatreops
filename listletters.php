<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/listletters.php 31 2019-08-09 03:09:48Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsLetter.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

$Letter = new clsLetter($DB);

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--
$Id: listletters.php 31 2019-08-09 03:09:48Z scottauge $
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
<title><?php print($Parameter->Value)?> - List Letters</title>
</head>


<?php include_once "incMenu.php" ?>
<body class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>


<form method="post" action="">
<p></p>
<table width="50%" border="0" align="center">

  <tr>
    <td width="15%"><div align="center">Delete</div></td>
    <td width="85%"><a href="editmessage.php?RecID=new">New</a></td>
  </tr>
  <?php

$SQL="SELECT * FROM Letter";

$Results = $DB->Connection->query($SQL);

while ($Data = $Results->fetch_array(MYSQLI_ASSOC)) { 

  	  // If we are deleting, we don't want it showing up
	  // print "_REQUEST[$Data[RecID]]:" . $_REQUEST[$Data["RecID"]] . "<br />";
	  
	  if ($_REQUEST[$Data["RecID"]] <> "") {
	
		  $Letter->FindByID($Data["RecID"]);
		  $Letter->Delete();
		  
		  continue;
	  }
	  
	  // Deal with row color
	$RowColor == "" ? $RowColor = "#CCCCCC" : $RowColor = "";
?>
  <tr bgcolor="<?php print ($RowColor) ?>">
    <td><div align="center">
      <input type="checkbox" value="1" name="<?php print $Data["RecID"]?>" />
    </div></td>
    <td><a href="editmessage.php?RecID=<?php print $Data["RecID"]; ?>"><?php print $Data["Name"]; ?></a></td>
  </tr>

  <?php

} // while ()

?>
  <tr>
    <td colspan="2"><div align="center">
      <input type="submit" name="button" id="button" value="Submit" />
    </div></td>
  </tr>
</table>
</form>
<?php include "footer.php" ?>
</body>
</html>
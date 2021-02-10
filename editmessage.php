<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/editmessage.php 2 2019-06-20 18:03:22Z scottauge $

include_once "incLoginSession.php";
include_once "clsParameter.php";
include_once "clsDB.php";
include_once "clsLetter.php";
include_once "incHelp.php";


$DB = new clsDB();
$Parameter = new clsParameter($DB);
$Parameter->FindByName("title");

// If the RecID is "new" then we want a new Letter

if ($_REQUEST["RecID"] == "new") {
	
	$Letter = new clsLetter($DB);
	$Letter->Create();
	$Saved=0;
	
}

else {
	
	$Saved = 0;
	
	$Letter = new clsLetter($DB);
	$Letter->FindByID($_REQUEST["RecID"]);
	
	// We got anything to save?
	
	if (isset($_REQUEST["Name"])) {
		$Letter->Name = $_REQUEST["Name"];
		$Saved = 1;
	}
	
	if (isset($_REQUEST["Body"])) {
		$Letter->Body = $_REQUEST["Body"];
		$Saved = 1;
	}
	
	if ($Saved == 1) $Letter->Update();
	
} // else ()

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<!--
$Id: editmessage.php 2 2019-06-20 18:03:22Z scottauge $
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
<title><?php print($Parameter->Value)?> - Edit Letters</title>
  <script src="tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
  tinymce.init({
    selector: '#Body',
	height: 300,
	width: 700,
	resize: 'both'
  });
  </script>
</head>
<?php include_once "incMenu.php" ?>
<body class="claro">
<?php include_once "incAppTitle.php" ?>
<div id="wrapper"></div>
<?php HelpLink("editmessage") ?>

<?php if ($Saved == 1) { ?>
<p align="center"> Saved! </p>
<?php } ?>
<form id="form1" name="form1" method="post" action="">
  <div align="center">
    <input type="hidden" name="RecID" value="<?php print $Letter->RecID; ?>" />
    <table width="50%" border="0">
      <tr>
        <td>Letter name:</td>
      </tr>
      <tr>
        <td><input type="text" name="Name" id="textfield" value="<?php print $Letter->Name; ?>" /></td>
      </tr>
      <tr>
        <td>Letter Body</td>
      </tr>
      <tr>
        <td><textarea name="Body" id="Body" cols="45" rows="5"><?php print $Letter->Body; ?></textarea></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
  </div>
  <p align="center">
    <input type="submit" name="button" id="button" value="Save" />
  </p>
</form>
</body>
</html>
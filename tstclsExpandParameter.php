<?php

include_once("clsExpandParameter.php");
include_once("clsDB.php");

$DB = new clsDB();

$E = new clsExpandParameter($DB);

$E->ForEachAll();
print($E->NumberOfRows() . "<br>");
print($E->Name . " " . $E->Value . "<br>");
print ("---" . "<br>");


$E->ForEachPartByName("Inventory.");
print($E->NumberOfRows() . "<br>");
print($E->Name . " " . $E->Value . "<br>");
$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");
$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");
$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");
$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");
$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");

$E->NextRow();
print($E->Name . " " . $E->Value . "<br>");

print("First Row" . "<br>");
$E->FirstRow();
print($E->Name . " " . $E->Value . "<br>");

print("Last Row" . "<br>");
$E->LastRow();
print($E->Name . " " . $E->Value . "<br>");

?>
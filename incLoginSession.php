<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incLoginSession.php 15 2019-07-09 23:11:44Z scottauge $

// Here we take the Cookie, Password, and UserID and attempt to verify against
// what is in the database.

include_once "clsDB.php";
include_once "clsSession.php";
include_once "incLoadScreen.php";
include_once "clsLogins.php";
include_once "clsParameter.php";

$DB = new clsDB();


// Clear out expired Sessions

$Parameter = new clsParameter($DB);
$Parameter->FindByName("SessionTimeOut");
$SQL = "DELETE FROM Session WHERE LastUsed < DATE_SUB(NOW(), " . $Parameter->Value . ")";
//print $SQL;
$S = $DB->Connection->prepare($SQL);
$S->execute();
$S->close();

	
// Can they login or timed out?
	
$Session = new clsSession($DB);

$Cookie = $_COOKIE["MailListLogin"];
$UserID = isset($_POST["UserID"]) ? $_POST["UserID"] : "";
$Password = isset($_POST["Password"]) ? $_POST["Password"] : "";

$Session->FindByCookieName ($Cookie, "Login");

if (! $Session->Available()) {

  $Login = new clsLogins($DB);
  $Login->FindByUserIDPassword($UserID, $Password);
  if (! $Login->Available()) LoadScreen ("index.php");

  $Session->Create();
// print ("Using Cookie $Cookie");
  $Session->CookieID = $Cookie;
  $Session->SessionName = "Login";
  $Session->SessionValue = $Login->RecID;

  $Session->Update();

} // Not Session Record Available


?>
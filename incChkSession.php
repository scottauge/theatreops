<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incChkSession.php 2 2019-06-20 18:03:22Z scottauge $

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

// Determine if a user is logged in via their cookie session id
// Else, we send them to the index.php screen.
// This should be used on everything but the main.php which does the login.

include_once "nonotice.php";
include_once "incLoadScreen.php";
include_once "clsSession.php";
include_once "clsDB.php";

// Is the cookie set?

$Cookie = $_COOKIE["MailListLogin"];
if ($Cookie == "") LoadScreen("index.php");

// Does the cookie relate to a Login?

$DB = new clsDB();
$Session = new clsSession($DB);
$Session->FindByCookieName($Cookie, "Login");
if (!$Session->Available()) LoadScreen("index.php");
?>


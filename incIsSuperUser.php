<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incIsSuperUser.php 18 2019-07-10 18:56:17Z scottauge $

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

include_once "clsDB.php";
include_once "clsSession.php";
include_once "clsLogins.php";

function IsSuperUser ($CookieValue) {
	
	$DB = new clsDB();
	$Session = new clsSession($DB);
	
	
	// If not logged in, bail
	
	$Session->FindByCookieName ($CookieValue, "Login");
	
	if (! $Session->Available()) return FALSE;

	$Login = new clsLogins($DB);
	$Login->FindByID($Session->SessionValue);
	
	if ($Login->IsSuperUser) return TRUE;

	return FALSE;
	
}
?>
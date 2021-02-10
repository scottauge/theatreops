<?php
// $Header: file:///Users/scottauge/Documents/SVN/theatre/incDBSubstitution.php 2 2019-06-20 18:03:22Z scottauge $
// Use as follows
// $SubstitutionNVPs = "Name=Scott,Address1=1918 Briarwood Dr, ... ";
// $InTemplate = "Hello {Name}, ... ";

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

function DBSubstitution ($InTemplate, $SubstitutionNVPs) {

  
  $List = explode (",", $SubstitutionNVPs);
  
  $Count = count($List);

  for ($Iter = 0; $Iter < $Count; $Iter++) {
	  
    list($Name, $Value) = explode ("=", $List[$Iter]);
  
    $InTemplate = str_replace("{" . $Name . "}", $Value, $InTemplate);
	
  } // for ...
  
  return $InTemplate;
	
}


?>
<?php

// $Header: file:///Users/scottauge/Documents/SVN/theatre/incGenerateSelect.php 2 2019-06-20 18:03:22Z scottauge $

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

// Generate a select based on the parameter value named
// This is for the Parameter table only

include_once "clsParameter.php";

function GenerateSelect ($SelectName, $ParameterName, $DB) {
	
	$Parameter = new clsParameter($DB);
	$Parameter->FindByName($ParameterName);
	
	$Return = "<select name=\"" . $SelectName . "\" id=\"" . $SelectName . "\">";
	
	$options = explode (",", $Parameter->Value);
	
	$Idx = 0;
	$ArrayCount = count($options);
	
	// print $Idx . " " . $ArrayCount;
	
	while ($Idx < $ArrayCount) {
		
		$Return = $Return 
		        . "<option value=\"" . $options[$Idx] . "\">"
				. $options[$Idx] . "</option>"
                        . "\n";
				
	    $Idx++;
		
	} // while
	
	$Return = $Return
	        . "</select>";
			
    return $Return;
}


// Generate a select based on the parameter value named
// This is for the Parameter table only
// Allows select on a default parameter for updates and the like

function GenerateSelectWithDefault ($SelectName, $ParameterName, $Default, $DB) {
	
	$Parameter = new clsParameter($DB);
	$Parameter->FindByName($ParameterName);
	
	$Return = "<select name=\"" . $SelectName . "\" id=\"" . $SelectName . "\">";
	
	$options = explode (",", $Parameter->Value);
	
	$Idx = 0;
	$ArrayCount = count($options);
	
	// print $Idx . " " . $ArrayCount;
	
	while ($Idx < $ArrayCount) {
		
		$Return = $Return 
		        . "<option "
				. (($options[$Idx] == $Default) ? " selected " : "")
				. "value=\"" . $options[$Idx] . "\">"
				. $options[$Idx] . "</option>"
                . "\n";
				
	    $Idx++;
		
	} // while
	
	$Return = $Return
	        . "</select>";
			
    return $Return;
}
?>


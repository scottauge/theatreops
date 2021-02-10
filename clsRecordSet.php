<?php

// Create a tool to store record results in memory for ::fetch_all()
// All the PHP functions act as arrays are unique sets over-writing values.
// We need a way to retrieve the rows exactly as they were stored.

class clsRecordSet {
	
	public $Records;
	
	function Add ($Row) {
	
		$this->Records[] = $Row;
			
	} // Add
	
	
	
	function Retrieve ($RowNumber) {
		
		return $this->Records[$RowNumber];
		
	}
	
	
	
	function Count() {
	
		return count($this->Records);
			
	}
	
	
	
	function FindByKey($Key, $Value) {
		
		foreach($this->Records as $R) {
		
		  //print ("<br><pre>");
		  //print_r($R);
		  //print ("</pre><br>");
		  if($R[0][$Key] == $Value) return $R[0];
		  	
		}
		
		return NULL;
		
	}
	
	
	
}


?>
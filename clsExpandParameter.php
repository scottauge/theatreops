<?php

// Yes, this is a bit busy on the database server
// Here is the problem - each Next() or Prev() will requery the database for the entire
// result set.

include_once "clsParameter.php";

class clsExpandParameter extends clsParameter {

  private $endl = "<br>";
  private $CursorOffset = 0;
  private $Stmt;
  private $CountOfRows = 0;
  

  
  public function ForEachAll() {
	  
	$SQL = "select RecID from parameter order by Name";
    $this->Stmt = $this->DB->Connection->prepare($SQL);

    $this->AccessDatabase ();
	  
  } // AllRecords
  
  
  public function ForEachParameterByName($ipCategory) {
	  
	$SQL = "select RecID from parameter where Name like ? order by Name";
    $this->Stmt = $this->DB->Connection->prepare($SQL);
	$ipCategory = "%" . $ipCategory . "%";
    $this->Stmt->bind_param("s", $ipCategory);	
	
	$this->AccessDatabase ();
	
  }

  // ------------------------------------------------------------------
  //    Do not edit past here unless you know what you are doing
  // ------------------------------------------------------------------
  
  public function __construct ($DB) {
  
    $this->DB = $DB;
	
  } // Constructor

  
  public function AccessDatabase () {
	  
    $this->Stmt->execute();
    $this->Stmt->store_result();

    // Remember, the only consistent way of accessing the record
	// through the CRUD class is via FindByID()
	
    $this->Stmt->bind_result($this->RecID);	  
	
	$this->AccessRows();
	
  }
  
  
  public function AccessRows() {
	  
	$Count = 0;
	while ($this->Stmt->fetch()) {

	  if ($Count == $this->CursorOffset) {
		  
		// Remember this is access clsParameter inherited
	    $this->FindByID($this->RecID);  
	    break;
		
      }
	  
	  $Count++;
	} // while
	
  }
  
  
  public function NumberOfRows() {
	return $this->Stmt->num_rows;
  }
  
  
  public function NextRow() {
	$this->CursorOffset++;
	$this->AccessDatabase ();
  }
  
  
  public function PrevRow() {
	$this->CursorOffset--;
	$this->AccessDatabase ();
  }
  
  
  public function FirstRow() {
	$this->CursorOffset = 0;
	$this->AccessDatabase ();	  
  }
  
  
  public function LastRow() {
    $this->CursorOffset = $this->NumberOfRows () - 1;
	$this->AccessDatabase ();
  }
  
} // clsExpandParameter

?>
<?php
//
// Generated by tools/TableClass.php
// on Friday, 08-Jun-2018 16:18:25 EDT 
// $Header: file:///Users/scottauge/Documents/SVN/theatre/clsAudit.php 2 2019-06-20 18:03:22Z scottauge $
//


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


// This provides useful functions for the data such as RandonString
// and date format changers.

include_once ("clsUtil.php");

class clsAudit extends clsUtil {

  // Database object (usually clsDB.php) (mysqli based object)
  
  public $DB;
  
  // Database fields
  
  public $RecID;
  public $LoginRecID;
  public $WasValue;
  public $ToValue;
  public $DateTime;
  public $Operation;
  
  // Available attribute if FindByID() gets something.  
  
  private $_Available;

  //  If our find is ambiguous, set this flag

  private $_Ambiguous;
  
  // This is used for FindByQuery() which may have multiple record result set.
  // We need it to move to the next result set with the FetchByQuery() method.  We 
  // cannot go backwards as of yet.  Clean up with CloseByQuery().
  
  private $_S;
  
  // Sometimes we just need to loop through the number of records available
  
  public $NumRows;

  // --------------------------------------------------------------------------
  // Constructor
  // --------------------------------------------------------------------------
  
  public function __construct ($DB) {
  
    $this->DB = $DB;
  
  } // Constructor

  // --------------------------------------------------------------------------
  // Create a record. Note this does not put data into the record, only 
  // prepares a container for Update()
  // --------------------------------------------------------------------------
  
  public function Create () {
  
    
    $ID = self::RandomString(50);
    $SQL = "INSERT INTO Audit (RecID) VALUES (?)";
    $S = $this->DB->Connection->prepare($SQL);
    $S->bind_param("s", $ID);
    $S->execute();
    $S->close();    
    $this->RecID = $ID;

    // Load up our database defaults into the "buffer"

    $this->FindByID($ID);
  
  } // Create ()

  // --------------------------------------------------------------------------
  // Delete a record by it's key field
  // --------------------------------------------------------------------------
  
  public function Delete () {
  
    $SQL = "DELETE FROM Audit WHERE RecID = ?";
    $S = $this->DB->Connection->prepare($SQL);
    $S->bind_param("s", $this->RecID);
    $S->execute();
    $S->close();  
  
  } // Delete ()
  

  // --------------------------------------------------------------------------
  // This is what moves the data from the public properties into the database
  // --------------------------------------------------------------------------

  public function Update () {


    //
    // We are using parameterized SQL, there is no need for magic quotes on this stuff.
    // If any of it is on, then we want to remove slashes from the input because it comes
    // back out with the slashes.
    //

    if (get_magic_quotes_gpc() || ini_get("magic_quotes_runtime")) {

      $this->RecID = stripslashes($this->RecID);
      $this->LoginRecID = stripslashes($this->LoginRecID);
      $this->WasValue = stripslashes($this->WasValue);
      $this->ToValue = stripslashes($this->ToValue);
      $this->DateTime = stripslashes($this->DateTime);
      $this->Operation = stripslashes($this->Operation);

    } // if magic used

    //
    //  Warning!  Generator doesn't handle blob fields very well.  You may need to do some
    //            hand coding with MySQLi's Stmt->send_long_data() to properly update.  If
    //            the blob exceeds MYSQLs packet size (the DB, not PHP) then corruption is
    //            guaranteed.
    //            Use
    //                mysql> SHOW VARIABLES LIKE 'max_allowed_packet';
    //            to determine the size of data you're set up for.
    //

  
    $SQL = "UPDATE Audit SET LoginRecID = ?, WasValue = ?, ToValue = ?, DateTime = ?, Operation = ? WHERE RecID = ?";
    $S = $this->DB->Connection->prepare($SQL);
    $S->bind_param("ssssss", $this->LoginRecID, $this->WasValue, $this->ToValue, $this->DateTime, $this->Operation,$this->RecID);
    $S->execute();
    $S->close();  
  
  } // Update ()


  // --------------------------------------------------------------------------
  // On returns from the web, often we have the key fields value or it is 
  // stored in a session table.  Given the key field's value, find it and load
  // into the class.
  // --------------------------------------------------------------------------
  
  public function FindByID ($ID) {
  
    $SQL = "SELECT RecID, LoginRecID, WasValue, ToValue, DateTime, Operation FROM Audit WHERE RecID = ?";
    $S = $this->DB->Connection->prepare($SQL);
    $S->bind_param("s", $ID);
    
    // This order is very important for dealing with BLOBs and other large data types

    $S->execute();
    $S->store_result();
    $S->bind_result($this->RecID, $this->LoginRecID, $this->WasValue, $this->ToValue, $this->DateTime, $this->Operation);

    // This order is very important, store_result() needs to be called before num_rows is set
    
    $this->SetAvailable ($S);
    $this->SetAmbiguous ($S);

    $S->fetch();
    $S->close();
  
  } // FindByID ()
  
  
  
  // --------------------------------------------------------------------------
  // MIGHT BE FASTER TO DO A QUERY OUTSIDE THIS CLASS FOR THE KeyField AND
  // THEN USE THIS CLASS WITH A FINDBYID() ON INDIVIDUAL RECORDS
  // --------------------------------------------------------------------------
  // ArrayArgs should be in the form and order needed for bind_param
  // SQL is {table} WHERE {find clause}, fields are automatically taken 
  // care of.
  // For queries that may have more than one record, one will want to use
  // FetchByQuery() and CloseByQuery() to move around and clean up.
  // Example $T->FindByQuery ("Bin where Bin = ? and location = ?",
  //                          array("ss", "$T->bin,$T->location") ???
  // Note if you have multiple rows, you may want to keep the result set in
  // one class, and create a class for manipulating the records with FindById()
  // --------------------------------------------------------------------------
  
  public function FindByQuery ($SQL, $ArrayArgs) {

    $SQL = "SELECT RecID, LoginRecID, WasValue, ToValue, DateTime, Operation FROM " . $SQL;
    $this->_S = $this->DB->Connection->prepare($SQL);
    
    // Need to use a callback to bind unknown arts
    
    if (strpos($SQL, "?") != FALSE) {
      call_user_func_array(array($this->_S, "bind_param"), $ArrayArgs);
    }
    
    // This order is very important for dealing with BLOBs and other large data types

    $this->_S->execute();
    $this->_S->store_result();
    $this->_S->bind_result($this->RecID, $this->LoginRecID, $this->WasValue, $this->ToValue, $this->DateTime, $this->Operation);
    
    // When doing this, auto load the first data set
    
    $this->_S->fetch();

    // This order is very important, store_result() needs to be called before num_rows is set
    
    $this->SetAvailable ($this->_S);
    $this->SetAmbiguous ($this->_S);
  
  } // FindByQuery ()  

  // --------------------------------------------------------------------------
  // Close the query
  // --------------------------------------------------------------------------
  
  public function CloseByQuery () {
  
     $this->_S->close();
     
  } // CloseByQuery ()
  
  // --------------------------------------------------------------------------
  // Allow the query to pull up the next row
  // --------------------------------------------------------------------------
  
  public function FetchByQuery () {
  
    $this->_S->fetch();
    
  } // FetchByQuery ()
  
  // --------------------------------------------------------------------------
  // Determines if a record was available.
  // --------------------------------------------------------------------------

  public function Available() {

    return $this->_Available;

  } // Available()

  // --------------------------------------------------------------------------
  // Determine if the query found something
  // --------------------------------------------------------------------------

 private function SetAvailable ($S) {

    $this->_Available = ($S->num_rows > 0) ? 1 : 0;

  } // SetAvailable()

  // --------------------------------------------------------------------------
  // Determine if the FindBy*() was ambiguous.
  // --------------------------------------------------------------------------

  public function Ambiguous() {

    return $this->_Ambiguous;

  } // Available()

  // --------------------------------------------------------------------------
  // Tool to help set Ambiguous from what ever FindBy*() used.
  // --------------------------------------------------------------------------

  private function SetAmbiguous ($S) {

    if ($S->num_rows < 2)
      $this->_Ambiguous = 0;
    else
      $this->_Ambiguous = ($S->num_rows);
      
    $this->NumRows = $S->num_rows;

  } // SetAmbiguous ()


} // class

/****** Unit Test

include_once ("clsDB.php");
include_once ("clsAudit.php");

$T = new clsAudit ($DB);

$T->Create();

$T->RecID = ...;
$T->LoginRecID = ...;
$T->WasValue = ...;
$T->ToValue = ...;
$T->DateTime = ...;
$T->Operation = ...;

$T->Update();
// $T->Delete();


unset ($T);
unset ($DB);

*****/


?>
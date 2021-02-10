<!-- $Header: file:///Users/scottauge/Documents/SVN/theatre/incSubstitutionRules.php 22 2019-07-13 02:04:19Z scottauge $ -->
<?php


// -----------------------------------------------------------------------------
// NOTE: This substition assumes MainList is used in someway
// -----------------------------------------------------------------------------



function ApplySubstitutionRule($Body, &$Data) {
	
	foreach($Data as $Key => $Value) {

		 //print $Key . " " . $Value;


		switch ($Key) {
			
			// For MainList (Members)
			
			case "Name":
				$Body = str_replace("%NAME%", $Value, $Body);
				break;
				
			case "Phone":
				$Body = str_replace("%PHONE%", $Value, $Body);
				break;
				
			case "Address1":
				$Body = str_replace("%ADDRESS1%", $Value, $Body);
				break;
				
			case "Address2":
				$Body = str_replace("%ADDRESS2%", $Value, $Body);
				break;
				
			case "City":
				$Body = str_replace("%CITY%", $Value, $Body);
				break;
				
			case "State":
				$Body = str_replace("%STATE%", $Value, $Body);
				break;
				
			case "Zip":
				$Body = str_replace("%ZIP%", $Value, $Body);
				break;
				
			case "Email":
				$Body = str_replace("%EMAIL%", $Value, $Body);
				break;																								
						
			// For Vendor (some above will fill in
			
			case "CompanyName":
				$Body = str_replace("%COMPANYNAME%", $Value, $Body);
				break;	
				
			case "ContactName":
				$Body = str_replace("%CONTACTNAME%", $Value, $Body);
				break;	
				
			case "ContactPhone":
				$Body = str_replace("%CONTACTPHONE%", $Value, $Body);
				break;	
				
			case "ContactEmail":
				$Body = str_replace("%CONTACTEMAIL%", $Value, $Body);
				break;	
										
			// For Advertisers
			
			case "AdvertiserName":
				$Body = str_replace("%ADVERTISERNAME%", $Value, $Body);
				break;				
			
			case "AdvertiserPhone":
				$Body = str_replace("%ADVERTISERPHONE%", $Value, $Body);
				break;		
			
			// Vendors
			
			case "CompanyName":
				$Body = str_replace("%COMPANYNAME%", $Value, $Body);
				break;	
				
			// Membership info
			
			case "StartDate":
				$Body = str_replace("%MEMBERSTARTDATE%", $Value, $Body);
				break;
				
			case "EndDate":
				$Body = str_replace("%MEMBERENDDATE%", $Value, $Body);
				break;
				
			case "Payment":
				$Body = str_replace("%MEMBERPAYMENT%", $Value, $Body);
				break;											
																			
		} // switch

	} // foreach
	
        return $Body;

} // ApplySubstitutionRule()




/*
$Body = "Hello, %NAME%, Your phone is %PHONE%.";

$Data = array(
  "Name" => "Scott", 
  "Phone" => "408-205-5743"
  );

print ApplySubstitutionRule($Body, $Data);
*/
?>
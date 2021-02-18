# theatreops
Tool for live theatre to manage customer relationships and inventory

# Build 202148194209

- Added DB tables InventoryLocation, Part, PartToInventoryLocation, Presentation
- Added CRUD classes for above tables
- Admin should add:
  "Inventory.Category" to parameters like "Costume,Lighting,Sound,Building Maintenance,Prop"
  "Inventory.Building" like "Set Building,Main Building"
  "Inventory.Room" like "Property Room,Lighting Room,Stage,Costume Shop,Shop Balcony"
  "Inventory.Shelving" like "1,2,3,4"  (like a rack of shelving)
  "Inventory.Shelf" like "1,2,3"
  "Inventory.Slot" like "1,2,3,4,5,6,7,8,9,10" (a space on the shelf)
* Added Inventory and Show to menu
* Pages for inventory
* Pages for show

# Build 202148160656

- Various changes to tools/TableClass.php to prevent NOTICE errors

# Build 202141220842

- get it up and going on latest php and mysql (community)  PHP Version 7.4.10 / Server version: 10.4.14-MariaDB - mariadb.org binary distribution(mysql compatible)  (from xampp on windows 10)
- money_format() has been deleted by Zend, replaced with number_format().  NumberFormatter not available in my php!
- use nonotice.php to eliminate notices (generally around unavailable $_POST[] array indices)
- added buildnumber.php so don't need to go to UNIX for it all the time
- Removed get_magic_quotes_gpc() as everything uses parameter SQL (or it should!)  Will comment until cleanup

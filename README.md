# theatreops
Tool for live theatre to manage customer relationships and inventory

# Build 202141220842

- get it up and going on latest php and mysql (community)  PHP Version 7.4.10 / Server version: 10.4.14-MariaDB - mariadb.org binary distribution(mysql compatible)  (from xampp on windows 10)
- money_format() has been deleted by Zend, replaced with number_format().  NumberFormatter not available in my php!
- use nonotice.php to eliminate notices (generally around unavailable $_POST[] array indices)
- added buildnumber.php so don't need to go to UNIX for it all the time
- Removed get_magic_quotes_gpc() as everything uses parameter SQL (or it should!)  Will comment until cleanup

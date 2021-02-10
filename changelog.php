<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Change Log</title>
</head>

<!--
$Id: changelog.php 26 2019-07-31 20:19:36Z scottauge $
/**************************************************************************/
/*                                                                        */
/* AMDUUS INFORMATION WORKS, INC. CONFIDENTIAL                            */
/* ------------------                                                     */
/*                                                                        */
/*  Copyright 2012 Amduus Information Works Incorporated and Scott Auge   */
/*  All Rights Reserved.                                                  */
/*                                                                        */
/* NOTICE:  All information contained herein is, and remains              */
/* the property of Amduus Information Works Incorporated and its          */
/* suppliers, if any.  The intellectual and technical concepts contained  */
/* herein are proprietary to Amduus Information Works Incorporated        */
/* and its suppliers and may be covered by U.S. and Foreign Patents,      */
/* patents in process, and are protected by trade secret or copyright     */
/* law.  Dissemination of this information or reproduction of this        */
/* material is strictly forbidden unless prior written permission is      */
/* obtained from Amduus Information Works Incorporated or Scott Auge.     */
/**************************************************************************/

Keyword Substitution
svn propset svn:keywords "Id Header" file.txt

-->

<body>
<p><strong>TODO<br />
</strong><strong><br />
</strong>See development system tasks....</p>
<p><strong>Build 20190731160700</strong></p>
<p>- Add CSS Markup to &quot;pretty up&quot; screen<br />
  - Using Title in incAppTitle.php
</p>
<p><strong>Build</strong></p>
<p>- Added instructions to printing letters as is not obvious what to do on the new screen for people unfamiliar with computers (yes, there are still some!)<br />
- On member screen - the 0000-00-00 is reappearing again!  New strategy implemented.<br />
- When printing letters to non-members, everyone is coming out with repeats.  (Related to above.)
<br />
- When printing letters to members, no one is appearing! (Printing to all members works though).<br />
- Created cleardb.sql as part of demo refresh section.
<br />
- Added membership start, end, and payment place holders in letter writing
</p>
<p><strong>Build 20190710180753</strong></p>
<p>- Add Advertisers to printing letters<br />
  - Add Advertisers to emails
  <br />
  - Add Vendors to printing letters
  <br />
  - Add Vendors to emails
</p>
<p><strong>Build 20190710140725</strong></p>
<p>- Put security on parameters page for demo users who might try to send out emails (Mail can be turned on/off via parameter.<br />
- Put security on My Account screens for demo users who might try modify their account or add an account. Can't have demo/demo changing their password!<br />
- FrontPageMessage parameter added for logins (index.php)
</p>
<p><strong>Build</strong> <strong>20190709200708</strong></p>
<p>- Use BarCode color on various screens<br />
</p>
<p><strong>Build</strong> </p>
<p>- Parameterize Time Zone &quot;TimeZone&quot; for use with date()<br />
  - Parameterize Bar Color &quot;BarColor&quot; for use with multiple row reports<br />
  - Add LastUsed field to Session  table for auto logout logic<br />
SQL = ALTER TABLE `Session`  ADD `LastUsed` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'For auto time outs' ;<br />
- Change incLoginSession.php to search for timed out logins and clear them from the table.<br />
- Added parameter SessionTimeOut
<br />
- Session to fully qualified server name for instances of program in subdomains
</p>
<p><strong>Build 20190709000740</strong></p>
<p>- Added a suggestion box which is an email directly to me<br />
  - New Advertiser, Search Advertiser, Update Advertiser, Report on Advertiser<br />
  - Minor Bug Fixes
</p>
<p><strong>Build 20190702140748</strong></p>
<p>- Added Contact Table and CRUD class<br />
  - Added Advertisers Table and CRUD class<br />
  - Added AdvertiserSale table and CRUD class<br />
- Added newadvertisers.php, searchadvertisers.php, updateadvertisers.php, and updated the menu.</p>
<p><strong>Build 20190620230615</strong></p>
<p>- Added Vendor Table<br />
  - Added Vendor CRUD Class<br />
  - Added New Vendor Page newvendor.php<br />
- Added Search Vendor searchvendor.php<br />
- Added Updating Vendor updatevendor.php
<br />
  - Added Vendor Menu Itens</p>
<p><strong>Build 20190620140628</strong></p>
<p>- Allow deleting of members<br />
  - Bar Coding of lists<br />
  - Corrected centering for searchpeople.php
</p>
<p><strong>Build 20190305220303</strong></p>
<p>- Added TinyMCE editor<br />
  - Added Editing/Creating Letters<br />
  - Added Parameters Editor and added to Admin on Menu<br />
  - Added Email Tool
  <br />
- Defaults on updating tasks to what is in the DB, not general defaults<br />
- Signal &quot;Saved&quot; on editmessage.php only when it is actually saved
<br />
- Default &quot;As Of&quot; to today in rptbymembership.php
<br />
- Printing letters to Non-members would bring everyone up twice
<br />
- Cleaned up Parameter Maintenance
</p>
<p><strong>Build 20181002201040</strong></p>
<p>- Created help system for pages in the application. Quite a bit of explaination will be needed for the app and for creating these pages. Will add help later per page.<br />
  - Begin a tool to print out letters for sending to members, expired members, or all. (Campaign and Letter tables, incSubstitiution.php, Menu Items)<br />
  - 
</p>
<p><strong>Build 20180927220931</strong></p>
<p>- Names in alphabetical order on search people (searchpeople.php)<br />
  - Changed search criteria to be like other screens<br />
  - Allow superuser concept to accounts and allow them to create other accounts (suaccount.php)
</p>
<p><strong>Build 20180916170956</strong></p>
<p>- Corrected SQL in Membership Report<br />
  - Corrected dates to US format in updatepeople.php
</p>
<p><strong>Build 20180903110950</strong></p>
<p>- Added rptbymembership.php and underlying tables<br />
  - Added advertisers to menu<br />
  - Added security tables<br />
  - Added Advertiser tables
  <br />
</p>
<p><strong>Build 20180827220819</strong></p>
<p>- Added title and priority to tasks<br />
  - Updated clsTasks.php
  <br />
  - Added color around inputs on pages
  <br />
  - Added Report By Membership to menu
  <br />
- Small bug in updatepeople.php where blank membership creates 0000-00-00 records on submit.  Change to &lt;&gt; &quot;&quot; instead of isset(). </p>
<p><strong>Build 20180819120851</strong></p>
<p>- Add Membership table and non-UI coding<br />
  - UI Coding to add memberships
  <br />
  - Delete memberships  <br />
</p>
<p><strong>Build 20180808160812</strong></p>
<p>- Added &quot;By Activity&quot; report<br />
  - Brand Amduus In The HTML Source  <br />
  - Put into Source Code Control  <br>
</p>
<p><strong>Build 20180723200702</strong></p>
<p>- Added Change Log and menu Admin | Change Log<br />
  - Corrected Note on searchpeople.php<br />
- Created build system<br />
- Changed input width on index.php
<br />
- Created Tasks table and added to production<br />
- Created CRUD object for Tasks
<br />
- Created tasks.php , updatetask.php
<br />
- Created Tasks Menu Item (Likely to change)
</p>
<p><br />
  Header $Header: file:///Users/scottauge/Documents/SVN/theatre/changelog.php 26 2019-07-31 20:19:36Z scottauge $<br />
</p>
<p>Command date &quot;+%c%m%d%H%m%S&quot; </p>
<p>Keyword Substitution<br />
svn propset svn:keywords &quot;Id Header&quot; file.txt</p>
</body>
</html>
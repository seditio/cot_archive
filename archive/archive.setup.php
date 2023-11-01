<?php
/* ====================
[BEGIN_COT_EXT]
Code=archive
Name=[SEDBY] Archive
Category=navigation-structure
Description=Publications archive
Version=1.00b
Date=2023-10-22
Author=Dmitri Beliavski
Copyright=&copy; 2023 sed.by
Notes=Add-on for various *list plugins
Auth_guests=R
Lock_guests=W12345A
Auth_members=R
Lock_members=W12345A
Requires_modules=
Requires_plugins=hits,cotlib
[END_COT_EXT]
[BEGIN_COT_EXT_CONFIG]
filter=00:separator:::
catmode=01:radio::1:Categories list mode
catlist=02:string::system:Categories list
misc=10:separator:::
home_style=11:radio::0:Only current year at archive homepage
[END_COT_EXT_CONFIG]
==================== */

/**
* Archive Plugin / Setup
*
* @package archive
* @author Dmitri Beliavski
* @copyright (c) 2023 sed.by
*/

defined('COT_CODE') or die('Wrong URL');

<?php // $Revision$

/************************************************************************/
/* phpAdsNew 2                                                          */
/* ===========                                                          */
/*                                                                      */
/* Copyright (c) 2001 by the phpAdsNew developers                       */
/* http://sourceforge.net/projects/phpadsnew                            */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/



// Include required files
require ("config.php");
require ("lib-statistics.inc.php");



/*********************************************************/
/* Main code                                             */
/*********************************************************/

$res = phpAds_dbQuery("
	SELECT
		*
	FROM
		".$phpAds_config['tbl_banners']."
	WHERE
		bannerid = $bannerid
	") or phpAds_sqlDie();



if ($res)
{
	$row = phpAds_dbFetchArray($res);
	
	echo "<html><head><title>".phpAds_buildBannerName ($bannerid, $row['description'], $row['alt'])."</title>";
	echo "<link rel='stylesheet' href='interface.css'></head>";
	echo "<body marginheight='0' marginwidth='0' leftmargin='0' topmargin='0' bgcolor='#EFEFEF'>";
	echo "<table cellpadding='0' cellspacing='0' border='0'>";
	echo "<tr height='32'><td width='32'><img src='images/cropmark-tl.gif' width='32' height='32'></td>";
	echo "<td>&nbsp;</td><td width='32'><img src='images/cropmark-tr.gif' width='32' height='32'></td></tr>";
	echo "<tr><td width='32'>&nbsp;</td><td bgcolor='#FFFFFF'>";
	
	if ($row['format'] == 'html')
		echo stripslashes ($row['banner']);
	else
		echo phpAds_buildBannerCode ($row['bannerid'], $row['banner'], true, $row['format'], $row['width'], $row['height'], $row['bannertext']);
	
	echo "</td><td width='32'>&nbsp;</td></tr>";
	echo "<tr height='32'><td width='32'><img src='images/cropmark-bl.gif' width='32' height='32'></td>";
	echo "<td>&nbsp;&nbsp;&nbsp;width: ".$row['width']."&nbsp;&nbsp;height: ".$row['height']."&nbsp".($row['bannertext'] ? '+ text&nbsp;' : '')."</td><td width='32'>";
	echo "<img src='images/cropmark-br.gif' width='32' height='32'></td></tr>";
	echo "</table>";
	
	echo "</body></html>";
}


?>
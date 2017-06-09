<?php
/* 
 ********************************************************************
 | Copyright (c) 2007-2016 Clip-Bucket.com. All rights reserved.	
 | @ Author : ArslanHassan											
 | @ Software : ClipBucket
 | @ Modified : June 9, 2016 by Saqib Razzaq								
 ********************************************************************
*/

	define("THIS_PAGE",'403');
	require 'includes/config.inc.php';

	if(file_exists(LAYOUT."/403.html")) {
		template_files('403.html');
		$videos = $cbvid->get_videos(array("order"=>"date_added DESC","limit"=>4));
		assign('videos',$videos);
	} else {
		$data = "403_error";
		if(has_access('admin_access')) {
			e(sprintf(lang("err_warning"),"403","http://docs.clip-bucket.com/?p=154"),"w");		
		}
		e(lang($data));
		
	}

	display_it();

?>
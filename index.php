<?php

	/**
	* File: Index
	* Description: This is home page of your wesbite. Anyone who lands on your website
	* using home page URL will see this page first
	* @author: Arslan Hassan
	* @since: 2007, ClipBucket v2.0
	* @website: clip-bucket.com
	* Copyright (c) 2007-2016 Clip-Bucket.com. All rights reserved
	*/
	header('Access-Control-Allow-Origin: *');
	define('THIS_PAGE','index');
	require 'includes/config.inc.php';
	$pages->page_redir();
	if(is_installed('editorspick')) {
		assign('editor_picks',get_ep_videos());
	}

	//Displaying The Template
	template_files('index.html');
	display_it();

?>

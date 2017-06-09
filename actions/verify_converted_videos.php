<?php

/**
 * This file is used to verify weather video is converted or not
 * if it is converted then activate it and let it go
 */
 
//Sleeping..
//sometimes video is inserted after video conversion so in this case, video can get lost

// sometimes this file gets executed before video insertion completes
// so it needs to be put to sleep for a short short time
sleep(5);
$in_bg_cron = true;

include(dirname(__FILE__)."/../includes/config.inc.php");

cb_call_functions('verify_converted_videos_cron');

if($argv[1])
	$fileName = $argv[1];
else
	$fileName = false;

if(isset($_GET['filename']))
	$fileName = $_GET['filename'];


$files = get_video_being_processed($fileName);



if(is_array($files))
foreach($files as $file)
{
	$file_details = get_file_details($file['cqueue_name'],true);
	
	
	//Thanks to pandusetiawan @ forums.clip-bucket.com

	
	if($file_details['conversion_status']=='failed' or strpos($file_details['conversion_log'],'conversion_status : failed') >0)
	{
		
		update_processed_video($file,'Failed',$ffmpeg->failed_reason);


		$db->update(tbl("conversion_queue"),
		array("cqueue_conversion"),
		array("yes")," cqueue_id = '".$file['cqueue_id']."'");
		
		
		/**
		 * Calling Functions after converting Video
		 */
		if(get_functions('after_convert_functions'))
		{
			foreach(get_functions('after_convert_functions') as $func)
			{
				if(@function_exists($func))
					$func($file_details);
			}
		}
		

	}elseif($file_details['conversion_status']=='completed' or strpos($file_details['conversion_log'],'conversion_status : completed') >0 or $file_details['conversion_status']=='Successful' or strpos($file_details['conversion_log'],'conversion_status : Successful') >0)
	{
		

	
		update_processed_video($file,'Successful');
		setVideoStatus($file['cqueue_name'], 'done',true,true);
		$db->update(tbl("conversion_queue"),
		array("cqueue_conversion","time_completed"),
		array("yes",time())," cqueue_id = '".$file['cqueue_id']."'");
		
		
		
		/**
		 * Calling Functions after converting Video
		 */
		if(get_functions('after_convert_functions'))
		{
			foreach(get_functions('after_convert_functions') as $func)
			{
				if(@function_exists($func))
					$func($file_details);
			}
		}
		
		//Sending Subscription Emails
		$videoDetails = $cbvideo->get_video($file['cqueue_name'],true);
		if($videoDetails)
		{
			if( ($videoDetails['broadcast']=='public' || 
				$videoDetails['logged']) && 
					$videoDetails['active']=='yes')
			{
				$userquery->sendSubscriptionEmail($videoDetails,true);
			}
		}			
	}
}
?>
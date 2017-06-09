<?php

if ($_GET["url-oembed"])
 { $id = $_GET["url-oembed"]; }
else
 {
  $url = $_GET["url"];
  preg_match("/\/video\/(\d+)/i", $url, $videoid_array);
  $id = $videoid_array[1];
 }
$provider = "imvideo.eu";
$host= "http://imvideo.eu";
$player_width = "640";
$player_height = "360";
$author_name = "Imsotec AGENTIE INTERNET S.R.L";
$author_url = "http://imvideo.eu";
$thumbnail_width = "640";
$thumbnail_height = "360";
$video["image_url"]= "http://imvideo.eu/styles/cb_28/theme/images/logo.png";
$video["iframe"] = "<iframe sandbox=\"allow-same-origin allow-scripts allow-popups allow-forms\" src=\"$host/player/embed_player.php?vid=$id\" width=\"$player_width\" height=\"$player_height\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen scrolling=\"no\"></iframe>";
$video["title"] = "Titlul test";

$r["version"] = "1.0";
$r["type"] = "video";
$r["title"] = $video["title"];
$r["provider_name"] = $provider;
$r["provider_url"] = $host;
$r["author_name"] = $author_name;
$r["author_url"] = $author_url;
$r["html"] = $video["iframe"];
$r["thumbnail_url"] = $video["image_url"];
$r["thumbnail_height"] = $thumbnail_height;
$r["thumbnail_width"] = $thumbnail_width;

header('Content-type: application/json');
$out = json_encode($r);
print $out;



?>
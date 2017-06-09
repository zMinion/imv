<?php
$url = 'http://imsotec-srl00.eu:81/video/1033/amazing-nature-time-lapse';

preg_match("/\/video\/(\d+)/i", $url, $output_array);

print $output_array[1];
?>
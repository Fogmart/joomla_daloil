<?php
    $doc = JFactory::getDocument();
    if(isset($_GET['start'])){
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $uri_parts[0];
    	$doc->addCustomTag("<link rel='canonical' href='$url'>");
    }

?>

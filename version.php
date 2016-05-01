<?php

// This script outputs a JSON object that informs of the current stable
// version of FreeCAD

$json = array();   

$bus = array(
    'major' => 0,
    'minor' => 16,
    'build' => 6703
);
array_push($json, $bus);

$jsonstring = json_encode($json);

if(array_key_exists('callback', $_GET)){
    $callback = $_GET['callback'];
    echo $callback.'('.$jsonstring.');';
} else {
    echo $jsonstring;
}

die();

?>

<?php
$category = $_REQUEST['category'] ?? '';
if (!in_array($category, ['', 'events', 'grants', 'releases'])) {
    header("HTTP/1.1 400 Bad Request");
    die('Unhandled category');
}

$url = 'https://blog.freecad.org'.($category != '' ? '/category/'.$category : '').'/feed/';
$response = file_get_contents($url);

header('Content-Type: application/xml');
echo $response;

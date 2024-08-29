<?php
if (isset($_GET['url'])) {
    $url = $_GET['url'];

    if (filter_var($url, FILTER_VALIDATE_URL)) {
        $response = file_get_contents($url);

        header('Content-Type: application/xml');
        echo $response;
    } else {
        header("HTTP/1.1 400 Bad Request");
    }
} else {
    header("HTTP/1.1 400 Bad Request");
}

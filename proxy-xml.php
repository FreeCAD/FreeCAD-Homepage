<?php
$whitelist = [
    'blog.freecad.org'
];

function is_url_safe($url, $whitelist) {
    $parsed = parse_url($url);
    if (!$parsed || !isset($parsed['host'])) {
        return false;
    }

    $host = strtolower($parsed['host']);

    if (in_array($host, $whitelist)) {
        return true;
    }

    $ip = gethostbyname($host);
    if ($ip === $host) {
        return false;
    }

    if (in_array($ip, $whitelist)) {
        return true;
    }

    return false;
}

$url = $_GET['url'] ?? '';
if (is_url_safe($url, $whitelist)) {
    $response = file_get_contents($url);
    header('Content-Type: application/xml');
    echo $response;
} else {
    echo "URL not allowed";
}
?>

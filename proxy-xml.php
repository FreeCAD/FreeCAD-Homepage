<?php
    $whitelist = [
        'blog.freecad.org'
    ];

    function is_url_safe($url, $whitelist) {
        $parsed = parse_url($url);
        if (!$parsed || !isset($parsed['host']) || !isset($parsed['scheme'])) {
            return false;
        }

        if (!in_array($parsed['scheme'], ['http', 'https'])) {
            return false;
        }

        $host = strtolower($parsed['host']);

        if (!in_array($host, $whitelist)) {
            return false;
        }

        return true;
    }

    $url = $_GET['url'] ?? '';

    if (empty($url)) {
        echo "No URL provided";
    } elseif (is_url_safe($url, $whitelist)) {
        $response = file_get_contents($url);
        header('Content-Type: application/xml');
        echo $response;
    } else {
        echo "URL not allowed";
    }
?>

<?php

function loadLocaleMap($filePath)
{
    if (!file_exists($filePath)) {
        throw new Exception("File not found: $filePath");
    }

    $jsonData = file_get_contents($filePath);
    $localeMap = json_decode($jsonData, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Invalid JSON in $filePath: " . json_last_error_msg());
    }

    return $localeMap;
}

function getFlags($href = '/')
{
    $localeMap = loadLocaleMap(__DIR__ . '/localeMap.json');

    // Default English entry
    echo('<a class="dropdown-item" href="' . $href . '">
            <img src="lang/en/flag.jpg" alt="" />' . _('English') . '</a>');

    foreach ($localeMap as $shortCode => $locale) {
        if ($shortCode === 'en') {
            continue;
        }
        $localeObj = locale_get_display_language($locale, $locale);
        if (!$localeObj) {
            $localeObj = $locale; // fallback
        }
        $flagcode = isset($localeMap[$shortCode]) ? $localeMap[$shortCode] : $shortCode;

        echo('<a class="dropdown-item" href="' . $href . '?lang=' . $shortCode . '">
                <img src="lang/' . $flagcode . '/flag.jpg" alt="" />' . _($localeObj) . '</a>');
    }
}


function getLangParam(): string {
    if (empty($_GET['lang'])) {
        return 'en';
    }
    $lang = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET['lang']);
    return $lang !== '' ? $lang : 'en';
}

$lang = getLangParam();
$localeMap = loadLocaleMap(__DIR__ . '/localeMap.json');
$locale = isset($localeMap[$lang]) ? $localeMap[$lang] : $lang;
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("homepage", "lang");
textdomain("homepage");
bind_textdomain_codeset("homepage", 'UTF-8');

$flagcode = isset($localeMap[$lang]) ? $localeMap[$lang] : $lang;

if (!file_exists('lang/'.$flagcode."/flag.jpg")) {
    if (strpos($flagcode, '_') !== false) {
        $flagcode = $lang;
    }
}
$langStr    = "?lang=" . urlencode($lang);
$langattrib = "&lang=" . urlencode($lang);

function getTranslatedDownloadLink() {
    $lang = getLangParam();
    echo "downloads.php?lang=" . urlencode($lang);
}

?>

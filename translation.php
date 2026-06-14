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

$localeMap = loadLocaleMap(__DIR__ . '/localeMap.json');

function getFlags($href = '/')
{
    global $localeMap;

    // Default English entry
    echo('<a class="dropdown-item" href="' . $href . '">
            <img src="lang/en/flag.jpg" alt="" />' . _('English') . '</a>');

    foreach ($localeMap as $shortCode => $locale) {
        if ($shortCode === 'en') {
            continue;
        }
        $localeName = locale_get_display_language($locale, $locale) ?: $locale;
        echo('<a class="dropdown-item" href="' . $href . '?lang=' . $shortCode . '">
                <img src="lang/' . $locale . '/flag.jpg" alt="" />' . htmlentities($localeName) . '</a>');
    }
}

$lang = $_GET['lang'] ?? "en";
$localeMapFlip = array_flip($localeMap);
$locale = $localeMap[$lang] ?? $lang;
$lang = $localeMapFlip[$locale] ?? "en";
if ($lang == "en") $locale = "en";
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("homepage", "lang");
textdomain("homepage");
bind_textdomain_codeset("homepage", 'UTF-8');

$flagcode = $locale;
$langStr    = "?lang=" . urlencode($lang);
$langattrib = "&lang=" . urlencode($lang);

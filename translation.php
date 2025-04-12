<?php

$localeMap = array(
    'en' => 'en_US',
    'be' => 'be_BY',
    'ca' => 'ca_ES',
    'de' => 'de_DE',
    'es' => 'es_ES',
    'fa' => 'fa_IR',
    'fi' => 'fi_FI',
    'fr' => 'fr_FR',
    'hr' => 'hr_HR',
    'it' => 'it_IT',
    'ja' => 'ja_JP',
    'ka' => 'ka_GE',
    'pl' => 'pl_PL',
    'ru' => 'ru_RU',
    'uk' => 'uk_UA',
    'hu' => 'hu_HU',
    'cs' => 'cs_CZ',
    'nl' => 'nl_NL',
    'pt' => 'pt_BR',
    'zh' => 'zh_CN',
    'zh' => 'zh_TW',
    'es' => 'es_CO',
    'eu' => 'eu_ES',
    'sr' => 'sr_RS',
    'sr' => 'sr_RS',
    'el' => 'el_GR',
    'tr' => 'tr_TR',
);

$lang = "en";
if (isSet($_GET["lang"])) $lang = $_GET["lang"];
$locale = isset($localeMap[$lang]) ? $localeMap[$lang] : $lang;
putenv("LC_ALL=$locale");
setlocale(LC_ALL, $locale);
bindtextdomain("homepage", "lang");
textdomain("homepage");
bind_textdomain_codeset("homepage", 'UTF-8');

$flagcode = $lang;

if (!file_exists('lang/'.$flagcode."/flag.jpg")) {
if (strpos($flagcode, '_') !== false) {
$flagcode = explode("_", $flagcode)[0];
}
}
$langattrib = "";
$langStr = "";
if ($_GET["lang"] != "") {$langStr = "?lang=".$_GET["lang"];
    $langattrib = "&lang=".$_GET["lang"];
}function getFlags($href='/') {
    echo('						<a class="dropdown-item" href="'.$href.'"><img src="lang/en/flag.jpg" alt="" />'._('English').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=be"><img src="lang/be/flag.jpg" alt="" />'._('Belarusian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ca"><img src="lang/ca/flag.jpg" alt="" />'._('Catalan').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=de"><img src="lang/de/flag.jpg" alt="" />'._('German').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=es_ES"><img src="lang/es_ES/flag.jpg" alt="" />'._('Spanish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fa"><img src="lang/fa/flag.jpg" alt="" />'._('Persian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fi"><img src="lang/fi/flag.jpg" alt="" />'._('Finnish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fr"><img src="lang/fr/flag.jpg" alt="" />'._('French').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=hr"><img src="lang/hr/flag.jpg" alt="" />'._('Croatian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=it"><img src="lang/it/flag.jpg" alt="" />'._('Italian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ja"><img src="lang/ja/flag.jpg" alt="" />'._('Japanese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ka"><img src="lang/ka/flag.jpg" alt="" />'._('Georgian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=pl"><img src="lang/pl/flag.jpg" alt="" />'._('Polish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ru"><img src="lang/ru/flag.jpg" alt="" />'._('Russian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=uk"><img src="lang/uk/flag.jpg" alt="" />'._('Ukrainian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=hu"><img src="lang/hu/flag.jpg" alt="" />'._('Hungarian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=cs"><img src="lang/cs/flag.jpg" alt="" />'._('Czech').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=nl"><img src="lang/nl/flag.jpg" alt="" />'._('Dutch').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=pt_BR"><img src="lang/pt_BR/flag.jpg" alt="" />'._('Portuguese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=zh_CN"><img src="lang/zh_CN/flag.jpg" alt="" />'._('Chinese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=zh_TW"><img src="lang/zh_TW/flag.jpg" alt="" />'._('Chinese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=es_CO"><img src="lang/es_CO/flag.jpg" alt="" />'._('Spanish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=eu"><img src="lang/eu/flag.jpg" alt="" />'._('Basque').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sr"><img src="lang/sr/flag.jpg" alt="" />'._('Serbian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sr_CS"><img src="lang/sr_CS/flag.jpg" alt="" />'._('Serbian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=el"><img src="lang/el/flag.jpg" alt="" />'._('Greek').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=tr"><img src="lang/tr/flag.jpg" alt="" />'._('Turkish').'</a>');
}

function getTranslatedDownloadLink() {
    $tr = "";
    if (isSet($_GET["lang"])) {
        $tr = "?lang=".$_GET["lang"];
    }
    echo("downloads.php".$tr);
}
?>

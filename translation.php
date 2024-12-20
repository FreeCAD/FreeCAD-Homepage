<?php

$localeMap = array(
    'en' => 'en_US',
    'af' => 'af_ZA',
    'ar' => 'ar_EG',
    'be' => 'be_BY',
    'ca' => 'ca_ES',
    'cs' => 'cs_CZ',
    'de' => 'de_DE',
    'el' => 'el_GR',
    'es' => 'es_AR',
    'es' => 'es_ES',
    'eu' => 'eu_ES',
    'fi' => 'fi_FI',
    'fil' => 'fil_PH',
    'fr' => 'fr_FR',
    'gl' => 'gl_ES',
    'hr' => 'hr_HR',
    'hu' => 'hu_HU',
    'id' => 'id_ID',
    'it' => 'it_IT',
    'ja' => 'ja_JP',
    'kab' => 'kab_DZ',
    'ko' => 'ko_KR',
    'lt' => 'lt_LT',
    'nl' => 'nl_NL',
    'no' => 'nb_NO',
    'pl' => 'pl_PL',
    'pt' => 'pt_BR',
    'pt' => 'pt_PT',
    'ro' => 'ro_RO',
    'ru' => 'ru_RU',
    'sk' => 'sk_SK',
    'sl' => 'sl_SI',
    'sr' => 'sr_RS',
    'sv' => 'sv_SE',
    'tr' => 'tr_TR',
    'uk' => 'uk_UA',
    'val' => 'val_ES',
    'vi' => 'vi_VN',
    'zh' => 'zh_CN',
    'zh' => 'zh_TW',
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
    echo('						<a class="dropdown-item" href="'.$href.'?lang=af"><img src="lang/af/flag.jpg" alt="" />'._('Afrikaans').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ar"><img src="lang/ar/flag.jpg" alt="" />'._('Arabic').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=be"><img src="lang/be/flag.jpg" alt="" />'._('Belarusian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ca"><img src="lang/ca/flag.jpg" alt="" />'._('Catalan').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=cs"><img src="lang/cs/flag.jpg" alt="" />'._('Czech').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=de"><img src="lang/de/flag.jpg" alt="" />'._('German').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=el"><img src="lang/el/flag.jpg" alt="" />'._('Greek').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=es_AR"><img src="lang/es_AR/flag.jpg" alt="" />'._('Spanish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=es_ES"><img src="lang/es_ES/flag.jpg" alt="" />'._('Spanish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=eu"><img src="lang/eu/flag.jpg" alt="" />'._('Basque').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fi"><img src="lang/fi/flag.jpg" alt="" />'._('Finnish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fil"><img src="lang/fil/flag.jpg" alt="" />'._('Filipino').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=fr"><img src="lang/fr/flag.jpg" alt="" />'._('French').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=gl"><img src="lang/gl/flag.jpg" alt="" />'._('Galician').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=hr"><img src="lang/hr/flag.jpg" alt="" />'._('Croatian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=hu"><img src="lang/hu/flag.jpg" alt="" />'._('Hungarian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=id"><img src="lang/id/flag.jpg" alt="" />'._('Indonesian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=it"><img src="lang/it/flag.jpg" alt="" />'._('Italian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ja"><img src="lang/ja/flag.jpg" alt="" />'._('Japanese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=kab"><img src="lang/kab/flag.jpg" alt="" />'._('Kabyle').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ko"><img src="lang/ko/flag.jpg" alt="" />'._('Korean').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=lt"><img src="lang/lt/flag.jpg" alt="" />'._('Lithuanian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=nl"><img src="lang/nl/flag.jpg" alt="" />'._('Dutch').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=no"><img src="lang/no/flag.jpg" alt="" />'._('Norwegian Bokmal').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=pl"><img src="lang/pl/flag.jpg" alt="" />'._('Polish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=pt_BR"><img src="lang/pt_BR/flag.jpg" alt="" />'._('Portuguese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=pt_PT"><img src="lang/pt_PT/flag.jpg" alt="" />'._('Portuguese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ro"><img src="lang/ro/flag.jpg" alt="" />'._('Romanian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=ru"><img src="lang/ru/flag.jpg" alt="" />'._('Russian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sk"><img src="lang/sk/flag.jpg" alt="" />'._('Slovak').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sl"><img src="lang/sl/flag.jpg" alt="" />'._('Slovenian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sr"><img src="lang/sr/flag.jpg" alt="" />'._('Serbian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=sv_SE"><img src="lang/sv_SE/flag.jpg" alt="" />'._('Swedish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=tr"><img src="lang/tr/flag.jpg" alt="" />'._('Turkish').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=uk"><img src="lang/uk/flag.jpg" alt="" />'._('Ukrainian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=val_ES"><img src="lang/val_ES/flag.jpg" alt="" />'._('Valencian').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=vi"><img src="lang/vi/flag.jpg" alt="" />'._('Vietnamese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=zh_CN"><img src="lang/zh_CN/flag.jpg" alt="" />'._('Chinese').'</a>');
    echo('						<a class="dropdown-item" href="'.$href.'?lang=zh_TW"><img src="lang/zh_TW/flag.jpg" alt="" />'._('Chinese').'</a>');
}

function getTranslatedDownloadLink() {
    $tr = "";
    if (isSet($_GET["lang"])) {
        $tr = "?lang=".$_GET["lang"];
    }
    echo("downloads.php".$tr);
}
?>
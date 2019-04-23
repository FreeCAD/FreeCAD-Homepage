<?php

$localeMap = array(
    'en' => 'en_US',
    'af' => 'af_ZA',
    'ar' => 'ar_SA',
    'ca' => 'ca_ES',
    'cs' => 'cs_CZ',
    'de' => 'de_DE',
    'el' => 'el_GR',
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
    'ro' => 'ro_MD',
    'ru' => 'ru_RU',
    'sk' => 'sk_SK',
    'sl' => 'sl_SI',
    'sr' => 'sr_CS',
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

function getFlags($href='/') {
    echo('<a class="dropdown-item text-dark" href="'.$href.'"><img src="lang/en/flag.jpg"/>'._('English').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=af"><img class="mr-3" src="lang/af/flag.jpg"/>'._('Afrikaans').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ar"><img class="mr-3" src="lang/ar/flag.jpg"/>'._('Arabic').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ca"><img class="mr-3" src="lang/ca/flag.jpg"/>'._('Catalan').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=cs"><img class="mr-3" src="lang/cs/flag.jpg"/>'._('Czech').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=de"><img class="mr-3" src="lang/de/flag.jpg"/>'._('German').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=el"><img class="mr-3" src="lang/el/flag.jpg"/>'._('Greek').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=es_ES"><img class="mr-3" src="lang/es_ES/flag.jpg"/>'._('Spanish').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=eu"><img class="mr-3" src="lang/eu/flag.jpg"/>'._('Basque').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=fi"><img class="mr-3" src="lang/fi/flag.jpg"/>'._('Finnish').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=fil"><img class="mr-3" src="lang/fil/flag.jpg"/>'._('Filipino').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=fr"><img class="mr-3" src="lang/fr/flag.jpg"/>'._('French').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=gl"><img class="mr-3" src="lang/gl/flag.jpg"/>'._('Galician').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=hr"><img class="mr-3" src="lang/hr/flag.jpg"/>'._('Croatian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=hu"><img class="mr-3" src="lang/hu/flag.jpg"/>'._('Hungarian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=id"><img class="mr-3" src="lang/id/flag.jpg"/>'._('Indonesian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=it"><img class="mr-3" src="lang/it/flag.jpg"/>'._('Italian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ja"><img class="mr-3" src="lang/ja/flag.jpg"/>'._('Japanese').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=kab"><img class="mr-3" src="lang/kab/flag.jpg"/>'._('Kabyle').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ko"><img class="mr-3" src="lang/ko/flag.jpg"/>'._('Korean').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=lt"><img class="mr-3" src="lang/lt/flag.jpg"/>'._('Lithuanian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=nl"><img class="mr-3" src="lang/nl/flag.jpg"/>'._('Dutch').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=no"><img class="mr-3" src="lang/no/flag.jpg"/>'._('Norwegian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=pl"><img class="mr-3" src="lang/pl/flag.jpg"/>'._('Polish').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=pt_BR"><img class="mr-3" src="lang/pt_BR/flag.jpg"/>'._('Portuguese').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=pt_PT"><img class="mr-3" src="lang/pt_PT/flag.jpg"/>'._('Portuguese').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ro"><img class="mr-3" src="lang/ro/flag.jpg"/>'._('Romanian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=ru"><img class="mr-3" src="lang/ru/flag.jpg"/>'._('Russian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=sk"><img class="mr-3" src="lang/sk/flag.jpg"/>'._('Slovak').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=sl"><img class="mr-3" src="lang/sl/flag.jpg"/>'._('Slovenian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=sr"><img class="mr-3" src="lang/sr/flag.jpg"/>'._('Serbian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=sv_SE"><img class="mr-3" src="lang/sv_SE/flag.jpg"/>'._('Swedish').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=tr"><img class="mr-3" src="lang/tr/flag.jpg"/>'._('Turkish').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=uk"><img class="mr-3" src="lang/uk/flag.jpg"/>'._('Ukrainian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=val_ES"><img class="mr-3" src="lang/val_ES/flag.jpg"/>'._('Valencian').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=vi"><img class="mr-3" src="lang/vi/flag.jpg"/>'._('Vietnamese').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=zh_CN"><img class="mr-3" src="lang/zh_CN/flag.jpg"/>'._('Chinese').'</a>');
    echo('<a class="dropdown-item text-dark" href="'.$href.'?lang=zh_TW"><img class="mr-3" src="lang/zh_TW/flag.jpg"/>'._('Chinese').'</a>');
}

function getTranslatedDownloadLink() {
    $tr = "";
    if (isSet($_GET["lang"])) {
        $tr = "?lang=".$_GET["lang"];
    }
    echo("downloads.php".$tr);
}
?>
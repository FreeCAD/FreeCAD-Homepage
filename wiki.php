<?php
    $page = $_GET["page"];
    $currentpage = "wiki-".$page.".php";
    include("header.php");
?>

<style>
.mw-parser-output {
    margin-top: 3em;
}

.mw-parser-output a {
    word-wrap: break-word;
}

.mw-parser-output a.external {
    background-position: center right;
    background-repeat: no-repeat;
    background-size: 0.857em;
}

pre, .mw-code {
    padding: 1em;
    white-space: pre-wrap;
    overflow-x: hidden;
    word-wrap: break-word;
    background: #1F425C;
    line-height: 1.3;
}

.wikitable {
    background-color: rgba(52, 58, 64, 0.5);
    margin: 1em 0;
    border: 1px solid #a2a9b1;
    border-collapse: collapse;
}

.wikitable > tr > th,
.wikitable > * > tr > th,
.wikitable > tr > td,
.wikitable > * > tr > td {
    border: 1px solid #a2a9b1;
    padding: 0.2em 0.4em;
}

.wikitable > tr > th,
.wikitable > * > tr > th {
    background-color: rgba(52, 58, 64, 0.5);
    text-align: center;
}

figure[typeof~="mw:File/Thumb"],
figure[typeof~="mw:File/Frame"] {
    margin: 0.5em 0 1.3em 1.4em;
    clear: right;
    float: right;
    background-color: rgba(52, 58, 64, 0.5);
}

figure[typeof~="mw:File/Thumb"].mw-halign-left,
figure[typeof~="mw:File/Frame"].mw-halign-left {
  margin: 0.5em 1.4em 1.3em 0;
  clear: left;
  float: left;
}

figure[typeof~="mw:File"].mw-halign-center,
figure[typeof~="mw:File/Frameless"].mw-halign-center {
    margin: 0 auto;
    display: table;
    border-collapse: collapse;
    clear: none;
    float: none;
}

figure[typeof~="mw:File"] > figcaption,
figure[typeof~="mw:File/Frameless"] > figcaption {
    display: none;
}

figure[typeof~="mw:File"].mw-halign-left,
figure[typeof~="mw:File/Frameless"].mw-halign-left {
  margin: 0 0.5em 0.5em 0;
  clear: left;
  float: left;
}

.mw-selflink {
    color: #000;
}

ul.gallery.gallery.gallery {
    margin: 2px;
    padding: 2px;
    display: block;
}

li.gallerybox {
    vertical-align: top;
    display: inline-block;
}

.docnav, .manualtoc {
    overflow: hidden;
    background-color: rgba(52, 58, 64, 0.5);
	clear: both;
}

.mw-parser-output img {
    max-width: 660px;
    height: auto;
}

.mw-highlight .sd,
.mw-highlight .s2 {
    color: #E06C75;
    font-style: italic;
}

.mw-highlight .kn,
.mw-highlight .k,
.mw-highlight .kc,
.mw-highlight .nb {
    color: #98C379;
    font-weight: bold;
}

.mw-highlight .nn,
.mw-highlight .nf {
    color: #61AFEF;
    font-weight: bold;
}

.mw-highlight .o,
.mw-highlight .mi,
.mw-highlight .mf {
    color: #D19A66;
}

.mw-highlight .c1 {
    color: #5C6370;
    font-style: italic;
}

.mw-highlight .ow {
    color: #C678DD;
    font-weight: bold;
}

blockquote {
  border-left: 4px solid #eaecf0;
  padding: 8px 32px;
}

@media (max-width: 786px) {
    .mw-parser-output img {
        max-width: 100%;
    }

    .responsive-wiki-table {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}

</style>

    <div id="main" class="container-fluid whitelinks md">

<?php

function isLightOrDark($hex) {
    $hex = ltrim($hex, '#');

    $r = hexdec(strlen($hex) == 6 ? substr($hex, 0, 2) : str_repeat(substr($hex, 0, 1), 2));
    $g = hexdec(strlen($hex) == 6 ? substr($hex, 2, 2) : str_repeat(substr($hex, 1, 1), 2));
    $b = hexdec(strlen($hex) == 6 ? substr($hex, 4, 2) : str_repeat(substr($hex, 2, 1), 2));

    $brightness = ($r * 0.299) + ($g * 0.587) + ($b * 0.114);

    return ($brightness > 128) ? 'light' : 'dark';
}

function updateStylesForLightBackground($xpath) {
    foreach ($xpath->query('//*[@style]') as $node) {
        $style = $node->getAttribute('style');
        if (preg_match('/background\s*:\s*([^;]+);?/i', $style, $matches)) {
            $bgColor = trim($matches[1]);
            if (preg_match('/^#([a-f0-9]{3}|[a-f0-9]{6})$/i', $bgColor) && isLightOrDark($bgColor) == 'light') {
                if (!str_contains($style, 'color')) {
                    $style .= ' color: #202122;';
                }
                foreach ($xpath->query('.//a', $node) as $link) {
                    $linkStyle = $link->getAttribute('style') ?: '';
                    if (!str_contains($linkStyle, 'color')) {
                        $link->setAttribute('style', $linkStyle . ' color: #202122;');
                    }
                }
            }
        }

        $node->setAttribute('style', $style);
    }
}

function createDomAndXpath($html) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);
    libxml_clear_errors();
    return array($dom, new DOMXPath($dom));
}

function removeNodesByXPath($xpath, $xpathQuery) {
    $nodes = $xpath->query($xpathQuery);
    foreach ($nodes as $node) {
        $node->parentNode->removeChild($node);
    }
}

function removeDivsByClass($xpath, $classes) {
    $xpathQuery = "//div[contains(@class, '" . implode("') or contains(@class, '", $classes) . "')]";
    removeNodesByXPath($xpath, $xpathQuery);
}

function removeDivsById($xpath, $ids) {
    $xpathQuery = "//div[@id='" . implode("' or @id='", $ids) . "']";
    removeNodesByXPath($xpath, $xpathQuery);
}

function convertRelativeLinksToWikiFormat($xpath, $lang = 'en') {
    foreach ($xpath->query("//a[@href]") as $node) {
        $href = $node->getAttribute('href');
        if (strpos($href, '#') === 0) {
            continue;
        }
        if (!preg_match('/^(http|https):\/\//', $href)) {
            $hashPart = '';
            if (strpos($href, '#') !== false) {
                list($href, $hashPart) = explode('#', $href, 2);
                $hashPart = '#' . $hashPart;
            }
            $href = trim($href, "/");
            if (preg_match('/\/([a-z]{2})$/i', $href, $matches)) {
                $langCode = $matches[1];
                $newHref = "/wiki-" . trim($href, '/' . $langCode) . ".php?lang=" . $langCode;
            } else {
                $newHref = "/wiki-" . trim($href, '/') . ".php";
                if ($lang != "en") {
                    $newHref .= "?lang=" . $lang;
                }
            }
            $newHref .= $hashPart;
            $node->setAttribute('href', $newHref);
        }
    }
}

function removeFileLinks($xpath) {
    foreach ($xpath->query("//a[contains(@href, 'File:')]") as $node) {
        $parent = $node->parentNode;
        while ($node->firstChild) {
            $parent->insertBefore($node->firstChild, $node);
        }
        $parent->removeChild($node);
    }
}

function removeInlineStylesByClasses($xpath, $classNames) {
    foreach ($classNames as $className) {
        foreach ($xpath->query("//*[contains(@class, '$className')]") as $node) {
            $node->removeAttribute('style');
        }
    }
}

function addPrefixToImageSrc($xpath, $baseImageUrl) {
    foreach ($xpath->query("//img[@src]") as $node) {
        $src = $node->getAttribute('src');
        if (!preg_match('/^(http|https):\/\//', $src)) {
            $newSrc = rtrim($baseImageUrl, '/') . '/' . ltrim($src, '/');
            $node->setAttribute('src', $newSrc);
        }
    }
}

function wrapTablesInDiv($xpath, $divClasses = array(), $dom) {
    foreach ($xpath->query("//table") as $table) {
        $wrapperDiv = $dom->createElement('div');
        if (!empty($divClasses)) {
            $wrapperDiv->setAttribute('class', implode(' ', $divClasses));
        }
        $table->parentNode->replaceChild($wrapperDiv, $table);
        $wrapperDiv->appendChild($table);
    }
}

function fetchWikiContent($page, $lang = 'en') {
    if (isset($lang)) {
        $page .= "/" . $lang;
    }

    $url = "https://wiki.freecad.org/api.php?action=parse&page=" . $page . "&format=json&disableeditsection=true&disabletoc=true";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function convertWidthToMaxWidth($xpath) {
    foreach ($xpath->query('//*[@style]') as $node) {
        $style = $node->getAttribute('style');

        $updatedStyle = preg_replace_callback('/\bwidth\s*:\s*[^;]+;?/i', function ($matches) {
            return str_replace('width', 'max-width', $matches[0]);
        }, $style);

        $node->setAttribute('style', $updatedStyle);
    }
}

function removeWidthFromFloatRightDivs($xpath) {
    $query = "//div[contains(@style, 'float: right')]";
    $nodes = $xpath->query($query);
    foreach ($nodes as $node) {
        $style = $node->getAttribute('style');
        $updatedStyle = preg_replace('/\bwidth\s*:\s*[^;]+;?/', '', $style);
        if (trim($updatedStyle)) {
            $node->setAttribute('style', $updatedStyle);
        } else {
            $node->removeAttribute('style');
        }
    }
}

function removeSrcsetAttributes($xpath) {
    foreach ($xpath->query("//img[@srcset]") as $node) {
        $node->removeAttribute('srcset');
    }
}




function processWikiContent($page, $lang = 'en') {
    $data = fetchWikiContent($page, $lang);
    $htmlContent = $data['parse']['text']['*'];

    list($dom, $xpath) = createDomAndXpath($htmlContent);

    addPrefixToImageSrc($xpath, "https://wiki.freecad.org");
    removeDivsByClass($xpath, array('NavFrame', 'mw-pt-languages'));
    removeDivsById($xpath, array('itsstillfree', 'itsfree'));
    removeInlineStylesByClasses($xpath, array('docnav'));
    removeFileLinks($xpath);
    convertRelativeLinksToWikiFormat($xpath, $lang);
    wrapTablesInDiv($xpath, array('responsive-wiki-table'),$dom);
	removeWidthFromFloatRightDivs($xpath);
    convertWidthToMaxWidth($xpath);
	removeSrcsetAttributes($xpath);
    updateStylesForLightBackground($xpath);


    return $dom->saveHTML();
}

echo processWikiContent($page, $lang);

?>

        <p>
            <?php echo _("This page is retrieved from"); ?>
            <a href="<?php echo "https://wiki.freecad.org/".$page; ?>"><?php echo "https://wiki.freecad.org/".$page;?></a>
        </p>
</div>
<?php
    include 'footer.php';
?>

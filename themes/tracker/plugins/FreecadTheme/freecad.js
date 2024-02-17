function addReportTemplate() {
  var descText = `<a href="//forum.freecad.org/viewtopic.php?f=3&t=5236">Read this before reporting</a>
  and make a <a href="//forum.freecad.org">forum thread asking for help</a>
  <em>first</em> if you aren't sure it's a bug!`;

  var stepsText = `Include a detailed, step-by-step list for bugs.
We can't fix a bug we can't reproduce.`;

  var infoText = `Running a debug release? Publish a <a href="http://wiki.freecad.org/Debugging">debugging backtrace</a>.
<br><br>
File too large? Upload to a cloud-based 3rd party service like Nextcloud or Dropbox,
and paste the link here.`;

  var fcinfoText = `Paste the contents of Help > About FreeCAD > "Copy to
clipboard". <em>Note:</em> You must only post the complete snippet with nothing else.
Or else the tracker will not accept the ticket.`;

  var exclamationTriangle = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';

  var descHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + descText + '</span>';
  var stepsHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + stepsText + '</span>';
  var infoHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + infoText + '</span>';
  var fcinfoHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + fcinfoText + '</span>';


  $('label[for=description]').after(descHtml);
  $('label[for=steps_to_reproduce]').after(stepsHtml);
  $('label[for=additional_info]').after(infoHtml);
  $('label[for=custom_field_1]').after(fcinfoHtml);

}

function swapButtons() {
  // List items containing "button"
  readThis = $('li a span:contains("Read this")').parent().parent();
  viewIssues = $('li a span:contains("View Issues")').parent().parent();

  readThis.insertAfter(viewIssues);
}

$(document).ready(function () {
  swapButtons();
  var pageTitle = $(document).attr("title");
  if (pageTitle === "Report Issue - FreeCAD Tracker") {
    addReportTemplate();
  }
});

var _paq = _paq || [];
/* tracker methods like "setCustomDimension" should be called before "trackPageView" */
_paq.push(['trackPageView']);
_paq.push(['enableLinkTracking']);
(function() {
  var u="//analytics.freecad.io/";
  _paq.push(['setTrackerUrl', u+'piwik.php']);
  _paq.push(['setSiteId', '2']);
  var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
  g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'piwik.js'; s.parentNode.insertBefore(g,s);
})();

// runtime fixes for ugly mantisbt elements
/*
$("input[type=text]").addClass("form-control lwidth");
$("input[type=password]").addClass("form-control lwidth");
$("input[type=file]").addClass("btn btn-default");
$("textarea").addClass("form-control");
$(".button").addClass("btn btn-default btn-sm");
$(".button-small").addClass("btn btn-default btn-sm");
$("select").addClass("btn btn-default btn-xs lwidth");
*/
// update #summary, #description, #steps_to_reproduce, #additional_info

function addReportTemplate() {
  var summaryText = `Short description about the issue`;

  var descText = `Explain the details of the bug, feature, or patch.<br><br>
What were you doing when it happened?<br>
What did you expect to happen?<br>
What was the actual result?`;

  var stepsText = `Detailed step-by-step list to recreate the bug.
We can't fix a bug we can't reproduce. A good example looks like:<br><br>
<i>1. Launch FreeCAD<br>
2. Open Sketcher through the dropdown<br>
3. Open a New Document: File > New<br>
4. etc...<br>
Result: In summary what I saw happening in FreeCAD was...</i>`;

  var infoText = `Paste the contents of Help > About FreeCAD > "Copy to
clipboard"<br>
<br>
Running a debug release? Publish a <a href="http://www.freecadweb.org/wiki/Debugging">debugging backtrace</a>.
<br>
<br>
File too large?
Upload to a cloud-based 3rd party service like Nextcloud or Dropbox,
and paste the link here.`;

  var exclamationTriangle = '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>';

  var summaryHtml = '<br>' + exclamationTriangle + ' <span class="red">' + summaryText + '</span>';
  var descHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + descText + '</span>';
  var stepsHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + stepsText + '</span>';
  var infoHtml = '<br><br>' + exclamationTriangle + ' <span class="red">' + infoText + '</span>';

  $('label[for=summary]').after(summaryHtml);
  $('label[for=description]').after(descHtml);
  $('label[for=steps_to_reproduce]').after(stepsHtml);
  $('label[for=additional_info]').after(infoHtml);
}

$(document).ready(function () {
  var pageTitle = $(document).attr("title");
  if (pageTitle === "Report Issue - FreeCAD Tracker") {
    addReportTemplate();
  }
});

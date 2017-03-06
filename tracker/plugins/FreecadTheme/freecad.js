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
function addPlaceholderText(el, txt) {
  $(el).attr('placeholder', txt);
}

function addReportTemplate() {
  var summaryText = `Short description about the issue`;

  var descText = `==> Explain the details of the bug/feature/patch. \
What you were doing when it happened? \
what you expected to happen? \
what actually was the result?`;

  var stepsText = `==> Detailed step-by-step list how to recreate the bug \
to help the devs and testers reproduce your issue.
Ex:
1. Launch FreeCAD 
2. Open Sketcher through the dropdown 
3. Open a New Document: File > New 
4. etc... 
Result: Summarize the result you see happening in FreeCAD`;

  var infoText = `==> Please paste the contents of Help > About FreeCAD > "Copy to \
clipboard" 

==> Running a debug release? Publish a debugging backtrace: \
Please see: http://www.freecadweb.org/wiki/Debugging 

If you have a file to share that is larger than the FreeCAD tracker allows, you \
can upload the file to a cloud-based 3rd party service (like NextCloud, Dropbox, \
etc.) and paste the link here.`;

  addPlaceholderText('#summary', summaryText);
  addPlaceholderText('#description', descText);
  addPlaceholderText('#steps_to_reproduce', stepsText);
  addPlaceholderText('#additional_info', infoText);
}

$(document).ready(function () {
  var pageTitle = $(document).attr("title");
  if (pageTitle === "Report Issue - FreeCAD Tracker") {
    addReportTemplate();
  }
});

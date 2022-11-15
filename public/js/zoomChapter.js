// zoom in - zoom out
$(document).ready(function () {
  var content = $(".content-chapter");
  // zoom in
  $("#zoom-in").click(function () {
    var presentsize = content.css("font-size");
    var latestsize = parseInt(presentsize.replace("px")) + 1;
    content.css("font-size", latestsize + "px");
  });
  // zoom out
  $("#zoom-out").click(function () {
    var presentsize = content.css("font-size");
    var latestsize = parseInt(presentsize.replace("px")) - 1;
    content.css("font-size", latestsize + "px");
  });
});

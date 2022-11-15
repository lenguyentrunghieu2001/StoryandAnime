// search tìm truyện
$("#gsearchsimple").keyup(function () {
  var query = $("#gsearchsimple").val();
  $("#detail").html();
  $(".list-group").css("display", "block");
  $(".list-group").css("overflow-y", "scroll");
  $(".list-group").css("max-height", "250px");
  if (query.length >= 1) {
    $.ajax({
      url: "inc/fetch.php",
      method: "POST",
      data: {
        query: query,
      },
      success: function (data) {
        $(".list-group").html(data);
      },
    });
  } else {
    $(".list-group").css("display", "none");
  }
});

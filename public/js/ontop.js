// ontop
$("#top").hide();
$("#top").click(function () {
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    "slow"
  );
  return false;
});

$(window).scroll(function () {
  if ($(document).scrollTop() > 200) {
    $("#top").fadeIn(100);
  } else {
    $("#top").fadeOut(100);
  }
});

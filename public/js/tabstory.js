// tab_story_date
$(document).ready(function () {
  $(".tab_container-story_area1 .story:first").css("display", "block");
  $(".tab_navigation-story1 li:first").addClass("active");
  $(".tab_navigation-story1 li").click(function (event) {
    index = $(this).index();
    $(".tab_navigation-story1 li").removeClass("active");
    $(this).addClass("active");
    $(".tab_container-story_area1 .story").hide();
    $(".tab_container-story_area1 .story").eq(index).css("display", "block");
  });
});

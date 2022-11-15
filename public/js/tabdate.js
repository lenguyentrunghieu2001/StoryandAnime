// tab_story_date
$(document).ready(function () {
  $(".tab_container-story_area .story:first").css("display", "flex");
  $(".tab_navigation-story li:first").addClass("active");
  $(".tab_navigation-story li").click(function (event) {
    index = $(this).index();
    $(".tab_navigation-story li").removeClass("active");
    $(this).addClass("active");
    $(".tab_container-story_area .story").hide();
    $(".tab_container-story_area .story").eq(index).css("display", "flex");
  });
});

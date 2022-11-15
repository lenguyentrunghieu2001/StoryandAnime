window.onload = function () {
  $(".slider").slick({
    rows: 2,
    autoplay: true,
    autoplaySpeed: 800,
    arrows: true,
    dots: true,
    prevArrow: '<button type="button" class="slick-prev"><</button>',
    nextArrow: '<button type="button" class="slick-next">></button>',
    centerMode: true,
    slidesToShow: 6,
    swipeToSlide: true,
  });
};

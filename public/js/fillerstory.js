$(document).ready(function () {
  var showval = "";

  $("#show").click(function () {
    $(".common_selector").removeAttr("checked");
    showval = $("#show").val();
  });

  filter_data();

  function filter_data() {
    $(".story").html('<div id="loading" style="" ></div>');
    var action = "fetch_data";
    var minimum_price = $("#hidden_minimum_price").val();
    var maximum_price = $("#hidden_maximum_price").val();
    var status = get_filter("status");
    var hot = get_filter("hot");
    var usernametrans = get_filter("usernametrans");
    var category = get_filter("category");
    var sort = get_filter("sort");
    var show = showval;
    console.log(show);
    $.ajax({
      url: "fillerstory/handelfillerstory.php",
      method: "POST",
      data: {
        action: action,
        minimum_price: minimum_price,
        maximum_price: maximum_price,
        status: status,
        hot: hot,
        usernametrans: usernametrans,
        category: category,
        sort: sort,
        show: show,
      },
      success: function (data) {
        $(".story").html(data);
      },
    });
  }

  function get_filter(class_name) {
    var filter = [];
    $("." + class_name + ":checked").each(function () {
      filter.push($(this).val());
    });

    return filter;
  }

  $(".common_selector").click(function () {
    filter_data();
  });

  $("#price_range").slider({
    range: true,
    min: 1000,
    max: 65000,
    values: [1000, 65000],
    step: 500,
    stop: function (event, ui) {
      $("#price_show").html(ui.values[0] + " - " + ui.values[1]);
      $("#hidden_minimum_price").val(ui.values[0]);
      $("#hidden_maximum_price").val(ui.values[1]);
      filter_data();
    },
  });
});

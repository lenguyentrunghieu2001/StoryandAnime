// document.getElementById("toggle").addEventListener("click", function() {
//     document.getElementsByTagName('body')[0].classList.toggle("dark-theme");
// });

// lưu khi click đổi màu giao diện
if (localStorage.getItem("bannerDismissed") === "true") {
  document.getElementsByTagName("body")[0].classList.add("dark-theme"); // remove the banner
} else {
  document.getElementsByTagName("body")[0].classList.remove("dark-theme"); // remove the banner
}

document.getElementById("toggle").addEventListener("click", (_) => {
  if (
    document.getElementsByTagName("body")[0].classList.contains("dark-theme")
  ) {
    document.getElementsByTagName("body")[0].classList.remove("dark-theme");
    localStorage.setItem("bannerDismissed", "false");
  } else {
    document.getElementsByTagName("body")[0].classList.add("dark-theme");
    localStorage.setItem("bannerDismissed", "true");
  }
});

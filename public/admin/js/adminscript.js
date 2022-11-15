const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
const first = document.querySelector("#sidebar .side-menu.top .home a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;
  li.classList.remove("active");

  if (
    window.location.href !=
    "http://localhost:8088/StoryAndAnime/admin/page/home.php"
  ) {
    if (localStorage.getItem("activeadmin") === item.getAttribute("href")) {
      li.classList.add("active");
    }
  } else {
    first.parentElement.classList.add("active");
    localStorage.removeItem("activeadmin");
  }
  item.addEventListener("click", function () {
    li.classList.add("active");
    localStorage.setItem("activeadmin", item.getAttribute("href"));
  });
});

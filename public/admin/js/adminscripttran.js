const allSideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
const first = document.querySelector("#sidebar .side-menu.top .home a");

allSideMenu.forEach((item) => {
  const li = item.parentElement;
  li.classList.remove("active");

  if (
    window.location.href !=
    "http://localhost:8088/StoryAndAnime/StoryTranslates/page/hometrans.php"
  ) {
    if (localStorage.getItem("activetrans") === item.getAttribute("href")) {
      li.classList.add("active");
    }
  } else {
    first.parentElement.classList.add("active");
    localStorage.removeItem("activetrans");
  }
  item.addEventListener("click", function () {
    li.classList.add("active");
    localStorage.setItem("activetrans", item.getAttribute("href"));
  });
});

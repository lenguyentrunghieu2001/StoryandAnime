const loadmore = document.querySelector(".load-more");
let currentItems = 4;
loadmore.addEventListener("click", (e) => {
  const elementList = [...document.querySelectorAll(".news-item")];
  e.target.classList.add("show-loader");
  for (let i = currentItems; i < currentItems + 3; i++) {
    setTimeout(function () {
      e.target.classList.remove("show-loader");
      if (elementList[i]) {
        elementList[i].style.display = "flex";
      }
    }, 2000);
  }
  currentItems += 4;
});

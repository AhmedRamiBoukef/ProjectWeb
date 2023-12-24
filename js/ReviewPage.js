
let totalPages = 20;
let page = 1;
function createPagination(totalPages, page) {
  const element = document.querySelector("#pagination");
  const reviewList = document.querySelector("#reviews-list");
  let liTag = "";
  let active;
  let beforePage = page - 1;
  let afterPage = page + 1;
  if (page > 1) {
    liTag += `<li class="page-item" onclick="createPagination(totalPages, ${
      page - 1
    })"><a class="page-link">Previous</a></li>`;
  }

  if (page > 2) {
    liTag += `<li class="page-item" onclick="createPagination(totalPages, 1)"><a class="page-link">1</a></li>`;
    if (page > 3) {
      liTag += `<li class="page-item"><a class="page-link">...</a></li>`;
    }
  }

  for (var plength = beforePage; plength <= afterPage; plength++) {
    if (plength > totalPages) {
      continue;
    }
    if (plength == 0) {
      plength = plength + 1;
    }
    if (page == plength) {
      active = "active";
    } else {
      active = "";
    }
    liTag += `<li class="page-item  ${active}" onclick="createPagination(totalPages, ${plength})"><a class="page-link">${plength}</a></li>`;
  }

  if (page < totalPages - 1) {
    if (page < totalPages - 2) {
      liTag += `<li class="page-item"><a class="page-link">...</a></li>`;
    }
    liTag += `<li class="page-item" onclick="createPagination(totalPages, ${totalPages})"><a class="page-link">${totalPages}</a></li>`;
  }

  if (page < totalPages) {
    liTag += `<li class="page-item" onclick="createPagination(totalPages, ${
      page + 1
    })"><a class="page-link">Next</a></li>`;
  }
  element.innerHTML = liTag;
  $.ajax({
    url: `/Project/Api/api.php?id=${
      location.href.split("=")[1]
    }&showReviewPage=${page}`,
    method: "GET",
    success: function (data) {
      reviewList.innerHTML = data;
    },
    error: function (error) {
      console.error("Error fetching reviews:", error);
    },
  });
}

$(document).ready(function () {
  $.ajax({
    url: `/Project/Api/api.php?getReviewsbyID=${location.href.split("=")[1]}`,
    method: "GET",
    dataType: "json",
    success: function (data) {
      totalPages = Math.floor(data / 5) + 1;
      createPagination(totalPages, page);
    },
    error: function (error) {
      console.error("Error fetching reviews:", error);
    },
  });

  let stars = document.querySelectorAll(".rating-star");

  stars.forEach(function (star, index) {
    star.addEventListener("click", function () {
      $("#note").val(index + 1);
      console.log(note.value);
      for (var i = 0; i <= index; i++) {
        stars[i].setAttribute("fill", "orange");
      }
      for (var i = index + 1; i <= stars.length; i++) {
        stars[i].setAttribute("fill", "currentColor");
      }
    });
  });

  document
    .getElementById("ReviewSubmitButton")
    .addEventListener("click", function () {
      var review = document.getElementById("review").value;
      var note = document.getElementById("note").value;

      if (review.trim() === "") {
        alert("Please enter your review");
        return;
      }

      if (note === "0") {
        alert("Please select a note");
        return;
      }
      document.getElementById("reviewForm").submit();
    });
});

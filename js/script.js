const root = document.documentElement;
const spinnerElementsDisplayed = getComputedStyle(root).getPropertyValue(
  "--spinner-elements-displayed"
);
const spinnerContent = document.querySelector("ul.spinner-content");
let offset = 12;
const limit = 10;

if (spinnerContent) {
  root.style.setProperty("--spinner-elements", spinnerContent.children.length);

  for (let i = 0; i < spinnerElementsDisplayed; i++) {
    spinnerContent.appendChild(spinnerContent.children[i].cloneNode(true));
  }
}
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
  if (location.href.split("=")[1] === "http://localhost/Project/review/?id") {
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
  }

  for (let index = 1; index < 5; index++) {
    $("#vehicle_picker_brand" + index).on("change", function () {
      var selectedBrand = $(this).val();

      $.ajax({
        url: "/Project/Api/api.php",
        method: "POST",
        data: { brandID: selectedBrand },
        dataType: "json",
        success: function (models) {
          var modelDropdown = $("#vehicle_picker_model" + index);
          modelDropdown.empty();
          $("#vehicle_picker_year" + index).empty();
          $("#vehicle_picker_version" + index).empty();
          $("#vehicle_picker_year" + index).append(
            '<option value="" selected="">Choose a Year</option>'
          );
          $("#vehicle_picker_version" + index).append(
            '<option value="" selected="">Choose a Version</option>'
          );
          modelDropdown.append(
            '<option value="" selected="">Choose a Model</option>'
          );

          $.each(models, function (index, model) {
            modelDropdown.append(
              '<option value="' +
                model.ModelID +
                '">' +
                model.ModelName +
                "</option>"
            );
          });
        },
      });
    });
    $("#vehicle_picker_model" + index).on("change", function () {
      var selectedModel = $(this).val();
      $.ajax({
        url: "/Project/Api/api.php",
        method: "POST",
        data: { modelID: selectedModel },
        dataType: "json",
        success: function (models) {
          var yaarDropdown = $("#vehicle_picker_year" + index);
          yaarDropdown.empty();
          yaarDropdown.append(
            '<option value="" selected="">Choose a Year</option>'
          );
          $.each(models, function (index, model) {
            yaarDropdown.append(
              '<option value="' +
                model.ModelID +
                '">' +
                model.ModelYear +
                "</option>"
            );
          });
        },
      });
    });
    $("#vehicle_picker_model" + index).on("change", function () {
      var selectedModel = $(this).val();
      $.ajax({
        url: "/Project/Api/api.php?year=1&modelID=" + selectedModel,
        method: "GET",
        dataType: "json",
        success: function (infos) {
          var versionDropdown = $("#vehicle_picker_version" + index);
          versionDropdown.empty();
          versionDropdown.append(
            '<option value="" selected="">Choose a Version</option>'
          );

          $.each(infos, function (index, info) {
            versionDropdown.append(
              '<option value="' +
                info.VehicleID +
                '">' +
                info.Version +
                "</option>"
            );
          });
        },
      });
    });
  }
  $(".compare-button").on("click", function () {
    var selectedVersion1 = $("#vehicle_picker_version1").val();
    var selectedVersion2 = $("#vehicle_picker_version2").val();
    var selectedVersion3 = $("#vehicle_picker_version3").val();
    var selectedVersion4 = $("#vehicle_picker_version4").val();
    if (
      $("#vehicle_picker_brand1").val() === "" ||
      $("#vehicle_picker_model1").val() === "" ||
      $("#vehicle_picker_brand2").val() === "" ||
      $("#vehicle_picker_model2").val() === "" ||
      $("#vehicle_picker_version1").val() === "" ||
      $("#vehicle_picker_version2").val() === "" ||
      $("#vehicle_picker_year1").val() === "" ||
      $("#vehicle_picker_year2").val() === ""
    ) {
      alert("Please fill in the first two vehiculs to compare.");
      return;
    }
    

    var selectedVersions1 = [
      $("#vehicle_picker_version2").val(),
      $("#vehicle_picker_version3").val(),
      $("#vehicle_picker_version4").val(),
  ];
    var selectedVersions2 = [
      $("#vehicle_picker_version3").val(),
      $("#vehicle_picker_version4").val(),
  ];

    selectedVersions1.forEach(function (selectedVersion) {
      if (!selectedVersion) return;

      var comparisonData = {
          vehicleID1: selectedVersion1,
          vehicleID2: selectedVersion,
          comparison: 1,
      };

      $.ajax({
          url: '/Project/Api/api.php',
          type: 'POST',
          data: comparisonData,
          dataType: 'json',
          success: function (data) {
              console.log(data);
          },
          error: function (error) {
              console.error("Error updating comparison:", error);
          }
      });
  });
    selectedVersions2.forEach(function (selectedVersion) {
      if (!selectedVersion) return;

      var comparisonData = {
          vehicleID1: selectedVersion2,
          vehicleID2: selectedVersion,
          comparison: 1,
      };

      $.ajax({
          url: '/Project/Api/api.php',
          type: 'POST',
          data: comparisonData,
          dataType: 'json',
          success: function (data) {
              console.log(data);
          },
          error: function (error) {
              console.error("Error updating comparison:", error);
          }
      });
  });
  if (selectedVersion3 && selectedVersion4) {
    var comparisonData = {
      vehicleID1: selectedVersion3,
      vehicleID2: selectedVersion4,
      comparison: 1,
  };

  $.ajax({
      url: '/Project/Api/api.php',
      type: 'POST',
      data: comparisonData,
      dataType: 'json',
      success: function (data) {
          console.log(data);
      },
      error: function (error) {
          console.error("Error updating comparison:", error);
      }
  });
  }

  
    location.href =
      "/Project/compare/?vehicleID1=" +
      selectedVersion1 +
      "&vehicleID2=" +
      selectedVersion2;
    if (selectedVersion3 != "") {
      location.href =
        "/Project/compare/?vehicleID1=" +
        selectedVersion1 +
        "&vehicleID2=" +
        selectedVersion2 +
        "&vehicleID3=" +
        selectedVersion3;
    }
    if (selectedVersion4 != "") {
      location.href =
        "/Project/compare/?vehicleID1=" +
        selectedVersion1 +
        "&vehicleID2=" +
        selectedVersion2 +
        "&vehicleID3=" +
        selectedVersion3 +
        "&vehicleID4=" +
        selectedVersion4;
    }
  });
  $("#modalcompareButton").on("click", function () {
    var selectedVersion1 = $("#selectedVehicule").val();
    var selectedVersion2 = $("#vehicle_picker_version2").val();
    var selectedVersion3 = $("#vehicle_picker_version3").val();
    var selectedVersion4 = $("#vehicle_picker_version4").val();
    if (
      $("#vehicle_picker_brand2").val() === "" ||
      $("#vehicle_picker_model2").val() === "" ||
      $("#vehicle_picker_version2").val() === "" ||
      $("#vehicle_picker_year2").val() === ""
    ) {
      alert("Please fill at least in the second vehicul to compare.");
      return;
    }

    location.href =
      "/Project/compare/?vehicleID1=" +
      selectedVersion1 +
      "&vehicleID2=" +
      selectedVersion2;
    if (selectedVersion3 != "") {
      location.href =
        "/Project/compare/?vehicleID1=" +
        selectedVersion1 +
        "&vehicleID2=" +
        selectedVersion2 +
        "&vehicleID3=" +
        selectedVersion3;
    }
    if (selectedVersion4 != "") {
      location.href =
        "/Project/compare/?vehicleID1=" +
        selectedVersion1 +
        "&vehicleID2=" +
        selectedVersion2 +
        "&vehicleID3=" +
        selectedVersion3 +
        "&vehicleID4=" +
        selectedVersion4;
    }
  });

  const loadMoreBtn = $("#load-more-btn");
  const newsContainer = $("#news-container");

  let nombre = 0;
  loadMoreBtn.on("click", function () {
    $.ajax({
      url: `/Project/Api/api.php?getNews=1`,
      method: "GET",
      dataType: "json",
      success: function (data) {
        nombre = data.NumberOfNews;
      },
      error: function (error) {
        console.error("Error fetching news:", error);
      },
    });
    if (newsContainer[0].children.length < nombre) {
      fetchNews();
    }
  });

  function fetchNews() {
    $.ajax({
      url: `/Project/Api/api.php?offset=${offset}&limit=${limit}`,
      method: "GET",
      dataType: "json",
      success: function (data) {
        appendNewsToContainer(data);
        offset = offset + limit;
      },
      error: function (error) {
        console.error("Error fetching news:", error);
      },
    });
  }

  function appendNewsToContainer(newsData) {
    $.each(newsData, function (_, newsItem) {
      const newsCard = createNewsCard(newsItem);
      newsContainer.append(newsCard);
    });
  }

  function createNewsCard(newsItem) {
    const card = $("<a>", {
      href: `/Project/news/detail/?id=${newsItem["NewsID"]}`,
      class: "news-card",
    });

    const imageContainer = $("<div>");
    const image = $("<img>", {
      src: `/Project/public/images/${newsItem["ImagePath"]}`,
      alt: "",
    });
    imageContainer.append(image);

    const contentContainer = $("<div>");

    const shortenedTitle =
      newsItem["Title"].length > 32
        ? newsItem["Title"].substring(0, 32) + "..."
        : newsItem["Title"];
    const title = $("<h1>", { text: shortenedTitle });

    let shortenedContent =
      newsItem["Content"].length > 110
        ? newsItem["Content"].substring(0, 110) + "..."
        : newsItem["Content"];

    shortenedContent = shortenedContent.padEnd(110, " ");

    const paragraph = $("<p>", { text: shortenedContent });
    const publishedDate = $("<h3>", {
      text: `Published · ${formatDate(newsItem["Date"])}`,
    });

    contentContainer.append(title, paragraph, publishedDate);
    card.append(imageContainer, contentContainer);

    return card;
  }

  function formatDate(dateString) {
    const options = { day: "numeric", month: "short", year: "numeric" };
    const date = new Date(dateString);
    return date.toLocaleDateString("en-US", options);
  }
  var coll = document?.getElementsByClassName("collapsee");
  var i;

  for (i = 0; i < coll.length; i++) {
    coll[i]?.addEventListener("click", function () {
      this.classList.toggle("active");
      console.log(this.children);
      var content = this.nextElementSibling;
      if (content.style.maxHeight) {
        content.style.maxHeight = null;
        this.children[1].class = "bi bi-dash-lg";
      } else {
        content.style.maxHeight = content.scrollHeight + "px";
        this.children[1].class = "bi bi-plus-lg";
      }
    });
  }

  let stars = document.querySelectorAll(".rating-star");

  stars?.forEach(function (star, index) {
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
    ?.getElementById("ReviewSubmitButton")
    ?.addEventListener("click", function () {
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

  const form = document?.getElementById("contactForm");
  function sendEmail() {
    const subject = document.getElementById("subject");
    const message = document.getElementById("message");
    const bodyMessage = `Subject: ${subject.value}<br> Message:${message.value}`;
    console.log(bodyMessage);
    Email.send({
      Host: "smtp.elasticemail.com",
      Username: "esiswitch@gmail.com",
      Password: "xrth kfwz ztie qjqw",
      To: "ka_boukef@esi.dz.com",
      From: "esiswitch@gmail.com",
      Subject: subject.value,
      Body: bodyMessage,
    }).then((message) => {
      if (message == "OK") {
        const toast = document.getElementById("toast");
        const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toast);
        toastBootstrap.show();
      }
    });
  }
  form?.addEventListener("submit", (e) => {
    e.preventDefault();
    console.log("submitted");
    sendEmail();
  });

  $('#updateNewsForm').on('submit', function (e) {
    e.preventDefault(); 

    var updatedImages = [];

    $('.card-img').each(function () {
        var imgSrc = $(this).attr('src');
        var imgFilename = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
        updatedImages.push(imgFilename);
    });



    $('#updatedImages').val(updatedImages.join(','));
    var formElement = document.getElementById("updateNewsForm");
    var formData = new FormData(formElement);

    $.ajax({
        url: '/Project/Api/api.php',
        method: 'POST',
        data: formData, 
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            alert("News updated successfully");
        },
        error: function (error) {
            console.log(error);
        }
      });
  });
  $('#updateNewsForm').on('submit', function (e) {
    e.preventDefault(); 

    var updatedImages = [];

    $('.card-img').each(function () {
        var imgSrc = $(this).attr('src');
        var imgFilename = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
        updatedImages.push(imgFilename);
    });



    $('#updatedImages').val(updatedImages.join(','));
    var formElement = document.getElementById("updateNewsForm");
    var formData = new FormData(formElement);

    $.ajax({
        url: '/Project/Api/api.php',
        method: 'POST',
        data: formData, 
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            alert("News updated successfully");
        },
        error: function (error) {
            console.log(error);
        }
      });
  });

  $('.card .bi-x-circle-fill').on('click', function () {
    var card = $(this).closest('.card');
    var imgSrc = card.find('.card-img').attr('src');
    var imgFilename = imgSrc.substring(imgSrc.lastIndexOf('/') + 1);
    var id = $('#NewsID').val();
    console.log($(".card").length);

    if ($(".card").length > 1) {
      if (confirm('Are you sure you want to delete this image?')) {
        $.ajax({
            url: '/Project/Api/api.php',
            method: 'POST',
            data: { deleteNewsImage: imgFilename,id: id },
            dataType: "json",
            success: function (data) {
                card.remove();
                console.log(data);
            },
            error: function (error) {
                console.log("error",error);
            }
        });
    }

    }else {
      alert("News can't have 0 images");
    }
  });


  $('#images').on('change', function (e) {
      var files = e.target.files;

      for (var i = 0; i < files.length; i++) {
          var reader = new FileReader();
          reader.onload = function (event) {
              var imgSrc = event.target.result;
              var newCard = $('<div class="card swiper-slide">' +
                  '<img src="' + imgSrc + '" alt="" class="card-img">' +
                  '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-x-circle-fill delete-image" viewBox="0 0 16 16">' +
                  '<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z" />' +
                  '</svg>' +
                  '</div>');

              $('.card-wrapper').append(newCard);
          };
          reader.readAsDataURL(files[i]);
      }
  });

  $(document).on('click', '.delete-image', function () {
      var card = $(this).closest('.card');
      card.remove();
  });
});

function changeReview(id) {
  var status = document.getElementById("status" + id).value;
  $.ajax({
    url: "/Project/Api/api.php",
    method: "POST",
    data: { status: status, ReviewID: id, updateReview: 1 },
    dataType: "json",
    success: function (data) {
      alert("Review updated successfully");
      if (status === "Rejected") {
        blockUser(id);
      }
    },
    error: function (error) {
      console.log(error);
    },
  });
}
function deleteReview(id) {
  if (confirm("Are you sure you want to delete this review?")) {
    $.ajax({
      url: "/Project/Api/api.php",
      method: "POST",
      data: { ReviewID: id, deleteReview: 1 },
      dataType: "json",
      success: function (data) {
        alert("Review deleted successfully");
        location.reload();
      },
      error: function (error) {
        console.log("error", error);
      },
    });
  }
}

function deleteNews(id) {
  if (confirm("Are you sure you want to delete this News?")) {
    $.ajax({
      url: "/Project/Api/api.php",
      method: "POST",
      data: { NewsID: id, deleteNews: 1 },
      dataType: "json",
      success: function (data) {
        alert("News deleted successfully");
        location.reload();
      },
      error: function (error) {
        console.log("error", error);
      },
    });
  }
}
function deleteUser(id) {
  if (confirm("Are you sure you want to delete this user?")) {
    $.ajax({
      url: "/Project/Api/api.php",
      method: "POST",
      data: { UserID: id, deleteUser: 1 },
      dataType: "json",
      success: function (data) {
        alert("User deleted successfully");
        location.reload();
      },
      error: function (error) {
        console.log("error", error);
      },
    });
  }
}
function deleteNews(id) {
  if (confirm("Are you sure you want to delete this News?")) {
    $.ajax({
      url: "/Project/Api/api.php",
      method: "POST",
      data: { NewsID: id, deleteNews: 1 },
      dataType: "json",
      success: function (data) {
        alert("News deleted successfully");
        location.reload();
      },
      error: function (error) {
        console.log("error", error);
      },
    });
  }
}
function blockUser(id) {
  if (confirm("Do you want to block this user?")) {
    $.ajax({
      url: "/Project/Api/api.php",
      method: "POST",
      data: { UserID: id, blockUser: 1 },
      dataType: "json",
      success: function (data) {
        alert("User blocked successfully");
        location.reload();
      },
      error: function (error) {
        console.log(error);
      },
    });
  }
}


 
var swiper = new Swiper(".slide-content", {
  slidesPerView: 3,
  spaceBetween: 25,
  loop: true,
  centerSlide: 'true',
  fade: 'true',
  grabCursor: 'true',
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },

  breakpoints:{
      0: {
          slidesPerView: 1,
      },
      520: {
          slidesPerView: 2,
      },
      950: {
          slidesPerView: 3,
      },
  },
});

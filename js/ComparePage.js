
$(document).ready(function () {

  for (let index = 1; index < 4; index++) {
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
});

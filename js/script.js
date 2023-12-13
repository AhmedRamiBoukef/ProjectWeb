const root = document.documentElement;
const marqueeElementsDisplayed = getComputedStyle(root).getPropertyValue("--marquee-elements-displayed");
const marqueeContent = document.querySelector("ul.marquee-content");

root.style.setProperty("--marquee-elements", marqueeContent.children.length);

for(let i=0; i<marqueeElementsDisplayed; i++) {
  marqueeContent.appendChild(marqueeContent.children[i].cloneNode(true));
}


$(document).ready(function () {
  for (let index = 1; index < 4; index++) {
    
    $('#vehicle_picker_brand'+index).on('change', function () {
        var selectedBrand = $(this).val();
  
        $.ajax({
            url: '/Project/Api/api.php',
            method: 'POST',
            data: {brandID: selectedBrand},
            dataType: 'json', 
            success: function (models) {
                var modelDropdown = $('#vehicle_picker_model'+index);
                modelDropdown.empty(); 
                $('#vehicle_picker_year'+index).empty();
                $('#vehicle_picker_version'+index).empty();
                $('#vehicle_picker_year'+index).append('<option value="" selected="">Choose a Year</option>');
                $('#vehicle_picker_version'+index).append('<option value="" selected="">Choose a Version</option>');
                modelDropdown.append('<option value="" selected="">Choose a Model</option>'); 
  
                $.each(models, function (index, model) {
                    modelDropdown.append('<option value="' + model.ModelID + '">' + model.ModelName + '</option>');
                });
            }
        });
    });
    $('#vehicle_picker_model'+index).on('change', function () {
        var selectedModel = $(this).val();
        $.ajax({
            url: '/Project/Api/api.php',
            method: 'POST',
            data: {modelID: selectedModel},
            dataType: 'json', 
            success: function (models) {
                var yaarDropdown = $('#vehicle_picker_year'+index);
                yaarDropdown.empty(); 
                yaarDropdown.append('<option value="" selected="">Choose a Year</option>'); 
                $.each(models, function (index, model) {
                    yaarDropdown.append('<option value="' + model.ModelID + '">' + model.ModelYear + '</option>');
                });
            }
        });
    });
    $('#vehicle_picker_model'+index).on('change', function () {
        var selectedModel = $(this).val();
        $.ajax({
            url: '/Project/Api/api.php?year=1&modelID='+ selectedModel,
            method: 'GET',
            dataType: 'json', 
            success: function (infos) {
                var versionDropdown = $('#vehicle_picker_version'+index);
                versionDropdown.empty(); 
                versionDropdown.append('<option value="" selected="">Choose a Version</option>'); 
  
                $.each(infos, function (index, info) {
                    versionDropdown.append('<option value="' + info.VehicleID + '">' + info.Version + '</option>');
                });
            }
        });
    });
  }
  $('.compare-button').on('click', function () {
      var selectedVersion1 = $('#vehicle_picker_version1').val();
      var selectedVersion2 = $('#vehicle_picker_version2').val();
      var selectedVersion3 = $('#vehicle_picker_version3').val();
      var selectedVersion4 = $('#vehicle_picker_version4').val();
      if ($('#vehicle_picker_brand1').val() === '' || $('#vehicle_picker_model1').val() === '' || $('#vehicle_picker_brand2').val() === '' || $('#vehicle_picker_model2').val() === '' || $('#vehicle_picker_version1').val() === '' || $('#vehicle_picker_version2').val() === '' || $('#vehicle_picker_year1').val() === '' || $('#vehicle_picker_year2').val() === '') {
          alert('Please fill in the first two vehiculs to compare.');
          return;
      }
      if ((selectedVersion1 !== '' && (selectedVersion1 === selectedVersion2 || selectedVersion1 === selectedVersion3 || selectedVersion1 === selectedVersion4)) ||
            (selectedVersion2 !== '' && (selectedVersion2 === selectedVersion3 || selectedVersion2 === selectedVersion4)) ||
            (selectedVersion3 !== '' && selectedVersion3 === selectedVersion4)) {
            alert("Some of the selected versions are the same. Please select different versions.");
            return;
        }

      location.href = '/Project/compare/?vehicleID='+selectedVersion1+'&vehicleID='+selectedVersion2;
      if(selectedVersion3 != ""){
        location.href = '/Project/compare/?vehicleID='+selectedVersion1+'&vehicleID='+selectedVersion2+'&vehicleID='+selectedVersion3;
      }
      if(selectedVersion4 != ""){
        location.href = '/Project/compare/?vehicleID='+selectedVersion1+'&vehicleID='+selectedVersion2+'&vehicleID='+selectedVersion3+'&vehicleID='+selectedVersion4;
      }

  });
});
const root = document.documentElement;
const spinnerElementsDisplayed = getComputedStyle(root).getPropertyValue("--spinner-elements-displayed");
const spinnerContent = document.querySelector("ul.spinner-content");
let offset = 12; 
const limit = 10; 


if (spinnerContent) {
    root.style.setProperty("--spinner-elements", spinnerContent.children.length);
    
    for(let i=0; i<spinnerElementsDisplayed; i++) {
      spinnerContent.appendChild(spinnerContent.children[i].cloneNode(true));
    }
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

      location.href = '/Project/compare/?vehicleID1='+selectedVersion1+'&vehicleID2='+selectedVersion2;
      if(selectedVersion3 != ""){
        location.href = '/Project/compare/?vehicleID1='+selectedVersion1+'&vehicleID2='+selectedVersion2+'&vehicleID3='+selectedVersion3;
      }
      if(selectedVersion4 != ""){
        location.href = '/Project/compare/?vehicleID1='+selectedVersion1+'&vehicleID2='+selectedVersion2+'&vehicleID3='+selectedVersion3+'&vehicleID4='+selectedVersion4;
      }

  });


    const loadMoreBtn = $('#load-more-btn');
    const newsContainer = $('#news-container');

    let nombre = 0;
    loadMoreBtn.on('click', function () {
        $.ajax({
            url: `/Project/Api/api.php?getNews=1`,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                nombre = data.NumberOfNews;
            },
            error: function (error) {
                console.error('Error fetching news:', error);
            }
        });
        console.log(nombre);
        console.log(newsContainer[0].children.length);
        console.log(limit);
        console.log(offset);
        if (newsContainer[0].children.length < nombre) {
            fetchNews();
        }
    });

    function fetchNews() {
        $.ajax({
            url: `/Project/Api/api.php?offset=${offset}&limit=${limit}`,
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                appendNewsToContainer(data);
                offset = offset+limit;
                console.log("offezfez",offset);
            },
            error: function (error) {
                console.error('Error fetching news:', error);
            }
        });
    }

    function appendNewsToContainer(newsData) {
        $.each(newsData, function (_, newsItem) {
            const newsCard = createNewsCard(newsItem);
            newsContainer.append(newsCard);
        });
    }

    function createNewsCard(newsItem) {
        const card = $('<a>', {
            href: `/Project/news/detail/?id=${newsItem['NewsID']}`,
            class: 'news-card'
        });
    
        const imageContainer = $('<div>');
        const image = $('<img>', {
            src: `/Project/public/images/${newsItem['ImagePath']}`,
            alt: ''
        });
        imageContainer.append(image);
    
        const contentContainer = $('<div>');
        
        const shortenedTitle = newsItem['Title'].length > 32 ? newsItem['Title'].substring(0, 32) + '...' : newsItem['Title'];
        const title = $('<h1>', { text: shortenedTitle });
    
        let shortenedContent = newsItem['Content'].length > 110 ? newsItem['Content'].substring(0, 110) + '...' : newsItem['Content'];
    
        shortenedContent = shortenedContent.padEnd(110, ' ');
    
        const paragraph = $('<p>', { text: shortenedContent });
        const publishedDate = $('<h3>', { text: `Published · ${formatDate(newsItem['Date'])}` });
    
        contentContainer.append(title, paragraph, publishedDate);
        card.append(imageContainer, contentContainer);
    
        return card;
    }
    

    function formatDate(dateString) {
        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', options);
    }
});
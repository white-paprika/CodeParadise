$(document).ready(function(){

    // 
    var searchbar = document.getElementById("searchbar");
    var minPriceInput = document.getElementById("min-price-input");
    var maxPriceInput = document.getElementById("max-price-input");
    var maxPriceSlider = document.getElementById("max-price-slider");
    var minPriceSlider = document.getElementById("min-price-slider");
    var sortSelect = document.getElementById("sort_select");


    // BEING CALLED ON LISTENERS
    function sendAjaxQuery() {

      var searchbarInputValue = searchbar.value;
      var minPriceInputValue = minPriceInput.value;
      var maxPriceInputValue = maxPriceInput.value;
      var sortSelectValue = sortSelect.value;
      var genreCheckboxesValuesArray = $('input[name="filter[genres][]"]:checked').map(function() {
        return this.value;
      }).get();   
      
      // GENERATING AND CHANGING URL

      // Works even without .toLowerCase().replace(/ /g, "+");
      var genreCheckboxesValuesUrlSubstring = genreCheckboxesValuesArray.join(",").toLowerCase().replace(/ /g, "+");
      // Generating new url
      const QUERYPARAM = `filter[name]=${searchbarInputValue}&filter[price_range]=${minPriceInputValue},${maxPriceInputValue}&filter[genres]=${genreCheckboxesValuesUrlSubstring}&sort=${sortSelectValue}`;
      // Applying new url
      window.history.pushState(null, null, `admin/books?${QUERYPARAM}`);
      
      // SENDING AJAX REQUEST
      $.ajax({
        url:"/admin/books", 
        type:"GET",        
        data: {
            "_token": "{{ csrf_token() }}",
            "filter[name]": searchbarInputValue,
            "filter[price_range][]": [minPriceInputValue, maxPriceInputValue],
            "filter[genres][]": genreCheckboxesValuesArray, 
            "sort": sortSelectValue,
        },              
        success: function(response) {
          $('.content-table').html(response)
          // console.log(response);
        },
        error: function(xhr, status, error) {
          console.log('AJAX CUSTOM ERROR RESPONSE')
          console.log(xhr.responseText);
          console.log(status);
          console.log(error);
        }
        
      })
    }


    // EVENT LISTENERS
    searchbar.addEventListener('keyup', sendAjaxQuery);
    minPriceInput.addEventListener('keyup', sendAjaxQuery);
    maxPriceInput.addEventListener('keyup', sendAjaxQuery);
    minPriceSlider.addEventListener('mouseup', sendAjaxQuery);
    maxPriceSlider.addEventListener('mouseup', sendAjaxQuery);
    sortSelect.addEventListener('change', sendAjaxQuery);
    $('input[name="filter[genres][]"]').on('change', sendAjaxQuery);
  });
$(document).ready(function() {
    $('.search-button').click(function() {
      var searchInput = $('.search-form input[type="text"]');
      var searchTextarea = $('.search-form textarea');
  
      if (searchInput.is(':visible')) {
        searchTextarea.show();
        searchInput.hide();
        $(this).text('Search');
      } else {
        searchInput.show();
        searchTextarea.hide();
        $(this).text('Go');
      }
    });
  });
  
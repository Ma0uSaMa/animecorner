$(document).ready(function() {
  // Attach a click event listener to the sidebar links
  $('.nav-link a').click(function(event) {
    event.preventDefault(); // Prevent the default link behavior

    // Get the page URL from the href attribute of the clicked link
    var page = $(this).attr('href');

    // Update the URL to include the page parameter
    var newURL = 'dashboard.php?page=' + page;

    // Change the browser URL without refreshing the page
    window.history.pushState(null, null, newURL);

    // Load the corresponding page content into the home section
    $('.home').load(page + '.php?page=' + page);
  });
});


    // Get DOM elements
    const toggle = document.querySelector('.toggle');
    const sidebar = document.querySelector('.sidebar');
    const body = document.querySelector('body');
    const modeSwitch = document.querySelector('.toggle-switch');
    const modeText = document.querySelector('.mode-text');

    // Toggle sidebar
    toggle.addEventListener('click', () => {
        sidebar.classList.toggle('close');
    });

    // Toggle dark mode
    modeSwitch.addEventListener('click', () => {
        body.classList.toggle('dark');

        if (body.classList.contains('dark')) {
            modeText.innerText = 'Light Mode';
        } else {
            modeText.innerText = 'Dark Mode';
        }
    });
});

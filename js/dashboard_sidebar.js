$(document).ready(function() {
    // Attach a click event listener to the "Dashboard" link
    $('#dashboard-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.home').show(); // Show the .home section
        $('.registeredusers').hide(); // Hide the .registeredusers section
        $('.publishanime').hide(); // Hide the .publishanime section
    });
    
    // Attach a click event listener to the "Registered Users" link
    $('#registered-users-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.home').hide(); // Hide the .home section
        $('.publishanime').hide(); // Hide the .publishanime section
        $('.registeredusers').show(); // Show the .registeredusers section
        $('.registeredusers').load('../../admin/dashboard/registered_users.php'); // Load the content of registered_users.php into the .registeredusers section
    });

    // Attach a click event listener to the "Publish Anime" link
    $('#publish-anime-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.home').hide(); // Hide the .home section
        $('.registeredusers').hide(); // Hide the .registeredusers section
        $('.publishanime').show(); // Show the .publishanime section
        $('.publishanime').load('../../admin/dashboard/publish_anime.php'); // Load the content of publish_anime.php into the .publishanime section
    });
});

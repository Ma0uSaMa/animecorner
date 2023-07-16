$(document).ready(function() {
    // Attach a click event listener to the "Registered Users" link
    $('#registered-users-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.registeredusers').show(); // Show the .registeredusers section
        $('.home').hide(); // Hide the .home section
        $('.registeredusers').load('../../admin/dashboard/registered_users.php'); // Load the content of registered_users.php into the .registeredusers section
    });
});

$(document).ready(function() {
    // Attach a click event listener to the "Registered Users" link
    $('#registered-users-link').click(function(event) {
        event.preventDefault(); // Prevent the default link behavior
        $('.registeredusers').load('../../admin/dashboard/registered_users.php'); // Load the content of registered_users.php into the .home section
    });
});

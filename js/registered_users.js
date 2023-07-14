// animecorner/js/registered_users.js
$(document).ready(function() {
    function loadRegisteredUsers(event) {
        event.preventDefault(); // Prevent the default link behavior

        // Load the registered_users.php content dynamically
        $.ajax({
            url: "../../admin/dashboard/registered_users.php",
            success: function(data) {
                $('.home').html(data); // Replace the content of the .home section with the loaded content
            },
            error: function() {
                alert('Error loading registered users.'); // Display an error message if the content fails to load
            }
        });
    }

    // Attach the click event listener to the "Registered Users" link
    $('body').on('click', 'a[href="../../admin/dashboard/dashboard.php?registered=users"]', function(event) {
        loadRegisteredUsers(event);
    });
});

$(document).ready(function () {
    // Login function to authenticate the user
    $('#loginForm').on('submit', function (e) {
        e.preventDefault();

        const email = $('#email').val();
        const password = $('#password').val();

        $.ajax({
            url: '/api/login', // Your API login endpoint
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: JSON.stringify({
                email: email,
                password: password
            }),
            success: function (response) {
                // Store the token in localStorage
                localStorage.setItem('token', response.token);

                // Notify the user
                alert('Login successful! Token stored.');

                // Redirect or update the UI
                window.location.href = '/dashboard';
            },
            error: function (xhr) {
                alert('Login failed: ' + xhr.responseJSON.error);
            }
        });
    });

    // Example AJAX setup to include Bearer token in all requests
    $.ajaxSetup({
        beforeSend: function (xhr) {
            const token = localStorage.getItem('token'); // Retrieve the token
            if (token) {
                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
            }
        }
    });

    // Example: Fetching the user's profile
    $('#fetchProfile').on('click', function () {
        $.ajax({
            url: '/api/profile', // Your API profile endpoint
            type: 'GET',
            success: function (response) {
                // Display user profile details
                console.log('User Profile:', response);
                alert('User Profile: ' + JSON.stringify(response));
            },
            error: function (xhr) {
                alert('Failed to fetch profile: ' + xhr.responseJSON.message);
            }
        });
    });

    // Logout function to remove the token
    $('#logout').on('click', function () {
        $.ajax({
            url: '/api/logout', // Your API logout endpoint
            type: 'POST',
            success: function (response) {
                // Clear the token from localStorage
                localStorage.removeItem('token');

                // Notify the user
                alert('Logged out successfully.');

                // Redirect or update the UI
                window.location.href = '/login';
            },
            error: function (xhr) {
                alert('Logout failed: ' + xhr.responseJSON.message);
            }
        });
    });
});

<script>
    const jwtToken = "{{ Cookie::get('jwt_token') }}"; // Pass JWT token from the backend

    // jQuery function to toggle visibility of the buttons based on #ajaxSelection value
    $('#ajaxSelection').on('change', function() {
        if ($(this).val() === 'yes') {
            // Show the button with Ajax and hide the one without Ajax
            $('#withAjax').removeClass('d-none');
            $('#withotAjax').addClass('d-none');
            $('.withAjax').removeClass('d-none');
            $('.withoutAjax').addClass('d-none');
        } else {
            // Show the button without Ajax and hide the one with Ajax
            $('#withotAjax').removeClass('d-none');
            $('#withAjax').addClass('d-none');
            $('.withoutAjax').removeClass('d-none');
            $('.withAjax').addClass('d-none');
        }
    });

    // Handle form submission (either Add or Edit)
    $('#taskForm').on('submit', function(e) {

        e.preventDefault(); // Prevent default form submission behavior
        let isValid = true; // Flag to check if the form is valid

        // Validate Title
        const title = document.getElementById('title');
        const titleError = document.getElementById('title-client-side-error');
        if (title.value.trim() === '') {
            isValid = false;
            title.classList.add('is-invalid');
            titleError.classList.remove('d-none');
            titleError.innerHTML = 'Title is required.';
        } else {
            title.classList.remove('is-invalid');
            titleError.classList.add('d-none');
        }

        // Validate Description
        const description = document.getElementById('description');
        const descriptionError = document.getElementById('description-client-side-error');
        if (description.value.trim() === '') {
            isValid = false;
            description.classList.add('is-invalid');
            descriptionError.classList.remove('d-none');
            descriptionError.innerHTML = 'Description is required.';
        } else {
            description.classList.remove('is-invalid');
            descriptionError.classList.add('d-none');
        }

        // Validate Due Date
        const dueDate = document.getElementById('due_date');
        const dueDateError = document.getElementById('due_date-client-side-error');
        if (!dueDate.value) {
            isValid = false;
            dueDate.classList.add('is-invalid');
            dueDateError.classList.remove('d-none');
            dueDateError.innerHTML = 'Due Date is required.';
        } else {
            dueDate.classList.remove('is-invalid');
            dueDateError.classList.add('d-none');
        }

        // Validate Status
        const status = document.getElementById('status');
        const statusError = document.getElementById('status-client-side-error');
        if (!status.value) {
            isValid = false;
            status.classList.add('is-invalid');
            statusError.classList.remove('d-none');
            statusError.innerHTML = 'Status is required.';
        } else {
            status.classList.remove('is-invalid');
            statusError.classList.add('d-none');
        }

        // Validate Category
        const category = document.getElementById('category');
        const categoryError = document.getElementById('category-client-side-error');
        if (!category.value) {
            isValid = false;
            category.classList.add('is-invalid');
            categoryError.classList.remove('d-none');
            categoryError.innerHTML = 'Category is required.';
        } else {
            category.classList.remove('is-invalid');
            categoryError.classList.add('d-none');
        }

        // Proceed with AJAX request only if the form is valid
        if (isValid) {
            // Collect the form data
            const formData = $(this).serialize();

            // Determine the form method (POST or PUT)
            const actionUrl = $(this).attr('action');
            const method = $(this).attr('method');

            // Make an AJAX request to submit the form
            $.ajax({
                url: actionUrl,
                type: method,
                data: formData,
                headers: {
                    'Authorization': `Bearer ${jwtToken}`, // jwtToken should be the value stored in cookies or elsewhere
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'), // CSRF token for Laravel
                },
                success: function(response) {
                    // On success, hide the modal
                    $('#taskModal').modal('hide');

                    // Reload the DataTable
                    if ($.fn.DataTable.isDataTable('#tasks-table')) {
                        $('#tasks-table').DataTable().ajax.reload();
                        $('#ajaxSelection').val('no');
                    }

                    // Show a success message
                    // alert('Task has been updated successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);

                    // Show an error message to the user
                    alert('An error occurred while updating the task. Please try again.');
                },
            });
        }
    });

    // This function is called when the "Edit" button is clicked
    function editTask(taskId) {
        // Make an AJAX request to fetch the task details
        $.ajax({
            url: '/api/tasks/' + taskId, // URL to get task details by ID
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${jwtToken}`, // jwtToken should be the value stored in cookies or elsewhere
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
            },
            success: function(response) {
                // Assuming 'response' contains the task data

                // Fill the modal form with task data
                $('#title').val(response.data.title).prop('disabled', false);
                $('#description').val(response.data.description).prop('disabled', false);
                $('#due_date').val(response.data.due_date).prop('disabled', false);
                $('#status').val(response.data.status).prop('disabled', false);
                $('#category').val(response.data.category).prop('disabled', false);
                $('#submitTask').prop('disabled', false);
                

                // Fill the modal form with task data
                $('#title').val(response.data.title);
                $('#description').val(response.data.description);
                $('#due_date').val(response.data.due_date);
                $('#status').val(response.data.status);
                $('#category').val(response.data.category);

                // Change the form action to update task
                $('#taskForm').attr('action', `/api/tasks/${taskId}`);
                $('#taskForm').attr('method', 'POST');

                // Update the modal title for edit
                $('#taskModalLabel').text('Edit Task Information');

                // Show the modal
                $('#taskModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);

                // Optionally show an error message to the user
                alert('An error occurred while fetching task details. Please try again.');
            },
        });
    }

    // This function is called when the "Show" button is clicked
    function showTask(taskId) {
        // Make an AJAX request to fetch the task details
        $.ajax({
            url: '/api/tasks/' + taskId, // URL to get task details by ID
            type: 'GET',
            headers: {
                'Authorization': `Bearer ${jwtToken}`, // jwtToken should be the value stored in cookies or elsewhere
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
            },
            success: function(response) {
                // Assuming 'response' contains the task data

                // Fill the modal form with task data
                $('#title').val(response.data.title).prop('disabled', true);
                $('#description').val(response.data.description).prop('disabled', true);
                $('#due_date').val(response.data.due_date).prop('disabled', true);
                $('#status').val(response.data.status).prop('disabled', true);
                $('#category').val(response.data.category).prop('disabled', true);
                $('#submitTask').prop('disabled', true);

                // Change the form action to just show the task (no update action needed)
                $('#taskForm').attr('action', '#'); // No action for read-only form
                $('#taskForm').attr('method', 'GET'); // Read-only method

                // Update the modal title for showing the task
                $('#taskModalLabel').text('Show Task Information');

                // Show the modal
                $('#taskModal').modal('show');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);

                // Optionally show an error message to the user
                alert('An error occurred while fetching task details. Please try again.');
            },
        });
    }

    // This function is called when the "Delete" button is clicked
    function deleteTask(taskId) {
        // Ask for confirmation before deleting
        if (confirm("Are you sure you want to delete this task?")) {
            // Make an AJAX request to delete the task
            console.log(jwtToken);
            $.ajax({
                url: '/api/tasks/' + taskId, // URL to delete the task by ID
                type: 'DELETE',
                headers: {
                    'Authorization': `Bearer ${jwtToken}`, // jwtToken should be the value stored in cookies or elsewhere
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token for Laravel
                },
                success: function(response) {
                    // On success, reload the DataTable
                    if ($.fn.DataTable.isDataTable('#tasks-table')) {
                        $('#tasks-table').DataTable().ajax.reload();
                        $('#ajaxSelection').val('no');
                    }

                    // Optionally show a success message to the user
                    // alert('Task has been deleted successfully!');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);

                    // Optionally show an error message to the user
                    alert('An error occurred while deleting the task. Please try again.');
                },
            });
        }
    }

    // This function is called when the "Add" button is clicked
    function addTask() {
        // Reset the form for adding a new task
        $('#taskForm')[0].reset();

        // Change the form action to create a new task
        $('#taskForm').attr('action', '/api/tasks');
        $('#taskForm').attr('method', 'POST');

        // Update the modal title for adding a new task
        $('#taskModalLabel').text('Add New Task');

        // Show the modal
        $('#taskModal').modal('show');
    }
</script>

<script>
    $(document).ready(function() {
        let perPageSelector = $('#perPage');
        let globalSearch = $('#globalSearch');
        let recordsTable = $('.records-table');
        let recordsLoader = $('.records-loader');
        let page = new URLSearchParams(window.location.search).get('page') || 1;
        let totalRecordsElements = $('#totalRecordsElement');
        let records_prefix = '{{ $records_prefix }}';
        let dataTable = $('#' + records_prefix + '-table').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: '{!! route($records_prefix . '.data') !!}', // Make sure route is correctly defined
                data: function(d) {
                    d.length = perPageSelector.val();
                    d.search = globalSearch.val();
                    d.page = page;
                    d.status = $('#statusFilter').val(); // Send selected status
                    d.category = $('#categoryFilter').val(); // Send selected category
                }
            },
            columns: @json($columns), // Ensure columns are properly passed as JSON
            search: false,
            paging: true, // Enable default pagination controls
            dom: 'lrtip', // Default DataTable controls (length, filter, table, info, pagination)
            drawCallback: function(response) {
                recordsLoader.hide();
                console.log(response.json);
                totalRecordsElements.text(response.json.recordsTotal);
            },
            // order: [[0, 'desc']] // Set the order to descending
        });

        // $('#tasks-table_info').hide();
        $('#tasks-table_length').hide();
        // $('tasks-table_paginate').css('float:left')
        // Show loader inside table when processing starts
        dataTable.on('processing.dt', function(e, settings, processing) {
            if (processing) {
                recordsTable.hide();
                recordsLoader.show();
            } else {
                recordsTable.show();
                recordsLoader.hide();
            }
        });

        // Handle Per Page Dropdown Change
        $('#perPage').change(function() {
            dataTable.ajax.reload(); // Reload DataTable with new per-page value
        });

        // Handle Global Search Input
        $('#globalSearch').keyup(function() {
            dataTable.ajax.reload(); // Reload DataTable with new search value
        });

        // Update the page parameter when navigating between pages
        dataTable.on('page.dt', function() {
            var info = dataTable.page.info();
            page = info.page + 1; // Set current page number from DataTable info
        });

        // When the filter values change, reload the table
        document.getElementById('statusFilter').addEventListener('change', function() {
            reloadTable();
        });

        document.getElementById('categoryFilter').addEventListener('change', function() {
            reloadTable();
        });

        // Reload the table with the updated filters
        function reloadTable() {
            let status = document.getElementById('statusFilter').value;
            let category = document.getElementById('categoryFilter').value;

            // Use DataTables' API to reload the table with new filter parameters
            $('#tasks-table').DataTable().ajax.reload();
        }
    });
</script>

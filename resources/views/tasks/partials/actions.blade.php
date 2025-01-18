@php
    $recordPrefix = 'tasks';
    $id = $task->id;
@endphp

<div class="btn-group" role="group" aria-label="{{ $recordPrefix }} Actions">
    <!-- Show Button -->
    <a title="View" href="{{ route($recordPrefix . '.show', $id) }}" class="withoutAjax btn btn-success btn-sm">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Show Button -->
    <a title="View" href="javascript:void(0);" onclick="showTask({{ $id }})" class="withAjax btn btn-success btn-sm d-none">
        <i class="fas fa-eye"></i>
    </a>

    <!-- Edit Button -->
    <a title="Edit" href="{{ route($recordPrefix . '.edit', $id) }}" class="withoutAjax btn btn-primary btn-sm ml-2">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Edit Button -->
    <a title="Edit" href="javascript:void(0);" onclick="editTask({{ $id }})" data-id="{{ $id }}"
        class="withAjax btn btn-primary btn-sm ml-2 d-none">
        <i class="fas fa-edit"></i>
    </a>

    <!-- Delete Button -->
    <button title="Delete" type="button" class="withoutAjax btn bg-red btn-danger btn-sm ml-2"
        onclick="$('#confirm input[name=\'id\']').val({{ $id }}); 
            $('#confirm form').attr('action', '/tasks/' + {{ $id }}); 
            event.preventDefault(); 
            $('#confirm').modal('show');">
        <i class="fas fa-trash"></i>
    </button>

    <!-- Delete Button -->
    <button title="Delete" type="button" class="withAjax bg-red btn-danger btn-sm ml-2 d-none"
        onclick="deleteTask({{ $id }})">
        <i class="fas fa-trash"></i>
    </button>

    <!-- Include Delete Confirmation Modal -->
    @include('common.delete-confirmation')
</div>

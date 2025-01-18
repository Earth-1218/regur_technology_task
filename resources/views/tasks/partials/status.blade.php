@switch($task->status)
    @case('todo')
        <span class="badge badge-secondary">To Do</span>
        @break

    @case('in_progress')
        <span class="badge badge-warning">In Progress</span>
        @break

    @case('done')
        <span class="badge badge-success">Done</span>
        @break

    @default
        <span class="badge badge-light">To Do</span>
@endswitch

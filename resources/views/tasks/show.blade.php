@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-3">
        <div class="card-header bg-grey">
            Task Information
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th width="30%">ID</th>
                        <td width="70%">{{ $task->id }}</td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>{{ $task->title }}</td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td>{{ $task->description }}</td>
                    </tr>
                    <tr>
                        <th>Due Date</th>
                        <td>{{ \Carbon\Carbon::parse($task->due_date)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($task->status == 'todo')
                                <span class="badge bg-secondary">To Do</span>
                            @elseif($task->status == 'in_progress')
                                <span class="badge bg-primary">In Progress</span>
                            @elseif($task->status == 'done')
                                <span class="badge bg-success">Done</span>
                            @else
                                <span class="badge bg-warning">Unknown</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Category</th>
                        <td>{{ $task->category }}</td>
                    </tr>
                    <tr>
                        <th>Created At</th>
                        <td>{{ \Carbon\Carbon::parse($task->created_at)->format('d-m-Y H:i:s') }}</td>
                    </tr>
                    <tr>
                        <th>Updated At</th>
                        <td>{{ \Carbon\Carbon::parse($task->updated_at)->format('d-m-Y H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to List</a>
        </div>
    </div>
</div>
@endsection

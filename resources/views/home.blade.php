@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header text-left">{{ __('Home') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Status</th>
                                <th>Task Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-info">
                                <td><i class="fas fa-spinner"></i> In Progress</td>
                                <td><strong>{{ $inProgressCount }}</strong></td>
                            </tr>
                            <tr class="table-warning">
                                <td><i class="fas fa-tasks"></i> To Do</td>
                                <td><strong>{{ $todoCount }}</strong></td>
                            </tr>
                            <tr class="table-success">
                                <td><i class="fas fa-check-circle"></i> Done</td>
                                <td><strong>{{ $doneCount }}</strong></td>
                            </tr>
                            <tr class="table-success">
                                <td><i class="fas fa-square"></i> Total Tasks</td>
                                <td><strong>{{ $totalTaskCount }}</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

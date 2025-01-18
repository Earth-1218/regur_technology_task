@extends('layouts.app')

@section('content')
    <div class="container" >
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3" >
                    <div class="card-header">
                        <div class="d-flex align-items-center justify-content-between">
                            <p class="mb-0">Tasks</p>
                            <div class="d-flex align-items-center gap-2">
                                <label>Request through AJAX</label>
                                <select class="form-control" id="ajaxSelection" style="width: auto;">
                                    <option value="yes">Yes</option>
                                    <option value="no" selected>No</option>
                                </select>
                                <button id="withAjax" class="d-none btn btn-primary" onclick="addTask()">
                                    {{ __('Add task') }}
                                </button>
                                <a id="withotAjax" href="{{ route('tasks.add') }}" class="btn btn-primary">
                                    {{ __('Add task') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            @include('common.perpage')
                            <!-- Status Filter -->
                            <div class="d-flex align-items-center gap-2" onchange="">
                                <label for="statusFilter" class="mb-0">Status</label>
                                <select class="form-control" id="statusFilter" style="width: auto;">
                                    <option value="">All</option>
                                    <option value="todo">Todo</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <!-- Category Filter -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="categoryFilter" class="mb-0">Category</label>
                                <select class="form-control" id="categoryFilter" style="width: auto;">
                                    <option value="">All</option>
                                    <option value="work">Work</option>
                                    <option value="personal">Personal</option>
                                    <option value="miscellaneous">Miscellaneous</option>
                                </select>
                            </div>
                            @include('common.search')
                        </div>
                        <div class="table-responsive">
                            <table id="tasks-table" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date <i class="fa fa-solid fa-sort"</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="records-table">
                                </tbody>
                                <tbody style="width:100%; display:none;" class="records-loader">
                                    <tr>
                                        <td colspan="8">
                                            <div class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="d-none">
                                    <tr>
                                        <th>ID</th>
                                        <th>User ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Due Date</th>
                                        <th>Status</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
    @endpush
    @push('scripts')
        @php
            $options = [
                'records_prefix' => 'tasks',
                'columns' => [
                    ['data' => 'id', 'name' => 'id', 'orderable' => false, 'searchable' => false],
                    ['data' => 'user_id', 'name' => 'user_id', 'orderable' => false, 'searchable' => false],
                    ['data' => 'title', 'name' => 'title', 'orderable' => false, 'searchable' => false],
                    ['data' => 'description', 'name' => 'description', 'orderable' => false, 'searchable' => false],
                    ['data' => 'due_date', 'name' => 'due_date'],
                    ['data' => 'status', 'name' => 'status', 'orderable' => false, 'searchable' => false],
                    ['data' => 'category', 'name' => 'category', 'orderable' => false, 'searchable' => false],
                    ['data' => 'actions', 'name' => 'actions', 'orderable' => false, 'searchable' => false],
                ],
            ];
        @endphp
        @include('common.datatable', $options)
        @include('tasks.modals.add-edit')
        @include('tasks.partials.custom')
    @endpush
@endsection

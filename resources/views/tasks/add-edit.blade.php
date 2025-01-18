@extends('layouts.app')

@section('content')
    <div class="container ">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header bg-grey">
                        {{ isset($task) ? 'Edit Task Information' : 'Add Task Information' }}
                    </div>
                    <div class="card-body">
                        <form method="POST"
                            action="{{ isset($task) ? route('tasks.update', $task->id) : route('tasks.store') }}">
                            @csrf
                            @if (isset($task))
                                @method('PUT')
                            @endif

                            <!-- Title -->
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror"
                                    id="title" name="title" value="{{ old('title', $task->title ?? '') }}"
                                    placeholder="Enter title" required>
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="3" placeholder="Enter description" required>{{ old('description', $task->description ?? '') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Due Date -->
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control @error('due_date') is-invalid @enderror"
                                    id="due_date" name="due_date"
                                    value="{{ old('due_date', isset($task->due_date) ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}"
                                    required>
                                @error('due_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="" disabled
                                        {{ old('status', $task->status ?? '') == '' ? 'selected' : '' }}>Select status
                                    </option>
                                    <option value="todo"
                                        {{ old('status', $task->status ?? '') == 'todo' ? 'selected' : '' }}>Todo</option>
                                    <option value="in_progress"
                                        {{ old('status', $task->status ?? '') == 'in_progress' ? 'selected' : '' }}>In
                                        Progress</option>
                                    <option value="done"
                                        {{ old('status', $task->status ?? '') == 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <select class="form-select @error('category') is-invalid @enderror" id="category"
                                    name="category" required>
                                    <option value="" disabled
                                        {{ old('category', $task->category ?? '') == '' ? 'selected' : '' }}>Select status
                                    </option>
                                    <option value="work"
                                        {{ old('category', $task->category ?? '') == 'work' ? 'selected' : '' }}>Work
                                    </option>
                                    <option value="personal"
                                        {{ old('category', $task->category ?? '') == 'personal' ? 'selected' : '' }}>
                                        Personal</option>
                                    <option value="miscellaneous"
                                        {{ old('category', $task->category ?? '') == 'miscellaneous' ? 'selected' : '' }}>
                                        Miscellaneous</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Submit and Back -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to List</a>
                                <button type="submit"
                                    class="bg-green btn btn-success">{{ isset($task) ? 'Update Task' : 'Add Task' }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

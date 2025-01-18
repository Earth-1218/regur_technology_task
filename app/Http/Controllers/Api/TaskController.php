<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    // Display the task index page with paginated tasks
    public function index(Request $request): JsonResponse
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date', 'asc')
            ->paginate($request->input('perpage', 10)); // Default pagination is 10

        return response()->json([
            'success' => true,
            'data' => $tasks
        ]);
    }

    // Fetch data for DataTables
    public function getData(Request $request): JsonResponse
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->search) {
            $searchValue = $request->search;
            $query->where('title', 'like', "%{$searchValue}%");
        }

        $totalRecords = Task::where('user_id', Auth::id())->count();
        $filteredRecords = $query->count();

        $page = $request->page > 0 ? $request->page : 1;
        $limit = $request->length > 0 ? $request->length : 10;
        $offset = ($page - 1) * $limit;

        $data = $query->skip($offset)->take($limit)->orderBy('id','desc');

        return response()->json([
            'success' => true,
            'draw' => intval($request->input('draw', 0)),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data->get(),
        ]);
    }

    // Store a new task in the database
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:todo,in_progress,done',
            'category' => 'required|in:work,personal,miscellaneous',
        ]);

        $task = Task::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'category' => $request->category,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task created successfully.',
            'data' => $task
        ], 201);
    }

    // Show task details
    public function show(Task $task): JsonResponse
    {
        // Ensure the user is authorized to view the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $task
        ]);
    }

    // Update an existing task in the database
    public function update(Request $request, Task $task): JsonResponse
    {
        // Ensure the user is authorized to update the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:todo,in_progress,done',
            'category' => 'required|in:work,personal,miscellaneous',
        ]);

        $task->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'category' => $request->category,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Task updated successfully.',
            'data' => $task
        ]);
    }

    // Delete a task from the database
    public function destroy(Task $task): JsonResponse
    {
        // Ensure the user is authorized to delete the task
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized action.'], 403);
        }

        $task->delete();

        return response()->json([
            'success' => true,
            'message' => 'Task deleted successfully.'
        ]);
    }
}

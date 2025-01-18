<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TaskController extends Controller
{
    // Display the task index page with paginated tasks
    public function index(Request $request)
    {
        $tasks = Task::where('user_id', Auth::id())
            ->orderBy('due_date', 'asc')
            ->paginate($request->input('perpage', 10)); // Default pagination is 10

        return view('tasks.index', compact('tasks'));
    }

    // Fetch data for DataTables
    public function getData(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        // Apply status filter
        if ($request->filled('status')) {
            $statusValue = $request->input('status');
            $query->where('status', $statusValue);
        }
        // Apply category filter
        if ($request->filled('category')) {
            $categoryValue = $request->input('category');
            $query->where('category', $categoryValue);
        }

        // Apply search filter
        if ($request->search) {
            $searchValue = $request->search;
            $query->where('title', 'like', "%{$searchValue}%");
        }

        // Total records before filtering
        $totalRecords = Task::where('user_id', Auth::id())->count();

        // Total records after filtering
        $filteredRecords = $query->count();

        // Pagination
        $page = $request->page > 0 ? $request->page : 1; // Default to page 1
        $limit = $request->length > 0 ? $request->length : 10; // Default to 10 entries per page
        $offset = ($page - 1) * $limit;

        // Sorting logic
        $orderColumnIndex = $request->input('order.0.column', 0); // Get the first column index (default to 0)
        $orderDirection = $request->input('order.0.dir', 'asc'); // Get the sorting direction (asc or desc)

        // Define the columns mapping (index to database column)
        $columns = [
            0 => 'id',
            1 => 'user_id',
            2 => 'title',
            3 => 'description',
            4 => 'due_date',
            5 => 'status',
            6 => 'category',
        ];

        // Map the column index to the actual database column
        $orderByColumn = $columns[$orderColumnIndex] ?? 'id'; // Default to 'id' if invalid index

        // Apply sorting
        $data = $query->skip($offset)->take($limit)->orderBy($orderByColumn, $orderDirection);

        // Create DataTables response
        return DataTables::of($data)
            ->addColumn('actions', function ($task) {
                return view('tasks.partials.actions', compact('task'))->render();
            })
            ->addColumn('status', function ($task) {
                return view('tasks.partials.status', compact('task'))->render();
            })
            ->rawColumns(['actions', 'status'])
            ->with([
                'draw' => intval($request->input('draw', 0)),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $filteredRecords,
            ])
            ->make(true);
    }


    // Display form for adding a new task
    public function add()
    {
        return view('tasks.add-edit');
    }

    // Display form for editing an existing task
    public function edit(Task $task)
    {
        // Ensure the user is authorized to edit the task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.add-edit', compact('task'));
    }

    // Store a new task in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:todo,in_progress,done',
            'category' => 'required|in:work,personal,miscellaneous',
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'category' => $request->category,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    // Update an existing task in the database
    public function update(Request $request, Task $task)
    {
        // Ensure the user is authorized to update the task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'status' => 'required|in:todo,in_progress,done',
            'category' => 'required|in:work,personal,miscellaneous',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'status' => $request->status,
            'category' => $request->category,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    // Delete a task from the database
    public function destroy(Task $task)
    {
        // Ensure the user is authorized to delete the task
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}

<!-- Modal for Add/Edit Task -->
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="taskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="taskModalLabel">Task Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- The form content -->
                <form id="taskForm" novalidate>
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}"/>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
                        <div id="title-client-side-error" class="invalid-feedback">Title is required and cannot be empty.</div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description" required></textarea>
                        <div id="description-client-side-error" class="invalid-feedback">Description is required and cannot be empty.</div>
                    </div>

                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date" required>
                        <div id="due_date-client-side-error" class="invalid-feedback">Please select a valid due date.</div>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="" disabled selected>Select status</option>
                            <option value="todo">Todo</option>
                            <option value="in_progress">In Progress</option>
                            <option value="done">Done</option>
                        </select>
                        <div id="status-client-side-error" class="invalid-feedback">Please select a valid status.</div>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select" id="category" name="category" required>
                            <option value="" disabled selected>Select category</option>
                            <option value="work">Work</option>
                            <option value="personal">Personal</option>
                            <option value="miscellaneous">Miscellaneous</option>
                        </select>
                        <div id="category-client-side-error" class="invalid-feedback">Please select a valid category.</div>
                    </div>

                    <!-- Submit -->
                    <div class="d-flex justify-content-end">
                        <button type="submit" id="submitTask" class="btn bg-green btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

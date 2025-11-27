<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        * {
            font-family: "Inter", serif;
            font-optical-sizing: auto;
            font-style: normal;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-4">
        <h2 class="mb-4">To-Do List</h2>

        <ul class="nav nav-tabs" id="todoTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#all">Home</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#pending">Pending</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#completed">Completed</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#manage-task">Manage Task</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#trash">Trash</button>
            </li>
        </ul>

        <!-- Home -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="all">
                <form action="{{ route('tasks.store') }}" method="POST" novalidate class="mb-5">
                    @csrf
                    <div class="mb-2">
                        <input type="text" name="name" placeholder="Task Name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror">
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-2">
                        <div class="form-floating">
                            <select class="form-select @error('priority') is-invalid @enderror" name="priority" id="priority">
                                <option disabled {{ old('priority') ? '' : 'selected' }}>-- Select Priority --</option>
                                <option value="High" {{ old('priority') == 'High' ? 'selected' : '' }}>High</option>
                                <option value="Medium" {{ old('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Low" {{ old('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                            </select>
                            <label for="floatingSelectProgram">Priority</label>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <input type="date" name="deadline" id="date" value="{{ old('deadline') }}" class="form-control @error('deadline') is-invalid @enderror" />
                        @error('deadline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-primary mt-2 ms-auto d-block">Add Task</button>
                </form>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Prepare presentation slides</td>
                            <td>Medium</td>
                            <td>2025-12-05</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pending -->
            <div class="tab-pane fade" id="pending">
                <div class="input-group mb-4">
                    <input id="taskInput" type="text" class="form-control" placeholder="Filter task...">
                    <button id="addTaskBtn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                    </button>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->deadline->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Completed -->
            <div class="tab-pane fade" id="completed">
                <div class="input-group mb-4">
                    <input id="taskInput" type="text" class="form-control" placeholder="Filter task...">
                    <button id="addTaskBtn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                    </button>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Completed</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Prepare presentation slides</td>
                            <td>Medium</td>
                            <td>2025-12-05</td>
                            <td>2025-12-04</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Manage Task -->
            <div class="tab-pane fade" id="manage-task">
                <div class="input-group mb-4">
                    <input id="taskInput" type="text" class="form-control" placeholder="Filter task...">
                    <button id="addTaskBtn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                    </button>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->deadline->format('Y-m-d') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-secondary"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editTaskModal"
                                        data-id="{{ $task->id }}"
                                        data-name="{{ $task->name }}"
                                        data-priority="{{ $task->priority }}"
                                        data-deadline="{{ $task->deadline->format('Y-m-d') }}"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-square-pen-icon lucide-square-pen">
                                            <path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                                            <path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/>
                                        </svg>
                                    </button>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                                                <path d="M10 11v6"/>
                                                <path d="M14 11v6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Trash -->
            <div class="tab-pane fade" id="trash">
                <div class="input-group mb-4">
                    <input id="taskInput" type="text" class="form-control" placeholder="Filter task...">
                    <button id="addTaskBtn" class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search-icon lucide-search">
                            <path d="m21 21-4.34-4.34"/>
                            <circle cx="11" cy="11" r="8"/>
                        </svg>
                    </button>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Task Name</th>
                            <th>Priority</th>
                            <th>Deadline</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trashedTasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->name }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->deadline->format('Y-m-d') }}</td>
                                <td>
                                    <form action="{{ route('tasks.restore', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-sm btn-secondary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-rotate-cw-icon lucide-rotate-cw">
                                                <path d="M21 12a9 9 0 1 1-9-9c2.52 0 4.93 1 6.74 2.74L21 8"/>
                                                <path d="M21 3v5h-5"/>
                                            </svg>
                                        </button>
                                    </form>

                                    <form action="{{ route('tasks.forceDelete', $task->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2-icon lucide-trash-2">
                                                <path d="M10 11v6"/>
                                                <path d="M14 11v6"/>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/>
                                                <path d="M3 6h18"/>
                                                <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="editTaskModal" tabindex="-1">
                <div class="modal-dialog">
                    <form method="POST" id="editTaskForm">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">

                                <input type="text" name="name" id="editName" class="form-control mb-2">

                                <select name="priority" id="editPriority" class="form-select mb-2">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>

                                <input type="date" name="deadline" id="editDeadline" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/home.js') }}"></script>
    <script>
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#2563eb',
                allowOutsideClick: false,
                backdrop: true,
                heightAuto: false
            });
        @endif
        @if(session('activeTab'))
            let tabTrigger = document.querySelector(`button[data-bs-target="#{{ session('activeTab') }}"]`);
            let tab = new bootstrap.Tab(tabTrigger);
            tab.show();
        @endif
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>
</html>

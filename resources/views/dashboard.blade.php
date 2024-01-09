@extends('components.layouts.main')

@section('title', 'Dashboard Analytics')

@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-6 col-12">
                <h1>Welcome back {{ auth()->user()->name }}</h1>
            </div>
            <div class="col-lg-6 col-12 text-end">
                <button data-bs-toggle="modal" data-bs-target="#toDoModal" class="btn btn-success btn-sm">Add New To Do
                    list</button>
            </div>
        </div>

        <section>
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Priprity</th>
                        <th>Description</th>
                        <th>Action</th>
                        <th>Created At</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($lists as $list)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img width="50" src="{{ asset($list->image ?? 'placeholder-image.png') }}"
                                    alt=""></td>
                            <td>{{ $list->title }}</td>
                            <td>{{ $list->date }}</td>
                            <td>{{ Str::ucfirst($list->priority) }}</td>
                            <td>{{ $list->description }}</td>
                            <td><button onclick="editItem({{ $list->id }})" class="btn btn-sm btn-info">Edit</button>
                                <button onclick="deleteItem({{ $list->id }})"
                                    class="btn btn-sm btn-danger">Delete</button>
                            </td>
                            <td>{{ date('M jS Y h:s A', strtotime($list->created_at)) }}</td>
                        </tr>
                    @empty
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>

    {{-- Modal for new to do list --}}
    <!-- Modal -->
    <div class="modal fade" id="toDoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add new to do list</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addToDo" action="#" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Title</label>
                                <input type="text" name="title" class="form-control" placeholder="Enter title"
                                    required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Date</label>
                                <input type="text" name="date" id="toDoDate" class="form-control" required />
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Priority</label>
                                <select name="priority" id="" class="form-control" required>
                                    <option value="" selected disabled>Select Priority</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                                @error('priority')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="description" class="form-control" placeholder="Enter Description" required></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-12 form-group mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control"
                                    placeholder="Enter Description"></input>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for new to do list --}}
    <!-- Modal -->
    <div class="modal fade" id="editToDoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Editto do list</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editToDo" action="#" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <input type="hidden" name="id" id="edit_id">
                                <label for="">Title</label>
                                <input type="text" name="title" id="edit_title" class="form-control"
                                    placeholder="Enter title" required>
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Date</label>
                                <input type="text" name="date" id="edit_date" id="toDoDate" class="form-control"
                                    required />
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Priority</label>
                                <select name="priority" id="edit_priority" class="form-control" required>
                                    <option value="" selected disabled>Select Priority</option>
                                    <option value="high">High</option>
                                    <option value="medium">Medium</option>
                                    <option value="low">Low</option>
                                </select>
                                @error('priority')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-6 col-12 form-group mb-3">
                                <label for="">Description</label>
                                <textarea type="text" name="description" id="edit_description" class="form-control"
                                    placeholder="Enter Description" required></textarea>
                                @error('description')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-lg-12 col-12 form-group mb-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control"
                                    placeholder="Enter Description"></input>
                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('.select2').select2();
        });
        $('#toDoDate').flatpickr({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
            minDate: 'today'
        });

        $('#addToDo').submit(function(e) {
            e.preventDefault();
            const data = new FormData(this);
            Notiflix.Loading.standard('Please wait...');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                type: "post",
                url: "{{ route('user.home.store') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    Notiflix.Loading.remove();
                    console.log(response);
                    Notiflix.Notify.success(response.message);
                    $('#addToDo')[0].reset();
                    $('#toDoModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(error) {
                    console.log(error.responseJSON); // Log validation errors if any
                }
            });
        });

        function deleteItem(id) {
            Notiflix.Loading.standard('Deleting...');
            $.ajax({
                url: "{{ route('user.home.delete') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response, status) {
                    Notiflix.Loading.remove();
                    console.log(response);
                    Notiflix.Notify.success(response.message);
                    location.reload();
                },
                error: function(response) {
                    Notiflix.Loading.remove();
                    Notiflix.Notify.failure('Something went wrong!');
                    console.log(response);
                }
            });
        }

        function editItem(id) {
            const modal = $('#editToDoModal')
            Notiflix.Loading.standard('Please wait...');
            $.ajax({
                url: "{{ route('user.home.edit') }}",
                method: "get",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                },
                success: function(response, status) {
                    Notiflix.Loading.remove();
                    $(modal).find('#edit_id').val(response.id);
                    $(modal).find('#edit_title').val(response.title);
                    $(modal).find('#edit_date').val(response.date);
                    $(modal).find('#edit_description').val(response.description);
                    $(modal).find('#edit_priority').val(response.priority).trigger('change');
                    $(modal).modal('show');
                    console.log(response);
                },
                error: function(response) {
                    Notiflix.Loading.remove();
                    Notiflix.Notify.failure('Something went wrong!');
                    console.log(response);
                }
            });
        }
        $('#editToDo').submit(function(e) {
            e.preventDefault();
            const data = new FormData(this);
            Notiflix.Loading.standard('Please wait...');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                }
            });
            $.ajax({
                type: "post",
                url: "{{ route('user.home.update') }}",
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    Notiflix.Loading.remove();
                    console.log(response);
                    Notiflix.Notify.success(response.message);
                    $('#addToDo')[0].reset();
                    $('#toDoModal').modal('hide');
                    setTimeout(() => {
                        location.reload();
                    }, 2000);
                },
                error: function(error) {
                    console.log(error.responseJSON); // Log validation errors if any
                }
            });
        });
    </script>
@endsection

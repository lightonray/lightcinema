@extends('adminlte::page')

@section('title', 'Genres')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Genres</h1>
        <a href="#" class="btn btn-success">Add Genre</a>
    </div>
@stop

@section('content')
<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Genres</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">#</th>
                        <th style="width: 80%">Name</th>
                        <th style="width: 20%">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($genres as $genre)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $genre->name }}</td>
                            <td class="project-actions">
                                <a class="btn btn-info btn-sm" href="{{ route('admin.genres.edit', $genre->id) }}"> <!-- Link to edit action -->
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a class="btn btn-danger btn-sm delete-genre-btn" href="#" data-genre-id="{{ $genre->id }}"> <!-- Link to delete action -->
                                    <i class="fas fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- Delete Genre Modal -->
<div class="modal fade" id="deleteGenreModal" tabindex="-1" role="dialog" aria-labelledby="deleteGenreModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGenreModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this genre?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteGenreForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    // Handle delete button click
    $(document).on('click', '.delete-genre-btn', function () {
        var genreId = $(this).data('genre-id');
        $('#deleteGenreForm').attr('action', '/genres/' + genreId); // Assuming your delete route is '/genres/{id}'
        $('#deleteGenreModal').modal('show');
    });

    document.addEventListener('DOMContentLoaded', function () {
    const successMessage = "{{ session('success') }}";
    const errorMessage = "{{ session('error') }}";

    if (successMessage) {
        Swal.fire({
            title: 'Success!',
            text: successMessage,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

        if (errorMessage) {
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
</script>
@endpush

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Movie</h1>
        <a href="" class="btn btn-success">Add Movie</a>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Movies</h3>
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
                            <th style="width: 20%">Title</th>
                            <th style="width: 15%">Genre</th>
                            <th style="width: 15%">Director</th>
                            <th>Release Date</th>
                            <th>Duration</th>
                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                <td>{{ $movie->id }}</td>
                                <td>
                                    <a>{{ $movie->title }}</a><br>
                                    <small>Created: {{ $movie->created_at }}</small>
                                </td>
                                <td>
                                    {{ $movie->categories->implode('name', ', ') }}
                                </td>
                                <td>{{ $movie->director }}</td>
                                <td>{{ $movie->release_date }}</td>
                                <td>{{ $movie->duration }}</td>

                                <td class="project-actions text-right">
                                    {{-- <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a> --}}
                                    <a class="btn btn-info btn-sm" href="{{ route('admin.movies.edit', $movie->id) }}">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm delete-movie-btn" href="#" data-movie-id="{{ $movie->id }}">
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


    <!-- Delete Movie Modal -->
<div class="modal fade" id="deleteMovieModal" tabindex="-1" role="dialog" aria-labelledby="deleteMovieModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteMovieModalLabel">Confirm Delete</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this movie?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <form id="deleteMovieForm" method="POST">
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
    $(document).on('click', '.delete-movie-btn', function () {
        var movieId = $(this).data('movie-id');
        $('#deleteMovieForm').attr('action', '/movies/' + movieId);
        $('#deleteMovieModal').modal('show');
    });
</script>
@endpush

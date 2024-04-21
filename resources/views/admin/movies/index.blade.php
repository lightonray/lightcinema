@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Projects</h1>
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
                                    <a class="btn btn-primary btn-sm" href="#">
                                        <i class="fas fa-folder"></i> View
                                    </a>
                                    <a class="btn btn-info btn-sm" href="#">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                    </a>
                                    <a class="btn btn-danger btn-sm" href="#">
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

@endsection

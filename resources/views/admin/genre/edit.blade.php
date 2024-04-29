@extends('adminlte::page')

@section('title', 'Edit Genre')

@section('content_header')
    <h1>Edit Genre</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Genre</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.genres.update', $genre->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $genre->name }}">
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection

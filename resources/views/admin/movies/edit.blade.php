@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Movie</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" class="form-control" value="{{ $movie->title }}">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" class="form-control" rows="4">{{ $movie->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="release_date">Release Date</label>
                    <input type="date" id="release_date" name="release_date" class="form-control" value="{{ $movie->release_date }}">
                </div>
                <div class="form-group">
                    <label for="duration">Duration</label>
                    <input type="number" id="duration" name="duration" class="form-control" value="{{ $movie->duration }}">
                </div>
                <div class="form-group">
                    <label for="director">Director</label>
                    <input type="text" id="director" name="director" class="form-control" value="{{ $movie->director }}">
                </div>
                <div class="form-group">
                    <label for="categories">Genre</label>
                    <select id="categories" name="categories[]" class="form-control" multiple>
                        @foreach($allCategories as $category)
                            <option value="{{ $category->id }}" {{ $selectedCategories->contains($category->id) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" id="image" name="image" class="form-control-file">
                    <p>Current Image:</p>
                    <img src="{{ asset('images/' . $movie->image) }}" alt="Current Image" style="max-width: 200px;">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

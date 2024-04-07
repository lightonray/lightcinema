
@extends('layouts.userpages')

@section('content')
      <section style="color" class="top-rated">
        <div style="color:white; display:flex; justify-content:center; margin-top: 100px" class="container">
            <div class="upload-movie-container" style="margin-top: 0 auto">
                <h1 class="h2 section-title">
                    Add a movie to our database
                </h1>
                <div class="form-container">
                  <form action="{{ route('movie.store') }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      <label for="title">Title:</label><br>
                      <input type="text" id="title" name="title"><br>
              
                      <label for="description">Description:</label><br>
                      <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
              
                      <label for="release_date">Release Date:</label><br>
                      <input type="date" id="release_date" name="release_date"><br>
              
                      <label for="duration">Duration (minutes):</label><br>
                      <input type="number" id="duration" name="duration" min="1"><br>
              
                      <label for="categories">Categories:</label><br>
                        <select id="categories" name="categories[]" multiple class="form-control categories-dropdown select2">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select><br>


                      <label style="margin-top: 20px;" for="image" class="file-input-label">Choose Image</label>
                      <input type="file" id="image" name="image" class="file-input" accept="image/*">
                      
                      <div class="file-name-container">
                          <span class="file-name-display"></span>
                      </div>

                      <div style="display:flex; justify-content:center;">
                          <button class="btn btn-primary" id="add-movie" type="submit">Add Movie</button>
                      </div>
                  </form>
              </div>
              
            </div>
            </div>
        </div>
      </section>   
@endsection


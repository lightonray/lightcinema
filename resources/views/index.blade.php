@extends('layouts.userpages')

@section('content')
      <!-- 
        - #HERO
      -->

      <section class="hero">
        <div class="container">

          <div class="hero-content">

            <p class="hero-subtitle">LightCinema</p>

            <h1 class="h1 hero-title">
              Largest <strong>Movie</strong>, Database.
            </h1>

            <button class="btn btn-primary">
              <span>Explore our movie database now</span>
            </button>

          </div>

        </div>
      </section>
      <!-- 
        - #TOP RATED
      -->

      <section class="top-rated">
        <div class="container">

          <p class="section-subtitle">Largest Movie Database</p>

          <h2 class="h2 section-title">Our Database Collection</h2>

          <ul class="filter-list">
            @foreach($categories as $category)
              <li>  
                <button class="filter-btn">{{ $category->name }}</button>
                </li>
            @endforeach
          </ul>

          <ul class="movies-list">
            @foreach($movies as $movie)
            <li>
                <div class="movie-card">
                    <a href="{{ route('moviedetails-index', ['id' => $movie->id]) }}">
                        <figure class="card-banner">
                            <img src="{{ asset('images/'.$movie->image) }}" alt="{{ $movie->title }} movie poster">
                        </figure>
                    </a>
        
                    <div class="title-wrapper">
                        <a href="{{ route('moviedetails-index', ['id' => $movie->id]) }}">
                            <h3 class="card-title">{{ $movie->title }}</h3>
                        </a>
        
                        <time datetime="{{ $movie->release_date }}">
                            {{ \Carbon\Carbon::parse($movie->release_date)->format('d F Y') }}
                        </time>
                    </div>
        
                    <div class="card-meta">
                        {{-- <div class="badge badge-outline">{{ $movie->views }}</div> --}}
        
                        <div class="duration">
                            <ion-icon name="time-outline"></ion-icon>
                            <time datetime="PT{{ $movie->duration }}M">{{ $movie->duration }} min</time>
                        </div>
        
                        {{-- <div class="rating">
                            <ion-icon name="star"></ion-icon>
                            <data>{{ $movie->rating }}</data>
                        </div> --}}
                    </div>
                </div>
            </li>
            @endforeach
        </ul>

        </div>
      </section>
@endsection





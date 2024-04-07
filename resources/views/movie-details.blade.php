
@extends('layouts.userpages')

@section('content')

      <!-- 
        - #MOVIE DETAIL
      -->

      <section class="movie-detail">
        <div class="container">

          <figure class="movie-detail-banner">

            <img src="{{ asset('images/'.$movie->image) }}" alt="{{ $movie->title }} ">

            <button class="play-btn">
              <ion-icon name="play-circle-outline"></ion-icon>
            </button>

          </figure>

          <div class="movie-detail-content">

            {{-- <p class="detail-subtitle">New Episodes</p> --}}

            <h1 class="h1 detail-title">
              {{ $movie->title }}
            </h1>

            <div class="meta-wrapper">

              <div class="ganre-wrapper">
                @foreach($movie->categories as $category)
                    <a href="#">{{ $category->name }},</a>
                @endforeach
              </div>

              <div class="date-time">

                <div>
                  <ion-icon name="calendar-outline"></ion-icon>

                  <time datetime="{{ $movie->release_date }}">{{ $movie->release_date }}</time>
                </div>

                <div>
                  <ion-icon name="time-outline"></ion-icon>

                  <time datetime="PT{{ $movie->duration }}M">{{ $movie->duration }} min</time>
                </div>

              </div>

            </div>

            <p class="storyline">
              {{ $movie->description}}
            </p>

            <div class="details-actions">
              <div class="pp-review-form">
                <div class="pp-review-form-stars">
                    @for ($i = 0; $i < 5; $i++)
                        <button class="pp-review-star" value="{{ $i }}" data-star-index="{{ $i }}" type="button">
                            <img src="{{ asset('/images/reviews-icon-gray.svg') }}" alt="" />
                            <img src="{{ asset('/images/reviews-icon-gold.svg') }}" alt="" />
                        </button>
                    @endfor
                </div>
                <div class="pp-review-form-submit">
                    <button class="btn btn-primary" id="submit-rating">Submit Rating</button>
                </div>
            </div>
            </div>

           
              

          </div>

          

        </div>



          
      </section>





      <!-- 
        USER COMMENTS SECTION
      -->

      <section class="tv-series">
        <div class="container">
          <h2 style="color: yellow; padding: 20px">User Comments</h2>
          <div class="comments">
              
             
          </div>
          
          <!-- Comment form -->
          <form id="comment-form">
              @csrf
              <div class="form-group">
                  <textarea style="padding: 10px" class="form-control" id="comment-input" name="content" rows="3" placeholder="Write your comment here"></textarea>
              </div>
              <input type="hidden" name="movie_id" value="{{ $movie->id }}">
              <button type="submit" class="btn btn-primary">Comment</button>
          </form>
      </div>
          
        </div>
      </section>

    </article>
  </main>

@endsection

@push('js')
<script>
  const rateProfileStars = $('.pp-review-star');

// Reviews logic
let selectedReviewRating = null;

$('.pp-review-form-stars').on('mouseover', '.pp-review-star', function(e) {
    const starIndex = $(this).data('star-index');

    handleUserRatingStars(starIndex);
});

function handleUserRatingStars(index) {
    rateProfileStars.removeClass('active');
    for (let i = 0; i <= index; i++) {
        rateProfileStars.eq(i).addClass('active');
    }
}

$('.pp-review-form-stars').on('mouseleave', function(e) {
    if (selectedReviewRating == null) {
        rateProfileStars.removeClass('active');
    } else {
        handleUserRatingStars(selectedReviewRating);
    }
});

$('.pp-review-form-stars').on('click', '.pp-review-star', function(e) {
    const starIndex = $(this).data('star-index');
    selectedReviewRating = starIndex;
});

$('#submit-rating').on('click', function() {
    var movieId = "{{ $movie->id }}"; 

    if (selectedReviewRating == null) {
        console.error('No rating selected');
        return;
    }

    
    fetch('/movie/' + movieId + '/rate', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ rating: selectedReviewRating })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);
        })
        .catch(error => {
            console.error('There was a problem with your fetch operation:', error);
            // Handle errors here (e.g., display error message to user)
        });
});

</script>
@endpush




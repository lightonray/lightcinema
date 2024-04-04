<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CineMetrics - Best movie collections</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  @vite(['resources/css/app.css'])

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <a href="/" class="logo">
        <h1 style="color: yellow">LightCinema</h1>
      </a>

      <div class="header-actions">

        <button class="search-btn">
          <ion-icon name="search-outline"></ion-icon>
        </button>

        <div class="lang-wrapper">
          <label for="language">
            <ion-icon name="globe-outline"></ion-icon>
          </label>

          <select name="language" id="language">
            <option value="en">EN</option>
            <option value="au">AU</option>
            <option value="ar">AR</option>
            <option value="tu">TU</option>
          </select>
        </div>

        @if (Auth::check())
          <ul class="navbar-list">
            <a href="#"><button class="btn btn-primary">Add a movie</button></a>
          </ul>
          <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-primary">Sign out</button>
          </form>
        @else
            <a href="{{ route('login') }}"><button class="btn btn-primary">Sign in</button></a>
        @endif

      </div>

      <button class="menu-open-btn" data-menu-open-btn>
        <ion-icon name="reorder-two"></ion-icon>
      </button>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">

          <a href="./index.html" class="logo">
            <h1>LightCinema</h1>
          </a>

          <button class="menu-close-btn" data-menu-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>

        </div>

        {{-- <ul class="navbar-list">

          <li>
            <a href="./index.html" class="navbar-link">Home</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Movie</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Tv Show</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Web Series</a>
          </li>

          <li>
            <a href="#" class="navbar-link">Pricing</a>
          </li>

        </ul> --}}

        <ul class="navbar-social-list">

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-twitter"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-facebook"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-pinterest"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-instagram"></ion-icon>
            </a>
          </li>

          <li>
            <a href="#" class="navbar-social-link">
              <ion-icon name="logo-youtube"></ion-icon>
            </a>
          </li>

        </ul>

      </nav>

    </div>
  </header>





  <main>
    <article>
      <section style="color" class="top-rated">
        <div style="color:white; display:flex; justify-content:center; margin-top: 100px" class="container">
            <div class="upload-movie-container" style="margin-top: 0 auto">
                <h1 class="h2 section-title">
                    Add a movie to our database
                </h1>
                <div class="form-container">
                  <form action="#" method="POST">
                      @csrf
                      <label for="title">Title:</label><br>
                      <input type="text" id="title" name="title"><br>
              
                      <label for="description">Description:</label><br>
                      <textarea id="description" name="description" rows="4" cols="50"></textarea><br>
              
                      <label for="release_date">Release Date:</label><br>
                      <input type="date" id="release_date" name="release_date"><br>
              
                      <label for="duration">Duration (minutes):</label><br>
                      <input type="number" id="duration" name="duration" min="1"><br>
              
                      <label for="image" class="file-input-label">Choose Image</label>
                      <input type="file" id="image" name="image" class="file-input" accept="image/*">
              
                      <div style="display:flex; justify-content:center;">
                          <button class="btn btn-primary" id="add-movie" type="submit">Add Movie</button>
                      </div>
                  </form>
              </div>
              
            </div>
            </div>
        </div>
      </section>   
    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top">
      <div class="container">

        <div class="footer-brand-wrapper">

          <a href="./index.html" class="logo">
            <h1 style="color: yellow">LightCinema</h1>
          </a>

          <ul class="footer-list">

            <li>
              <a href="./index.html" class="footer-link">Home</a>
            </li>

            <li>
              <a href="#" class="footer-link">Movie</a>
            </li>

            <li>
              <a href="#" class="footer-link">TV Show</a>
            </li>

            <li>
              <a href="#" class="footer-link">Web Series</a>
            </li>

            <li>
              <a href="#" class="footer-link">Pricing</a>
            </li>

          </ul>

        </div>

        <div class="divider"></div>

        <div class="quicklink-wrapper">

          <ul class="quicklink-list">

            <li>
              <a href="#" class="quicklink-link">Faq</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Help center</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Terms of use</a>
            </li>

            <li>
              <a href="#" class="quicklink-link">Privacy</a>
            </li>

          </ul>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-pinterest"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </div>
    </div>


  </footer>





  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top" data-go-top>
    <ion-icon name="chevron-up"></ion-icon>
  </a>





  <!-- 
    - custom js link
  -->
  @vite(['resources/js/app.js'])

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
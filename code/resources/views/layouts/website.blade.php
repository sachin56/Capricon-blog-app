<!DOCTYPE html>
<html lang="en">
  <head>

    <title>Heshan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,700|Playfair+Display:400,700,900" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('website') }}/fonts/icomoon/style.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('website') }}/fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="{{ asset('website') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('website') }}/css/style.css">
    <style>
      .pagination {
        margin-bottom: 0 !important;
      }
    </style>
  </head>
  <body>
  
  <div class="site-wrap">
    <div class="site-mobile-menu">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    <header class="site-navbar" role="banner">
      <div class="container-fluid">
        <div class="row align-items-center">
          
          <div class="col-12 search-form-wrap js-search-form">
            <form method="get" action="#">
              <input type="text" id="s" class="form-control" placeholder="Search...">
              <button class="search-btn" type="submit"><span class="icon-search"></span></button>
            </form>
          </div>

          <div class="col-4 site-logo">
            <a href="index.html" class="text-black h2 mb-0">Heshan Blog</a>
          </div>

          <nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
            <div class="container">
              <a class="navbar-brand" href="/"><strong>Heshan Blog</strong></a>
              <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
              </button>
              <div class="navbar-collapse collapse" id="navbarColor02" style="">
                <ul class="navbar-nav mr-auto d-flex align-items-center">
                        @foreach($categories as $category)
                            <li><a class="nav-link" href="{{ route('website.category', ['slug' => $category->slug]) }}">{{ $category->category_name }}</a></li>
                        @endforeach
                </ul>
                <ul class="navbar-nav ml-auto d-flex align-items-center">
                  <li class="nav-item highlight">
                  <a class="nav-link" href="https://priceless-turing-4be7d7.netlify.app/">Get my Details</a>
                  </li>
                </ul>
              </div>
            </div>
            </nav>

      </div>
    </header>
    
    @yield('content')
    
    <div class="container mt-5">
      <footer class="bg-white border-top p-3 text-muted small">
      <div class="row align-items-center justify-content-between">
        <div>
                <span class="navbar-brand mr-2"><strong>Heshan</strong></span> Copyright &copy;
          <script>document.write(new Date().getFullYear())</script>
           . All rights reserved.
        </div>
        <div>
          Develope By  <a target="_blank" class="text-secondary font-weight-bold" href="https://www.linkedin.com/in/sachin-heshan/">Heshan</a>
        </div>
      </div>
      </footer>
    </div>
  </div>

  <script src="{{ asset('website') }}/js/jquery-3.3.1.min.js"></script>
  <script src="{{ asset('website') }}/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="{{ asset('website') }}/js/jquery-ui.js"></script>
  <script src="{{ asset('website') }}/js/popper.min.js"></script>
  <script src="{{ asset('website') }}/js/bootstrap.min.js"></script>
  <script src="{{ asset('website') }}/js/owl.carousel.min.js"></script>
  <script src="{{ asset('website') }}/js/jquery.stellar.min.js"></script>
  <script src="{{ asset('website') }}/js/jquery.countdown.min.js"></script>
  <script src="{{ asset('website') }}/js/jquery.magnific-popup.min.js"></script>
  <script src="{{ asset('website') }}/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('website') }}/js/aos.js"></script>

  <script src="{{ asset('website') }}/js/main.js"></script>
  @yield('script')
  </body>
</html>
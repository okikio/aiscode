<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('front/images/favicon-32x32.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('front/images/favicon-16x16.png') }}" />
  <title>IWin Gaming | @yield('page_title')</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/bootstrap.min.css') }}" media="all" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/owl.carousel.min.css') }}" media="all" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/header.css') }}" media="all" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/footer.css') }}" media="all" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/sidebar.css') }}" media="all" />
  <link rel="stylesheet" type="text/css" href="{{ asset('front/css/style.css') }}" media="all" />
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('front/toastr/toastr.min.css') }}">
  @stack('css')
</head>
<body>
  <div id="preloader" class="preloader" style="display:none;">
    <div id="loader"></div>
  </div>
  <!-- header  -->
  <header id="header">
    @include('front.partials.header')
  </header>
  <div class="content">
    <div class="container-fluid">
      <div class="main-content">
        <div id="sidebar-left">
          @include('front.partials.sidebar')
        </div>
        <div class="middle-content py-3 px-md-4 px-3">
          @yield('content')
        </div>
      </div>
    </div>
  </div>
  
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="movieTick" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="movieTickLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-0 p-0">
        <h1 class="modal-title fs-5" id="movieTickLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <h4>Coming Soon</h4>
      </div>
      
    </div>
  </div>
</div>
  <!-- footer -->
  <footer id="footer" class="primary-bg overflow-hidden">
  @include('front.partials.footer')
  </footer>
  <script src="{{ asset('front/js/jquery.min.js') }}"></script>
  <script src="{{ asset('front/js/bundle.min.js') }}"></script>
  <script src="{{ asset('front/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('front/js/slider.js') }}"></script>
  <script src="{{ asset('front/toastr/toastr.min.js') }}"></script>
  @stack('scripts')
  @stack('customJs')
</body>
</html>
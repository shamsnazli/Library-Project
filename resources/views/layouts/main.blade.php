<!--
Author: W3layouts
Author URL: http://w3layouts.com
-->
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Studious - Education Category Responsive Website Template - Home : W3Layouts</title>
    <!-- google-fonts -->
    <link href="//fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <!-- //google-fonts -->
    <!-- Template CSS Style link -->
    <!-- <link rel="stylesheet" href="assets/css/style-starter.css"> -->
    @include('includes.AppStyle')
  </head>
  <body>
<!-- header -->
<header id="site-header" class="fixed-top">
	<div class="container">
	<!--/nav-->
	<nav class="navbar navbar-expand-lg stroke">
			<a class="navbar-brand d-flex align-items-center" href="{{URL('/home')}}">
          <img src="{{asset('images/logo.png')}}" alt="" class="mr-1" /></a>

			<button class="navbar-toggler  collapsed bg-gradient" type="button" data-toggle="collapse"
          data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false"
          aria-label="Toggle navigation">
         <span class="navbar-toggler-icon fa icon-expand fa-bars"></span>
         <span class="navbar-toggler-icon fa icon-close fa-times"></span>
      </button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<nav class="mx-auto">
					<div class="search-bar">
						<form class="search" method="get" action="{{URL('/search')}}">
							<input type="search" class="search__input" name="search" placeholder="Enter Keyword"
								onload="equalWidth()" required>
							<span class="fa fa-search search__icon"></span>
						</form>
					</div>
				</nav>
				<ul class="navbar-nav">
					<li class="nav-item active">
						<a class="nav-link" href="{{ URL('/books')}}">Books</a>
					</li>
          <li class="nav-item active">
          @foreach ($authors as $author)
            <a class="nav-link" href="{{URL('/book/author/'.$author->id)}}">Authors</a>
          @endforeach
						
					</li>
          <li class="nav-item active">
          @foreach ($publishers as $publisher)
						<a class="nav-link" href="{{ URL('/book/publisher/'.$publisher->id) }}">Publishers</a>
          @endforeach
					</li>
					<li class="nav-item active">
          @foreach ($categories as $category)
						<a class="nav-link" href="{{ URL('/book/category/'.$category->id) }}">Categories</a>
          @endforeach
					</li>
          
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
            @else
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                      <li class="nav-item active">
                        <a class="nav-link" href="{{ URL('/admin/book')}}">Admin</a>
                      </li>
                    </ul>
                </li>
            @endif
        </ul>
				</ul>
			</div>
			<!-- toggle switch for light and dark theme -->
			<div class="mobile-position">
				<nav class="navigation">
					<div class="theme-switch-wrapper">
						<label class="theme-switch" for="checkbox">
							<input type="checkbox" id="checkbox">
							<div class="mode-container">
								<i class="gg-sun"></i>
								<i class="gg-moon"></i>
							</div>
						</label>
					</div>
				</nav>
			</div>
			<!-- //toggle switch for light and dark theme -->
		</div>
	</nav>
	<!-- //nav -->
</header>
<!-- //header -->

        @yield('MainContent')


<!-- footer-28 block -->
<section class="app-footer">
    <footer class="footer-28 py-5">
      <div class="footer-bg-layer">
        <div class="container py-lg-3">
          <div class="row footer-top-28">
            <div class="col-lg-4 footer-list-28 copy-right mb-lg-0 mb-sm-5 mt-sm-0 mt-4">
              <a class="navbar-brand mb-3" href="index.html">
                <span class="fa fa-newspaper-o"></span> Studious</a>
              <p class="copy-footer-28"> © 2021. All Rights Reserved. </p>
              <h5 class="mt-2">Done by <a href="/">Shams El nazli</a></h5>
            </div>
            <div class="col-lg-8 row">
              <div class="col-sm-4 col-6 footer-list-28">
                <h6 class="footer-title-28">Useful links</h6>
                <ul>
                  <li><a href="#categories">categories</a></li>
                  <li><a href="#advertise">Advertise</a></li>
                  <li><a href="#authors">Authors</a></li>
                </ul>
              </div>
              <div class="col-sm-4 col-6 footer-list-28 mt-sm-0 mt-4">
                <h6 class="footer-title-28">Social Media</h6>
                <ul class="social-icons">
                  <li class="facebook">
                    <a href="#facebook"><span class="fa fa-facebook"></span> Facebook</a></li>
                  <li class="twitter"> <a href="#twitter"><span class="fa fa-twitter"></span> Twitter</a></li>
                  <li class="linkedin"> <a href="#linkedin"><span class="fa fa-linkedin"></span> Linkedin</a></li>
                </ul>

              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </footer>

    <!-- move top -->
    <button onclick="topFunction()" id="movetop" title="Go to top">
      <span class="fa fa-angle-up"></span>
    </button>
  @include('includes.AppJS')
  </body>

</html>
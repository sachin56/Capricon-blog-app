<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<link rel="apple-touch-icon" sizes="76x76" href="./assets/img/favicon.ico">
<link rel="icon" type="image/png" href="./assets/img/favicon.ico">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Heshan Blog</title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Source+Sans+Pro:400,600,700" rel="stylesheet">
<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- Main CSS -->
<link href="./assets/css/main.css" rel="stylesheet"/>
</head>
<body>
<!--------------------------------------
NAVBAR
--------------------------------------->
<nav class="topnav navbar navbar-expand-lg navbar-light bg-white fixed-top">
<div class="container">
	<a class="navbar-brand" href="./index.html"><strong>Heshan</strong></a>
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
<!-- End Navbar -->
    
    
<!--------------------------------------
HEADER
--------------------------------------->
<div class="container">
	<div class="jumbotron jumbotron-fluid mb-3 pt-0 pb-0 bg-lightblue position-relative">
		<div class="pl-4 pr-0 h-100 tofront">
			<div class="row justify-content-between">
				<div class="col-md-6 pt-6 pb-6 align-self-center">
					<h1 class="secondfont mb-3 font-weight-bold">Sell Your Home Faster — Improve Curb Appeal with These Pro Painting Tips</h1>
					<p class="mb-3">
						If you’re thinking of listing your home, a new coat of paint can do wonders to improve its curb appeal. There are many ways painting can freshen up the interior and exterior of your home to make it more appealing to potential buyers.
					</p>
					<a href="http://localhost:8081/post//big-mac-tacos-smash-tacos" class="btn btn-dark">Read More</a>
				</div>
				<div class="col-md-6 d-none d-md-block pr-0" style="background-size:cover;background-image:url(./assets/img/demo/home.jpg);">	</div>
			</div>
		</div>
	</div>
</div>
<!-- End Header -->
    
    
<!--------------------------------------
MAIN
--------------------------------------->
    
<div class="container pt-4 pb-4">
	<div class="row">
		<div class="col-lg-6">
			<div class="card border-0 mb-4 box-shadow h-xl-300">  
                @foreach($firstPosts2 as $post)            
                    <div style="background-image: url('/storage/post/{{ $post->image }}');background-size: cover;background-repeat: no-repeat;"></div>               
                    <div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
                        <h2 class="h4 font-weight-bold">
                        <a class="text-dark" href="{{ route('website.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="card-text">
                            Researchers have found an effective target in the brain for electrical stimulation to improve mood in people suffering from depression.
                        </p>
                        <div>
                            <small class="d-block"><a class="text-muted" href="">{{ $post->user->name }}</a></small>
                            <small class="text-muted">{{ $post->created_at->format('M d, Y')}}</small>
                        </div>
                    </div>
                @endforeach    
			</div>
		</div>
		<div class="col-lg-6">
			<div class="flex-md-row mb-4 box-shadow h-xl-300">
				<div class="mb-3 d-flex align-items-center">
                    @foreach($middlePost as $post)
                        <img height="80" src="/storage/post/{{ $post->image }}">
                        <div class="pl-3">
                            <h2 class="mb-2 h6 font-weight-bold">
                            <a class="text-dark" href=".{{ route('website.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                            </h2>
                            <div class="card-text text-muted small">
                                {{ $post->user->name }}
                            </div>
                            <small class="text-muted">{{ $post->created_at->format('M d, Y')}}</small>
                        </div>
                    @endforeach
				</div>
				<div class="mb-3 d-flex align-items-center">
                    @foreach($lastPosts as $post)
					<img height="80" src="/storage/post/{{ $post->image }}">
					<div class="pl-3">
						<h2 class="mb-2 h6 font-weight-bold">
						<a class="text-dark" href="{{ route('website.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
						</h2>
						<div class="card-text text-muted small">
                            {{ $post->user->name }}
						</div>
						<small class="text-muted">{{ $post->created_at->format('M d, Y')}}</small>
					</div>
                    @endforeach
				</div>
				<div class="mb-3 d-flex align-items-center">
                    @foreach($lastPosts1 as $post)
					<img height="80" src="/storage/post/{{ $post->image }}">
					<div class="pl-3">
						<h2 class="mb-2 h6 font-weight-bold">
						<a class="text-dark" href="{{ route('website.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
						</h2>
						<div class="card-text text-muted small">
                            {{ $post->user->name }}
						</div>
						<small class="text-muted">{{ $post->created_at->format('M d, Y')}}</small>
					</div>
                    @endforeach
				</div>
			</div>
		</div>
	</div>
</div>
    
<div class="container">
	<div class="row justify-content-between">
		<div class="col-md-8">
			<h5 class="font-weight-bold spanborder"><span>All Stories</span></h5>
            @foreach($recentPosts as $post)
                <div class="mb-3 d-flex justify-content-between">
                    <div class="pr-3">
                        <h2 class="mb-1 h4 font-weight-bold">
                        <a class="text-dark" href="{{ route('website.post', ['slug' => $post->slug]) }}">{{ $post->title }}</a>
                        </h2>
                        <p>
                            {{ $post->title }}
                        </p>
                        <div class="card-text text-muted small">
                            {{ $post->user->name }}
                        </div>
                        <small class="text-muted">D{{ $post->created_at->format('M d, Y')}}</small>
                    </div>
                    <img height="120" src="/storage/post/{{ $post->image }}">
                </div>
            @endforeach
		</div>
		<div class="col-md-4 pl-4">
            <h5 class="font-weight-bold spanborder"><span>Popular</span></h5>
			<ol class="list-featured">
				<li>
				<span>
                    <h6 class="font-weight-bold">
                        <a href="./article.html" class="text-dark">Did Supernovae Kill Off Large Ocean Animals?</a>
                    </h6>
                    <p class="text-muted">
                        Jake Bittle in SCIENCE
                    </p>
				</span>
				</li>
				<li>
				<span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Humans Reversing Climate Clock: 50 Million Years</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
				</li>
				<li>
				<span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Unprecedented Views of the Birth of Planets</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
				</li>
				<li>
				<span>
				<h6 class="font-weight-bold">
				<a href="./article.html" class="text-dark">Effective New Target for Mood-Boosting Brain Stimulation Found</a>
				</h6>
				<p class="text-muted">
					Jake Bittle in SCIENCE
				</p>
				</span>
				</li>
			</ol>
		</div>
	</div>
</div>
    
<!--------------------------------------
FOOTER
--------------------------------------->
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
<!-- End Footer -->
    
<!--------------------------------------
JAVASCRIPTS
--------------------------------------->
<script src="./assets/js/vendor/jquery.min.js" type="text/javascript"></script>
<script src="./assets/js/vendor/popper.min.js" type="text/javascript"></script>
<script src="./assets/js/vendor/bootstrap.min.js" type="text/javascript"></script>
<script src="./assets/js/functions.js" type="text/javascript"></script>
</body>
</html>
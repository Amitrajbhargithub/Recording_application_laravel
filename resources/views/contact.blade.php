<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Recording</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body class="sub_page">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="/">
            <img src="{{asset('images/logo.png')}}" alt="" />
            <span>
              Recording
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item ">
                  <a class="nav-link" href="/">
                    Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{route('about')}}"> About </a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="{{route('contact')}}"> Contact us</a>
                </li>
                @if(!Auth::check())
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('register')}}"> Register </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('login')}}"> Login </a>
                  </li>
                @endif
                @if(Auth::check())
                  <li class="nav-item">
                    <a class="nav-link" href="{{route('user-dashboard')}}"> Dashboard </a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{route('logout')}}"> logout </a>
                  </li>
                @endif
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

  </div>



  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container ">
        <h2 class="">
          Request
          <span>
            A call Back
          </span>

        </h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <form action="{{route('save-feedback')}}" method="post">
            @csrf
            @if(Session::has('success'))
              <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
            <div>
              <input type="text" placeholder="Name" name="name" value="{{old('name')}}"/>
            </div>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            <div>
              <input type="email" placeholder="Email" name="email" value="{{old('email')}}"/>
            </div>
            @error('email')
              <div class="error">{{ $message }}</div>
            @enderror
            <div>
              <input type="text" placeholder="Phone Number" name="phone" value="{{old('phone')}}"/>
            </div>
            @error('phone')
              <div class="error">{{ $message }}</div>
            @enderror
            <div>
              <input type="text" class="message-box" placeholder="Message" name="message" value="{{old('message')}}"/>
            </div>
            @error('message')
              <div class="error">{{ $message }}</div>
            @enderror
            <div class="d-flex  mt-4 ">
              <button>
                SEND
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <!-- map section -->
          <div class="map_section">
            <div id="map" class="w-100 h-100">
              <img src="{{asset('images/about-img.jpg')}}" alt="">
            </div>
          </div>

          <!-- end map section -->
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->


  <!-- info section -->
  <section class="info_section layout_padding">
    <div class="container">
      <div class="info_form">

        <div class="row">
          <div class="offset-lg-3 col-lg-3">
            <h5 class="form_heading">
              Newsletter
            </h5>
          </div>
          <div class="col-md-6">
            @if(Session::has('newsletter'))
              <p class="alert alert-success">{{ Session::get('newsletter') }}</p>
            @endif
            <form action="{{route('news-letter')}}" method="post">
              @csrf
              <input type="hidden" name="route" value="{{'/register'}}">
              <input type="text" placeholder="Enter Your email" name="news_email">
              
              <button>
                subscribe
              </button>
            </form>
            @error('news_email')
                    <div class="error">{{ $message }}</div>
                @enderror
          </div>
        </div>

      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_logo">
            <div>
              <a href="">
                <img src="{{asset('images/logo.png')}}" alt="" />
                <span>
                  Recording
                </span>
              </a>
            </div>
            <p>
              There are many variations of passages of Lorem Ipsum available,
              but the majority have suffered alteration
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_links ">
            <h5>
              Contact Us
            </h5>
            <p class="pr-0 pr-md-4 pr-lg-5">
              Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec
              odio. Quisque volutpat mattis eros
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_insta">
            <h5>
              INFORMATION
            </h5>
            <p class="pr-0 pr-md-4 pr-md-5">
              Donec odio. Quisque volutpat mattis eros.Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec
              odio. Quisque volutpat mattis eros
            </p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="pl-0 pl-lg-5 pl-md-4">
            <h5>
              MY ACCOUNT

            </h5>
            <p>
              <div class="mt-4">
                <!-- Facebook -->
                <a target="_blank" href="https://www.facebook.com/profile.php?id=100051527237126" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-facebook-f" style="font-size:30px;color:red"></i></i></a>
                <!-- Dribbble -->
                <a target="_blank" href="https://www.instagram.com/amitrajbhar06/" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-instagram" style="font-size:30px;color:red"></i></a>
                <!-- linkedin -->
                <a target="_blank" href="https://www.linkedin.com/in/amit-rajbhar-2ba35b226/" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-linkedin" style="font-size:30px;color:red"></i></a>
                <!-- Linkedin -->
               </div>
            </p>

          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end info_section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy;  All Rights Reserved By
      <a href="/">Recording</a>
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <script type="text/javascript" src="{{('js/bootstrap.js')}}"></script>

</body>

</html>
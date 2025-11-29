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
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Recording</title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700|Poppins:400,700|Roboto:400,700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Custom styles for this template -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" />
  <!-- responsive style -->
  <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
  <style>
    #register-image {
        height: 425px;
    }
    @media(max-width:360px) {
        #register-image {
            height: 330px !important;
        }
    }
    @media(max-width:512px) {
        #register-image {
            height: 380px;
        }
    }
    @media(max-width:375px) {
        #register-image {
            height: 345px;
        }
    }
    .error {
        color: #ff5555;
    }
    .profile-image {
      border-radius: 50%;
      height: 49px;
      width: 49px;
    }
    .dashboard-btn{
      color: white;
      font-size: 22px;
    }
    audio {
      width: 100%;
      max-width: 300px;
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
            <img src="{{asset('./images/logo.png')}}" alt="logo" />
            <span> Recording </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav">
                @if(Auth::check())
                <li class="nav-item">
                  <a class="nav-link" href="{{route('user-dashboard')}}"> Dashboard </a>
                </li>
                <li class="nav-item">
                    <div class="d-flex">
                      <img src="@if(!empty(Auth::user()->image)) {{asset('assets/images/profile/'.Auth::user()->image)}}  @else {{asset('images/client.png')}} @endif" class="profile-image" alt="">
                        <div class="dropdown">
                            <button type="button" class="btn dashboard-btn  dropdown-toggle" data-toggle="dropdown">
                              @if(!empty(Auth::user()->name)) {{Auth::user()->name}} @else {{'Alexa'}} @endif
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('user-profile')}}">Profile</a>
                            <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
                            </div>
                        </div>
                    </div>
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

<input type="hidden"id="audio_file">
<input type="hidden"id="blob_name">
  <!-- about section -->
  <section class="about_section my-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="{{asset('images/second.jpg')}}" alt="Recording image">
          </div>
        </div>
        <div class="col-md-5 col-lg-4">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Simple Recordinging
              </h2>
            </div><br>
            <a href="javascript:void(0)" class="btn-send" style="background-color: #ffc107" id="RecordingButton"> start Recordinging</a>
            <a href="javascript:void(0)" class="btn-send" id="fa-trash" style="display:none;"><i class="fa fa-trash" aria-hidden="true"></i></a>
            <a href="javascript:void(0)" class="btn-send custom-audio-send"  style="display:none;">resume</a>
            <a href="javascript:void(0)" type="submit" class="send-audio" id="saveAudio" style="display:none;">Save</a>
        </form><br>
        <div class="msger-audio" style="display:none;" id="audio-box">
            <div id="controls">
                <a href="javascript:void(0)" class="audio-Recording1" ><span id="timer">00:00:00</span></a>
                <a href="javascript:void(0)" style="display:none;" id="stopButton" disabled>Pause</a>
                <a href="javascript:void(0)" class="pauseButton" disabled><i class="fa fa-pause" aria-hidden="true"></i></a>
            </div>
            <div id="formats"></div>
            <ol id="RecordingingsList"></ol>
        </div>
          </div>
        </div>
      </div>
    </div>


  </section>

  <!-- end about section -->

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
              <input type="hidden" name="route" value="{{'/user/dashboard'}}">
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
                <img src="{{('images/logo.png')}}" alt="" />
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
  <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>

  <script type="text/javascript" src="{{ asset('audiojs/record-chat.js') }}"></script>
  <script type="text/javascript" src="{{ asset('audiojs/recorder-chat.js') }}"></script>
  <script type="text/javascript" src="{{ asset('audiojs/audio-player-chat.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
      $('.dropdown-toggle').dropdown();
    });
</script>
</body>
</html>

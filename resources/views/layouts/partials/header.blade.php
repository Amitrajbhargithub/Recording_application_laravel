
<div class="hero_area">
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
                        <ul class="navbar-nav">
                            <li class="nav-item ">
                            <a class="nav-link" href="/">
                                Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="{{route('about')}}"> About </a>
                            </li>

                            <li class="nav-item ">
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
                                    <a class="nav-link" href="{{route('recording-audio')}}"> Recording </a>
                                </li>
                                <li class="nav-item">
                                    <div class="d-flex">
                                        <img src=" @if(!empty(Auth::user()->id)) {{asset('assets/images/profile/'.Auth::user()->image)}}  @else {{asset('images/client.png')}} @endif" class="profile-image" alt="">
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
</div>

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
                    <input type="hidden" name="route" value="{{'/login'}}">
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
                <img src="images/logo.png" alt="" />
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
                <a target="_blanck" href="https://www.facebook.com/profile.php?id=100051527237126" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-facebook-f" style="font-size:30px;color:red"></i></i></a>
                <!-- Dribbble -->
                <a target="_blanck" href="https://www.instagram.com/amitrajbhar06/" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-instagram" style="font-size:30px;color:red"></i></a>
                <!-- linkedin -->
                <a target="_blanck" href="https://www.linkedin.com/in/amit-rajbhar-2ba35b226/" type="button" class="btn btn-floating btn-light btn-lg"><i class="fa fa-linkedin" style="font-size:30px;color:red"></i></a>
                <!-- Linkedin -->
                </div>
            </p>

            </div>
        </div>
        </div>
    </div>
</section>

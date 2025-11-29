@extends('layouts.app')
@section('content')
    <div class="hero_area">
        <section class="slider_section position-relative">
            <div class="container">
                <div id="carouselExampleIndicators">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                    <div class="row">
                        <div class="col-md-6">
                        <div class="detail-box">
                            <h1>
                            A Perfect Recordinging Perpose <br />
                            <span id='elementEl'> For Your Recordinging </span>
                            </h1>
                            <p>
                            It is a long established fact that a reader will be distracted
                            by the readable content of a page when looking at its layout.
                            The point of using Lorem Ipsum is that it has a more-or-less
                            normal distribution of letters, as
                            </p>
                            <div class="btn-box">
                            <a href="{{route('about')}}" class="btn-1">Read More</a>
                            <a href="{{route('contact')}}" class="btn-2">Contact us</a>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </section>
    </div>
    <section class="about_section ">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="images/about-img.jpg" alt="">
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="detail-box">
                        <div class="heading_container">
                        <h2>
                            A Few words about us
                        </h2>
                        </div>
                        <p>
                        It is a long established fact that a reader will be distracted by the readable content of a page when
                        looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                        of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                        desktop publishing packages and web
                        </p>
                        <div>
                        <a href="">
                            Read More
                        </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        'use strict';
        function typeWriter(el) {
            const textArray = el.innerHTML.split('');
            el.innerHTML = '';
            textArray.forEach((letter, i) =>
                setTimeout(() => (el.innerHTML += letter), 95 * i)
            );

            setInterval(() => typeWriter(el), 8000);
        }
        typeWriter(elementEl);
    </script>
@endsection

@extends('layouts.app')
@section('content')
    <section class="contact_section layout_padding">
        <div class="container ">
        <div class="heading_container">
            <h2 class="">
            Regis
            <span>
                tration
            </span>

            </h2>
        </div>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-md-6">
            <form id="form-submit" action="{{route('register')}}" method="post">
                @csrf
                @if(Session::has('success'))
                <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
                <div>
                    <input type="text" placeholder="Name" name="name" autocomplete="off" value="{{old('name')}}"/>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="email" placeholder="Email" name="email" autocomplete="off" value="{{old('email')}}"/>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                <input type="password" placeholder="Password" autocomplete="off" name="password" value="{{old('password')}}"/>
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
                <div>
                    <input type="text" placeholder="Phone Number" autocomplete="off" name="phone" value="{{old('phone')}}"/>
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex  mt-4 ">
                <button type="submit">
                    Save
                </button>
                </div>

            </form>
            </div>
            <div class="col-md-6">
                <!-- image section -->
                <div class="map_section">
                    <div class="w-100 h-100">
                        <img id="register-image" src="{{asset('images/fourth.jpg')}}" alt="">
                    </div>
                </div>
            <!-- end image section -->
            </div>
        </div>
        </div>
    </section>
@endsection

@extends('layouts.app')
@section('content')
  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container ">
      <div class="heading_container ">
        <h2 class="">
          Log
          <span>
            In
          </span>

        </h2>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <form action="{{route('demo-login')}}" method="post">
            @csrf
            @if(Session::has('success'))
              <p class="alert alert-success">{{ Session::get('success') }}</p>
            @endif
            @if(Session::has('status'))
              <p class="alert alert-warning">{{ Session::get('success') }}</p>
            @endif
            <div>
              <input type="email" placeholder="Email" name="email" value="{{old('email')}}"/>
              @if(Session::has('email'))
                <div class="error">{{ Session::get('email') }}</div>
              @endif

              @error('email')
                  <div class="error">{{ $message }}</div>
              @enderror
            </div>

            <div>
                <input type="password" placeholder="Password" name="password"/>
                @if(Session::has('password'))
                  <div class="error">{{ Session::get('password') }}</div>
                @endif

                @error('password')
                  <div class="error">{{ $message }}</div>
                @enderror
              </div>

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
            <div class="w-100 h-100">
                <img id="login-image" src="images/second.jpg" alt="">
            </div>
          </div>

          <!-- end map section -->
        </div>
      </div>
    </div>
  </section>
@endsection

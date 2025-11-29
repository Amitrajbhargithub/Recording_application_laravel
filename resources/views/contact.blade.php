@extends('layouts.app')
@section('content')
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
@endsection

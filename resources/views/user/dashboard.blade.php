@extends('layouts.app')
@include('layouts.partials.head')
@section('content')
    <section class="about_section my-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="img-box">
                        <img src="{{asset('images/second.jpg')}}" alt="Recordinging image"/>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <div class="detail-box">
                        <div class="heading_container">
                        <h2>
                            List of recodings.
                        </h2>
                        <a href="{{route('recording-audio')}}" class="btn btn-secondary">new Recording</a>
                        </div><br>
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Audio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($audio as $value)
                                <tr>
                                    <td scope="row">
                                        <p>{{$value->created_at->format('d M')}}</p>
                                    </td>
                                    <td>
                                        <audio controls>
                                        <source src="{{asset('assets/audio/'.$value->audio)}}" type="audio/ogg">
                                        <source src="{{asset('assets/audio/'.$value->audio)}}" type="audio/mpeg">
                                        </audio>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="2" class="text-center">No data found.</td>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script>
@endsection

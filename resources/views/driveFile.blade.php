@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @foreach($files as $file)
                <div class="card" style="margin-top: 10px">
                    {{$file}}  <a href="{{route('download',['name' => $file])}}">Download</a>
                </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

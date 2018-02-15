@extends('layout')


@section('contents')
    <div class="container">
        <div class="row my-5">
            <div class="col mx-auto">
                {{ Form::open(['method' => 'GET', 'url' => 'search']) }}
                <div class="input-group mb-3">
                    {{ Form::input('検索する', 'query', null, ["class" => "form-control mr-1", "placeholder"=> "キーワード"]) }}
                    {{ Form::submit("検索",["class"=>"btn btn-outline-primary"])}}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        @foreach($images as $image)
            <div class="col-12 col-md-4 col-lg-3 col-sm-6 mb-2">
                <div class="card" style="width: 15rem;">
                    <img  style="height: 200px;object-fit: contain;" class="" src='{{$image["thumbnail"]}}' alt="Card image cap">
                    <div class="card-body">
                       <a href="/images/{{$image["_id"]}}" class="btn btn-primary btn-lg btn-block">画像をSNSで使う</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
@extends('layout')


@section('contents')
    <div class="container">
        <div class="row my-5">
            <div class="col mx-auto">
                <div class="input-group mb-3">
                    <input type="text" class="form-control mr-1" placeholder="キーワード" aria-label="Username" aria-describedby="basic-addon1">
                    <button type="button" class="btn btn-outline-primary">検索</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
        @foreach($images as $image)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src='{{$image["thumbnail"]}}' alt="Card image cap">
                    <div class="card-body">
                       <a href="/images/{{$image["_id"]}}" class="btn btn-primary btn-lg btn-block"">画像をSNSで使う</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
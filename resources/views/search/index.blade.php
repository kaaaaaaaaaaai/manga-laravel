@extends('layout')


@section("ogp")
    <title>{{implode(",", $query)}}|漫画1コマネタ画像検索</title>
    <meta name="keywords" content="漫画,1コマ,twitter,リプ画像,煽り画像,ネタ画像">
    <meta name="description" content="『{{implode(",", $query)}}』の漫画1コマネタ画像一覧">
@endsection

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
        <div class="alert alert-primary" role="alert">
            Tips : 思うような検索結果出ない場合は「ひらがな」や検索ワードを短くすると出る場合があります。
        </div>
    </div>
    <div class="container">
        <div class="row">
            <h5>- 人気タグ -</h5>
        </div>
        <div class="mb-4">
            @foreach($popular_tags as $tag)
                <a href="/search?query={{$tag}}" style="text-decoration: none;">
                    <span class="badge badge-pill badge-secondary mb-1">{{$tag}}</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="container">
        <div class="row">
            <h5>- 新着画像 -</h5>
        </div>
        <!-- Previous Page Link -->
        {{$imagePaginate->appends($params)->links()}}
        <div class="row">
            @foreach($images as $image)
                <div class="col col-md-4 col-lg-3 col-sm-6 mb-2">
                    <div class="card mx-auto">
                        <img  style="height: 200px;object-fit: contain;" class="" src='{{$image["thumbnail"]}}' alt="Card image cap">
                        <div class="card-body">
                            <p class="card-text">
                            @foreach($image["_source"]["tags"] as $tag)
                                <a href="/search?query={{$tag}}" style="text-decoration: none;" class="card-text badge badge-pill badge-secondary mb-1">
                                    {{$tag}}
                                </a>
                            @endforeach
                            </p>
                            <a href="/images/{{$image["_id"]}}" class="btn btn-outline-success btn-lg btn-block">SNSで使う</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{$imagePaginate->appends($params)->links()}}

    </div>
@endsection
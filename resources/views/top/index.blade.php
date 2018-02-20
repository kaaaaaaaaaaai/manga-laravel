@extends('layout')

@section("ogp")
    <title>漫画1コマ検索 Twitterのリプに使えるネタ画像集</title>
    <meta name="keywords" content="漫画,1コマ,twitter,リプ画像,煽り画像,ネタ画像">
    <meta name="description" content="メールやLINE,Twitterの返信に使えるネタ画像">
@endsection
@section("ex_css")
    <style>
        body::before{
            content: '';
            height: 360px;
            width: 100%;
            position: absolute;
            left: 0;
            top: 0;
            background-color: #009688;
            z-index: -1;
        }
        .gdb-icon--big {
            border-radius: 14px;
            overflow: hidden;
        }

        /*.testimonial-group > .row {*/
            /*overflow-x: auto;*/
            /*white-space: nowrap;*/
        /*}*/
        /*.testimonial-group > .row > .flow {*/
            /*display: inline-block;*/
            /*float: none;*/
        /*}*/

        .scrollimage {
            overflow: scroll;
            white-space: nowrap;
            max-width: 100%;
        }
        .scrollimage__image{
             display: inline-block;
             color: white;
             text-align: center;
             text-decoration: none;
        }
        .scrollimage__image--image{
            border-radius: 15px;
            max-width: 180px;
            max-height: 124px;
        }

    </style>
@endsection
@section('contents')
    <div class="container">
        <div class="row mt-5 mb-2">
            <div class="col mx-auto">
                {{ Form::open(['method' => 'GET', 'url' => 'search']) }}
                <div class="input-group mb-3">
                    {{ Form::input('検索する', 'query', null, ["class" => "form-control mr-1", "placeholder"=>"キャラクター,セリフ,作品名で検索可能です"]) }}
                    {{ Form::submit("検索",["class"=>"btn btn-outline-light"])}}
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mb-1">
            <h5 class="text-white">- オススメの画像 -</h5>
        </div>
    </div>

    <div class="mb-5 scrollimage" style="max-width: 100%!important; background-color: #444;">
        {{--<img  style="display: inline-block;float: none;" class="img-fluid gdb-icon--big" src='https://s3-ap-northeast-1.amazonaws.com/manga-one/thumbnails/1412.jpg' alt="Card image cap">--}}
        <div class="flow" style="padding-top: 10px;padding-bottom: 10px;">
            <div class="scrollimage__image ml-1">
                @foreach($carouselItems as $item)
                    <a href="/images/{{$item["_id"]}}">
                        <img class="scrollimage__image--image" src='{{$item["thumbnail"]}}'>
                    </a>
                @endforeach
            </div>
            {{--<img class="col-8 col-sm-3 col-md-3 col-lg-3" src='https://s3-ap-northeast-1.amazonaws.com/manga-one/thumbnails/1412.jpg'>--}}

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
        <div class="row">
        @foreach($images as $key => $image)
            @if(\Agent::isMobile() && ($key == 1 || $key == 6))

                <div class="col-12 col-md-4 col-lg-3 col-sm-6 mb-2">
                    <div class="card">
                        <div class="card-body">
                        <div class="mx-auto mt-3">
                            <script src="//adm.shinobi.jp/s/2a9af09f152b6774dbe09aaeff953a94"></script>
                        </div>
                        </div>
                        {{--<!-- manga-top -->--}}
                        {{--<ins class="adsbygoogle"--}}
                        {{--style="display:block"--}}
                        {{--data-ad-client="ca-pub-1691009953433743"--}}
                        {{--data-ad-slot="1248830620"--}}
                        {{--data-ad-format="auto"></ins>--}}
                        {{--<script>--}}
                        {{--(adsbygoogle = window.adsbygoogle || []).push({});--}}
                        {{--</script>--}}
                    </div>
                </div>
            @endif
            <div class="col-12 col-md-4 col-lg-3 col-sm-6 mb-2">
                <div class="card mx-auto">
                    <img  style="height: 200px;object-fit: contain;" class="" src='{{$image["thumbnail"]}}' alt="Card image cap">
                    <div class="card-body">
                        @foreach($image["_source"]["tags"] as $tag)
                            <a href="/search?query={{$tag}}" style="text-decoration: none;">
                                <span class="badge badge-pill badge-secondary mb-1 text-justify">{{$tag}}</span>
                            </a>
                        @endforeach
                       <a href="/images/{{$image["_id"]}}" class="btn btn-outline-success btn-lg btn-block">画像をSNSで使う</a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endsection
@extends('layout')



@section('ogp')
    <meta property="og:title" content="漫画１コマ検索" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{$image["ogp"]}}" />
    <meta property="og:site_name" content="漫画１コマ検索" />
    <meta property="og:description" content="{{$image["plane_tags"][0] or "漫画１コマ検索"}}" />

    <!-- ※ Twitter共通設定 -->
    <meta name="twitter:card" content="photo" />
@endsection

@section('contents')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src='{{$image["thumbnail"]}}' alt="Card image cap">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="alert alert-secondary" role="alert">
                    コピーURL => {{url()->current()}}
                </div>
            </div>
        </div>
    </div>
@endsection
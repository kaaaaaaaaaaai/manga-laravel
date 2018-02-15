@extends('layout')



@section('ogp')
    <meta property="og:title" content="漫画1コマ検索" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:image" content="{{$image["ogp"]}}" />
    <meta property="og:site_name" content="漫画1コマ検索" />
    <meta property="og:description" content="{{$image["plane_tags"][0] or "漫画１コマ検索"}}" />

    <!-- ※ Twitter共通設定 -->
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('contents')
    <div class="container">
        <div class="row my-5">
            <div class="col">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src='{{$image["thumbnail"]}}' alt="Card image cap">
                </div>
            </div>
            <div>
                @foreach($image["tags"] as $tag)
                    <span class="badge badge-pill badge-secondary">{{$tag}}</span>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8">
                <div class="alert alert-secondary" role="alert">
                    <p class="h6">
                        <a href="#" class="badge badge-secondary">link</a>
                        {{url()->current()}}
                        <button type="button" class="btn btn-sm btn-outline-success ml-1">COPY</button>
                    </p>
                    <p>このURLをツイートすることでTwitter上で画像が綺麗に表示されます。</p>
                </div>
            </div>
            <div class="col col-md-4">
                <figure class="figure">
                    <img src="https://s3-ap-northeast-1.amazonaws.com/manga-one/public/publish_image.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    <figcaption class="figure-caption text-right">画像はサンプルです。</figcaption>
                </figure>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
@endsection
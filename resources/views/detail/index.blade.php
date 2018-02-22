@extends('layout')


@section('ogp')
    <title>{{implode(",",$image["tags"])}}|漫画1コマネタ検索</title>
    <meta name="keywords" content="{{implode(",",$image["tags"])}}">
    <meta name="description" content="{{implode(",",$image["tags"])}}の返信に使えるネタ画像">

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
        <div class="row my-5 mb-2">
            <div class="col">
                <div class="card mx-auto" style="width: 18rem;">
                    <img class="card-img-top" src='{{$image["thumbnail"]}}' alt="Card image cap">
                </div>
            </div>
            <div class="mt-2 mx-auto">
                {{--<script src="//adm.shinobi.jp/s/6159e8d3ec8979f1dae24d2d6df34670"></script>--}}

                <!-- detail -->
                <ins class="adsbygoogle"
                     style="display:inline-block;width:728px;height:90px"
                     data-ad-client="ca-pub-1691009953433743"
                     data-ad-slot="3767484076"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
            <div>
                @foreach($image["tags"] as $tag)
                    <a href="/search?query={{$tag}}" style="text-decoration: none;">
                        <span class="badge badge-pill badge-secondary mb-1">{{$tag}}</span>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-8">
                <div class="alert alert-secondary" role="alert">
                    <p class="h6">
                        <a href="#" class="badge badge-secondary">link</a>
                    <div class="input-group mb-3">
                        {{ Form::input('検索する', 'url', url()->current(), ["class" => "form-control", "placeholder"=> "キーワード", "readonly"]) }}
                    </div>
                        <button data-placement="top" title="コピーしました" type="button" data-clipboard-text="{{url()->current()}}" class="btn-block btn btn-sm btn-outline-success js-copy-button">URL簡単COPY</button>
                    </p>
                    <p>このURLをツイートすることでTwitter上で画像が綺麗に表示されます。</p>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <figure class="figure">
                    <img src="https://s3-ap-northeast-1.amazonaws.com/manga-one/public/publish_image.png" class="figure-img img-fluid rounded" alt="A generic square placeholder image with rounded corners in a figure.">
                    <figcaption class="figure-caption text-right">画像はサンプルです。</figcaption>
                </figure>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script>
        var clipboard = new Clipboard('.js-copy-button');
        clipboard.on('success', function(e) {
            console.info('Trigger:', e.trigger);
            $(e.trigger).tooltip('show')
        });
        clipboard.on('error', function(e) {
            console.error('Trigger:', e.trigger);
        });
    </script>
@endsection
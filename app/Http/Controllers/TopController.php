<?php
namespace App\Http\Controllers;
/**
 * Created by PhpStorm.
 * User: kai
 * Date: 2018/02/12
 * Time: 23:54
 */
use App\Http\Controllers\Controller;
use Elasticsearch\ClientBuilder;

/**
 * Class TopController
 * @package App\Http\Controllers
 */
class TopController extends Controller{

    public function __construct()
    {
        $this->ESClient = ClientBuilder::create()->setHosts([
            "http://search-manga-image-sdozidc55hog2xc6ryonyshlja.ap-northeast-1.es.amazonaws.com:80"
        ])->build();
    }

    public function index(){

        $re = $this->getRandomImages();
        /** @var TYPE_NAME $images */
        $images = $re["hits"]["hits"];
        foreach ($images as &$image){
            $image["thumbnail"] = env("S3")."/thumbnails/".$image["_id"].".".$image["_source"]["extension"];
        }

        $carousel = $this->getCarouselImages();
        /** @var TYPE_NAME $images */
        $carouselImages = $carousel["hits"]["hits"];
        foreach ($carouselImages as &$image){
            $image["thumbnail"] = env("S3")."/thumbnails/".$image["_id"].".".$image["_source"]["extension"];
        }


        $popular_tags = $this->popular_tags();
        return view("top.index", [
            "images" => $images,
            "popular_tags" => $popular_tags,
            "carouselItems" => $carouselImages
        ]);
    }

    private function getCarouselImages(){
        $params = [
            "index" => "prod",
            "type"  => "image",
            "size" => 12,
            "body" => [
                "query" => [
                    "terms" => [
                        "_id" => ["3515","105", "1247" ,"4", "1492", "100", "2498", "2410", "332","701", "705", "240"]
                    ]
                ]
            ]
        ];
        return $this->ESClient->search($params);
    }

    private  function getRandomImages(){
        list($usec, $sec) = explode(" ", microtime());
        $seed =  ((float)$usec + (float)$sec);
        $params = [
            "index" => "prod",
            "type"  => "image",
            "size" => 12,
            "body" => [
                "query" => [
                    "function_score" => [
                        "random_score" => [
                            "seed" => (int)$seed
                        ]
                    ]
                ]
            ]
        ];
        return $this->ESClient->search($params);
    }
    /**
     * @return array
     */
    private function popular_tags(){
        $tags = [
            "ヒナまつり",
            "ニセコイ",
            "なもり",
            "ゆるゆり",
            "のんのんびより",
            "うすた京介",
            "ナルト",
            "アホガール",
            "ディーふらぐ",
            "範馬刃牙",
            "名探偵コナン",
            "恋愛ラボ",
            "はじめの一歩",
            "ばらかもん",
            "咲-Saki-",
            "BLEACH",
            "ピューと吹く!ジャガー",
        ];

        return $tags;
    }

}
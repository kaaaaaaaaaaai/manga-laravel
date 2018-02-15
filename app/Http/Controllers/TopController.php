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
        $re = $this->ESClient->search($params);

        /** @var TYPE_NAME $images */
        $images = $re["hits"]["hits"];
        foreach ($images as &$image){
            $image["thumbnail"] = env("S3")."/thumbnails/".$image["_id"].".".$image["_source"]["extension"];
        }
        return view("top.index", [
            "images" => $images
        ]);
    }

}
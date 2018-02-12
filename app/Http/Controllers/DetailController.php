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
use Illuminate\Http\Request;

/**
 * Class TopController
 * @package App\Http\Controllers
 */
class DetailController extends Controller{

    public function __construct()
    {
        $this->ESClient = ClientBuilder::create()->setHosts([
            "http://search-manga-image-sdozidc55hog2xc6ryonyshlja.ap-northeast-1.es.amazonaws.com:80"
        ])->build();
    }

    public function index(Request $request, $id){
        $params = [
            "index" => "prod",
            "type"  => "image",
            "id" => $id
        ];
        $image = $this->ESClient->getSource($params);
        $image["thumbnail"] = env("S3")."/thumbnails/".$id.".".$image["extension"];
        $image["ogp"] = env("S3")."/ogp/".$id.".".$image["extension"];

        return view("detail.index", [
            "image" => $image
        ]);
    }
}
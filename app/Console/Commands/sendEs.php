<?php

namespace App\Console\Commands;

use App\Models\Image;
use Elasticsearch\ClientBuilder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class sendEs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ES:sendDocument';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $ESClient;
    private $ImageModel;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Image $image)
    {
        $this->ImageModel = $image;

        $this->ESClient = ClientBuilder::create()->setHosts([
            "http://search-manga-image-sdozidc55hog2xc6ryonyshlja.ap-northeast-1.es.amazonaws.com:80"
        ])->build();
        parent::__construct();

    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $images = $this->ImageModel->get();

        foreach ($images as $im){
            $body = [
                "extension" => $im->extension,
                "tags"      => $im->tags,
                "plane_tags"=> $im->plane_tags
            ];

            $params = [
                'index' => env("ES_ENV"),
                'type' => 'image',
                'id' => $im->id,
                'body' => $body
            ];

            $response = $this->ESClient->index($params);

            Log::info($response);
        }
    }
}

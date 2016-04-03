<?php

use Chadicus\Marvel\Api\Client;
use Chadicus\Marvel\Api\Entities\Comic;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(["as" => "comics", "prefix" => "/api/comics"], function () {
    Route::get("/", function () {
        /* API INITIATION */
        $publicApiKey = env('MARVEL_PUBLIC_KEY');
        $privateApiKey = env('MARVEL_PRIVATE_KEY');
        $client = new Client($privateApiKey, $publicApiKey);
        /**/

        $comics = Comic::findAll($client, ['dateDescriptor' => 'thisMonth',"orderBy"=>"-onsaleDate"]);
        $results = [];
        foreach ($comics as $comic) {
            $result = [];
            $result["issueNumber"] = $comic->getIssueNumber();
            $result["variantDescription"] = $comic->getVariantDescription();
            $result["description"] = $comic->getDescription();
            $result["path"] = $comic->getThumbnail()->getPath();
            $result["extension"] = $comic->getThumbnail()->getExtension();
            $result["name"] = $comic->getSeries()->getName();
            $results[] = $result;
        }
        return response()->json($results);
    });


});


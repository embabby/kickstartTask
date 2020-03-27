<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    

    public function index(){

     return view('welcome');
    }


    public function feedFilter(Request $request){
		
		$arr=[];
		foreach ($request->feed as $oneFeed) {
			$string  = explode('message: ', $oneFeed['content']['$t'])[1];
		
			$message = explode(', sentiment: ', $string)[0];
			$sentiment = explode(', sentiment: ', $string)[1];
			$icon = asset('images/'.$sentiment.'.png');
			$date  = $oneFeed['title']['$t'];

			$arr[]  = ['message' => $message, 'sentiment'=>$sentiment, 'icon'=>$icon, 'date'=>$date];
			
		}
			// return $arr;

			return response()->json(['success'=> true, 'filteredFeeds' => $arr]);

    }




}

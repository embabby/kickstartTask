<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    

    public function index(){

     return view('welcome');
    }




    public function filter($res){

            $string = $res;

		list($a, $b) = explode(', sentiment: ', $string);

		  $sentiment = $b; // "5"

		$pieces = explode(' ', $a);
		 $city = array_pop($pieces);

		 $icon = asset('images/'.$sentiment.'.png');

		return [$sentiment, $city, $icon];


    }




}

<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use App\Tweet;
use Illuminate\Http\Request;

class PageController extends Controller
{

	public $settings = [
		'oauth_access_token' => "968307292528660481-7BNDbH22lWesT5saGR5mF7LyHZaH6ng",
		'oauth_access_token_secret' => "asVRvUAjdIHp3DK9eZ9nIiE9coXX42aTekbnkNLA2j5d0",
		'consumer_key' => "tEPmGvg4qj61NM0ZRrPCyb0w8",
		'consumer_secret' => "gICNMdlSazMwr3boUPJANJ9jF8X3wJorefPzC2FihfsXci2Pkr",
	];


	public function index()
	{
		return view('welcome');
	}


	public function find_tweets(Request $request)
	{
		$connection = new TwitterOAuth(
			$this->settings['consumer_key'],
			$this->settings['consumer_secret'],
			$this->settings['oauth_access_token'],
			$this->settings['oauth_access_token_secret']
		);

		$tweets = $connection->get("search/tweets",
			[
				'q' => $request->get('query'),
				'tweet_mode' => 'extended',
			]);

		return response()->json($tweets);
	}

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseDetectorController extends Controller
{
	static function index($request, $data, $view_name = null){

	    if($request->is('api/*')){
	    	// It's an API
	        return response()->json($data);

	    } else {
	    	// It's a web interface
	        return $view_name ? view($view_name)->with('data', $data) : dd($data);
	    }
	}
}

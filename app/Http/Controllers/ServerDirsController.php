<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServerDirsController extends Controller
{

	const DIR_PATH_LINUX   = '/opt/myprogram/';
	const DIR_PATH_WINDOWS = 'C:\xampp\htdocs\\parspack\\storage\\myprogram\\';

	// const DIR_PATH = [ 	'LINUX' =>  '/opt/myprogram/',
	// 					'WINDOWS' => 'C:\xampp\htdocs\\parspack\\storage\\myprogram\\'];

	private $os;

    public function __construct(Request $request)
    {
    	// To know the request has came from either api or web route files 
        $request->is('api/*') ? $this->middleware('auth:api') : $this->middleware('auth');

        // To get the OS
        $this->os = getOS();
    }

    public function get_dir_name(){
    	return view('server.get-dir-name');
    }

    protected function create_dir(Request $request){

        // Validate given dir-name
        $validator = Validator::make($request->all(), [
            'dir_name' => ['required', 'string', 'min:1', 'max:128'],
        ]);

        if ($validator->fails()) {
            return response()->json([['error' =>  $validator->errors()->first()], 401]);
        }

        $path = constant("self::DIR_PATH_" . strtoupper($this->os)) . $request->dir_name;
        $permission = 0700;

        if (!is_dir($path)) {

			if (!mkdir($path, $permission, true)) {
				// Something went wrong
	    		return ResponseDetectorController::index($request, ['msg' => 'Failed to create directory "' . $request->dir_name . '"']);
			}
		} else {
			return ResponseDetectorController::index($request, ['msg' => 'Directory already exists']);
		}

		// The dir created successfully
		return ResponseDetectorController::index($request, ['msg' => 'The directory just created successfully named "' . $request->dir_name . '"']);
    	
    }
}

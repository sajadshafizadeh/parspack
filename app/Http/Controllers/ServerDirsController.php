<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServerDirsController extends Controller
{

	const DIR_PATH_LINUX   = '/opt/myprogram/';
	const DIR_PATH_WINDOWS = 'C:\xampp\htdocs\\parspack\\storage\\myprogram\\';
	
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

        // The directory is not exists
        if (!is_dir($path)) {

        	// Create the directory on the specified path
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

    public function get_file_name(){
    	return view('server.get-file-name');
    }

    protected function create_file(Request $request){

        // Validate given dir-name
        $validator = Validator::make($request->all(), [
            'file_name' => ['required', 'string', 'min:1', 'max:128', 'regex:/^[A-Za-z. -]+$/'],
        ]);

        if ($validator->fails()) {
            return response()->json([['error' =>  $validator->errors()->first()], 401]);
        }

        $path = constant("self::DIR_PATH_" . strtoupper($this->os)) . $request->file_name;

        // The file is not exists
        if (!file_exists($path)) {

        	try {
	        	// Create the file on the specified path
				// file_put_contents($path, file_get_contents($path));

				$fp = fopen($path,"wb");
				// To avoid code injection attach
				chmod($path, '744');
				fclose($fp);

			} catch (Exception $e) {
				return ResponseDetectorController::index($request, ['msg' => $e->getMessage()]);
			}

		} else {
			return ResponseDetectorController::index($request, ['msg' => 'File already exists']);
		}

		// The dir created successfully
		return ResponseDetectorController::index($request, ['msg' => 'The file just created successfully named "' . $request->file_name . '"']);
    }

    protected function get_list_of_dirs(Request $request){
    	// Make the path
    	$path = constant("self::DIR_PATH_" . strtoupper($this->os));

    	// Get the directories' name list
    	$dirs = array_map('basename', glob($path . '/*' , GLOB_ONLYDIR));

    	return ResponseDetectorController::index($request, $dirs, 'server.get-list-of-dirs');
    }

    protected function get_list_of_files(Request $request){
    	// Make the path
    	$path = constant("self::DIR_PATH_" . strtoupper($this->os));

    	// Get the directories' name list
    	$dirs = array_map('basename', array_filter(glob($path . '/*') , 'is_file'));

    	return ResponseDetectorController::index($request, $dirs, 'server.get-list-of-files');
    }

}

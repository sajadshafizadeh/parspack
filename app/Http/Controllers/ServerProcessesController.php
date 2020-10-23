<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseDetectorController;

class ServerProcessesController extends Controller
{

    private $os;

    public function __construct(Request $request)
    {  
        // To know the request has came from either api or web route files 
    	$request->is('api/*') ? $this->middleware('auth:api') : $this->middleware('auth');

         // To get the OS
        $this->os = getOS();
    }

	public function running_list(Request $request){

    	exec(config('commands.os.'.$this->os.'.running-processes'), $running_proc);

		return ResponseDetectorController::index($request, $running_proc, 'running-server-processes');
    }
}

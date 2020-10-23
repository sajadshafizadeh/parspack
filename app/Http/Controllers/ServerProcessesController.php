<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ResponseDetectorController;

class ServerProcessesController extends Controller
{

    public function __construct()
    {
    }

	public function running_list(Request $request){
    	// Windows OS
		exec("tasklist", $task_list);

		// Linux OS
		// exec("ps faux", $task_list);

		return ResponseDetectorController::index($request, $task_list, 'running-server-processes');
    }
}

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

    	config('app.os') == 'windows' ? exec("tasklist", $task_list) :
    	config('app.os') == 'linux'   ?  exec("ps faux", $task_list) :
    	dd('Wrong OS defined');

		return ResponseDetectorController::index($request, $task_list, 'running-server-processes');
    }
}

<?php

return [

	'os' => [
		'windows' => [
			'running-processes' => 'tasklist',
			'making-directory'  => 'mkdir',
		],

		'linux' => [
			'running-processes' => 'ps faux',
			'making-directory'  => 'mkdir',
		],
	],


];
<?php

	function logVisit(){
		$logName = date('Y-m-d');

		$info = [
			'dt' => date('H:i:s'),
			'ip' => $_SERVER['REMOTE_ADDR'] ?? '',
			'uri' => $_SERVER['REQUEST_URI'] ?? '',
			'referer' => $_SERVER['HTTP_REFERER'] ?? ''
		];

		$log = json_encode($info) . "\n";
		file_put_contents("db/logs/$logName.txt", $log, FILE_APPEND);
	}

	function getVisitsDays(){
		$files = scandir('db/logs');
		$res = [];

		foreach($files as $file){
			if(checkDay($file)){
				$res[] = $file;
			};
		}

		return $res;
	}

	function checkDay($day){
		return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}\.txt*$/', $day);
	}

	function isDangerUrl($url){
		return !preg_match('/^[aA-zZ0-9_\-\.&=?\/]*$/', $url);
	}
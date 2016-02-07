<?php
namespace api\common\libraries;

use yii;
use common\models\ApiLogs;

/**
* 
*/
class Logger
{
	/*
	 * Write to table log
	 * 
	 * @param string $action
	 */
	public function write($nik){
		$apiLog = new ApiLogs();
		$apiLog->ip = $_SERVER['REMOTE_ADDR']; 
		$apiLog->nik = $nik;
		$apiLog->uri_access = $_SERVER['REQUEST_URI'];
		$apiLog->method = $_SERVER['REQUEST_METHOD'];
		$apiLog->save();
	}
}
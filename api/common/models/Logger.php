<?php
namespace api\common\models;

use yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
* 
*/
class Logger extends Model
{
	private $query;

	public function __construct()
	{
		$this->query = new Query();
	}

	/*
	 * Write to table log
	 * 
	 * @param string $action
	 */
	public function write($nik){
		$this->query 	->insert('api_logs', [
							'ip' => $_SERVER['REMOTE_ADDR'], 
							'nik' => ':nik',
							'uri_access' => $_SERVER['REQUEST_URI'],
							'method' => $_SERVER['REQUEST_METHOD']
						], array(':nik'=>$nik));
		$command = $this->query->createCommand();
		$data = $command->execute();
		return $data;
	}
}
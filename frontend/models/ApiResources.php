<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * DataController implements the CRUD actions for DataManagement model.
 */
class ApiResources extends Model
{
	public function getPenduduk($nik, $field)
	{
		$query = new Query();
		$query 	->select([$field])
				->from('base')
				->leftjoin('base_updatable', 'base.nik = base_updatable.nik')
				->where('base.nik=:nik', array(':nik'=>$nik));
		$command = $query->createCommand();
		$data = $command->queryOne();
		return $data;
	}
}
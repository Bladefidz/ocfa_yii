<?php
namespace backend\models;

use Yii;
use yii\base\Object;

class Statistik extends Object{
	public $dari;
	public $sampai;

	function getDari(){
		return $this->dari;
	}
	
	function getSampai(){
		return $this->sampai;
	}
}
?>
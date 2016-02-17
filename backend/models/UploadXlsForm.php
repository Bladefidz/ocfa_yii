<?php 
namespace backend\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadXlsForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules() {
    	return [
    		[['file'], 'required'],
    		[['file'], 'file', 'extensions' => 'xls, xlsx'],
    	];
    }

    public function attributeLables() {
    	return [
    		'file' => 'Select File',
    	];
    }
}

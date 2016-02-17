<?php
namespace backend\libraries;

use Yii;

/**
* 
*/
class Exchanger
{
	public static function getKodePendidikan($pdd)
	{
		switch($pdd){
			case 'SD':
				$pend = '1';
				break;
			case 'SMP':
				$pend = '2';
				break;
			case 'SMA':
				$pend = '3';
				break;
			case 'D 1':
				$pend = '4';
				break;
			case 'D 2':
				$pend = '5';
				break;
			case 'D 3':
				$pend = '6';
				break;
			case 'Sarjana S 1/D 4':
				$pend = '7';
				break;
			case 'Pasca Sarjana S 2':
				$pend = '8';
				break;
			case 'Pasca Sarjana S 3':
				$pend = '9';
				break;
		}
	}

	public static function getKodeJK($jk) 
	{
		$jk == 'Laki-laki' ? $j = 1 : $j = 2;
		return $j;
	}

	public static function getKodeStatusKeluarga($stk)
	{
		if($stk == 'Kepala Keluarga'){
			return 1;
		}elseif($stk == 'Istri'){
			return 2;
		}elseif($stk == 'Anak'){
			return 3;
		} else {
			$stk;
		}
	}

	public static function getKodeAgama($agama)
	{
		switch($agama){
			case 'Islam':
				$a = '1';
				break;
			case 'Kristen':
				$a = '2';
				break;
			case 'Katholik':
				$a = '3';
				break;
			case 'Hindu':
				$a = '4';
				break;
			case 'Budha':
				$a = '5';
				break;
			case 'Konghucu':
				$a = '6';
				break;
			case 'Lainnya':
				$a = '7';
				break;
			default:
				$a = $agama;
				break;
		}
		return $a;
	}

	public static function getKodeStatusPerkawinan($kawin)
	{
		$k = $kawin;
		if($kawin == 'Belum Menikah'){
			$k = 0;
		}elseif($kawin == 'Menikah'){
			$k = 1;
		}elseif($kawin == 'Cerai'){
			$k = 2;
		}elseif($kawin == 'Cerai Ditinggal Mati'){
			$k = 3;
		}
		return $k;
	}
}
<?php

namespace App\Helpers;


	function convert_date($dateValue, $format = "d-m-Y"){
		$unixDate = ($dateValue - 25569) * 86400;
		return gmdate($format, $unixDate);
	}

/* class Helper {
	static function validaRut ( $rutCompleto ) {
	if ( !preg_match("/^[0-9]+-[0-9kK]{1}/",$rutCompleto)) return false;
		$rut = explode('-', $rutCompleto);
		return strtolower($rut[1]) == Helper::dv($rut[0]);
	}
	static function dv ( $T ) {
		$M=0;$S=1;
		for(;$T;$T=floor($T/10))
			$S=($S+$T%10*(9-$M++%6))%11;
		return $S?$S-1:'k';
	}
} */
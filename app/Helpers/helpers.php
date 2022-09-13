<?php

	function convert_date($dateValue){
		$fecha = date('d/m/Y', strtotime($dateValue));
        return $fecha;
	}

    function convert_time($dateValue){
		$hora = date('H:i', strtotime($dateValue));
        return $hora;
	}
<?php
namespace App\Http;

class Helpers {
    public static function date_convert($format, $date = "now", $lang = "id"){
    	$en = array("Sun","Mon","Tue","Wed","Thu","Fri","Sat",
    		"Jan","Feb", "Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

    	$id = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu",
			"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September", "Oktober","November","Desember");		
		
    	return str_replace($en, $$lang, date($format, strtotime($date)));
    }
}

<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if ( ! class_exists('Soniclib'))
{
     require_once(APPPATH.'libraries/soniclib'.EXT);
}

$obj =& get_instance();
$obj->soniclib = new soniclib();
$obj->ci_is_loaded[] = 'soniclib';


class Soniclib {
	function soniclib(){		
		#phpinfo(INFO_VARIABLES);		
		$pos = 0;
		$client = $_SERVER['REMOTE_ADDR'];
		//$pos = ereg("172.18", $client);
		if($pos > 0){
		
		#$pos = ereg("10.10.10.10", $client);
		#if($pos <= 0){
			echo "Forbidden Access";exit;
		}
	}
	
	function rename_file($thepath, $oldname, $newname){
		if(is_file($thepath.$oldname)){
			if(rename($thepath.$oldname, $thepath.$newname)){
				return true;
			}else{
				return false;	
			}
		}else{
			return false;			
		}
	}
	
	function get_other_date($date, $format, $year, $month, $day, $hour, $minutes, $seconds){
		if($format == 1){
			# complete TIME and DATE
			list($date_v, $time_v) = preg_split('[ ]', $date);
			
			# the date
			list($year_v, $month_v, $day_v) = preg_split('[-.]', $date_v); 
			
			# the time 
			list($hour_v, $minutes_v, $seconds_v) = preg_split('[:.]', $time_v); 
			
		}else if($format == 2){
			# just DATE		
			list($year_v, $month_v, $day_v) = preg_split('[-.]', $date); 
			$hour_v = 0;
			$minutes_v = 0;
			$seconds_v = 0;
		}
		
		$make_new_date = mktime( ($hour_v+($hour)), ($minutes_v+($minutes)), ($seconds_v+($seconds)), ($month_v+($month)), ($day_v+($day)), ($year_v+($year))) ;
		if($format == 1){
			return date("Y-m-d H:i:s", $make_new_date);
		}else if($format == 2){
			return date("Y-m-d", $make_new_date);
		}
		#echo"$year_v, $month_v, $day_v, $hour_v, $minutes_v, $seconds_v";
	}
	
	function convert_date($thedate, $func){		
		$arrMonth_short_ind = array("0","Jan","Feb","Mar","Apr","Mei","Jun","Jul","Agt","Sept","Okt","Nov","Des");				
		$arrMonth_long_ind = array("0","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");						
		#list($myDate, $time) = preg_split('[ ]', $thedate);
		$thedate = trim($thedate);
		if(!empty($thedate) and $thedate != "0000-00-00"){
			if ($func == 1){ //insert conversion		
				list($year, $month, $day) = preg_split('[/.-]', $thedate);
				//$date = "$year-$month-$day"; 
				$date = "$month/$day/$year";
				# 06/16/2007		
			}
			
			if($func == 2){								
				list($month, $day, $year) = preg_split('[/.-]', $thedate);				
				$date = $year ."-". $month ."-". $day;					
				# 2007-06-16				
			}
			if($func == 3){
				list($year, $month, $day) = preg_split('[/.-]', $thedate);
				$date = abs($day)." ".$arrMonth_short_ind[abs($month)]." ".substr($year, 2, 2);
				# 20 june 2007
			}
			if($func == 4){
				list($month, $day, $year) = preg_split('[/.-]', $thedate);
				$date = $year ."". $month ."". $day;	
				# 20 june 2007
			}
			if($func == 5){
				#list($myDate, $time) = preg_split('[ ]', $thedate);
				#list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$myDate = explode(" ", $thedate);
				$time 	= $myDate[1];
				$myDate	= $myDate[0];
				$myDate	= explode("-", $myDate);				
				$day 	= $myDate[2];
				$month	= $myDate[1];
				$year	= $myDate[0];
				$date = abs($day)." ".$arrMonth_short_ind[abs($month)]." ".$year." ".$time;
				# 20 june 2007 10:00:00
			}
			if($func == 6){ # convert dari date time (Database) ke date aja
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$date = "$month/$day/$year";
				# 06/16/2007	
			}
			if($func == 7){ # convert dari date time (Database) ke time aja
				list($myDate, $date) = preg_split('[ ]', $thedate);						
				$date = substr($date, 0, 5);
				# hh:mm
				
			}
			if($func == 8){ # convert dari date time (Database) ke date dan time
				#list($myDate, $time) = preg_split('[ ]', $thedate);
				#list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$myDate = explode(" ", $thedate);
				$time 	= $myDate[1];
				$myDate	= $myDate[0];
				$myDate	= explode("-", $myDate);				
				$day 	= $myDate[2];
				$month	= $myDate[1];
				$year	= $myDate[0];
				$date = abs($day)." ".$arrMonth_short_ind[abs($month)]." ".$year ." ".$time;
				# 06/16/2007	
				
			}
			if($func == 9){ # convert dari date time (Database) ke date dan dayname
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$date = date("l", mktime(0,0,0,$month,$date,$year)). ", $month/$day/$year";
				# 06/16/2007	
				
			}
			if($func == 10){ # convert dari date time (Database) ke date
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$date = $day.".".$month.".".$year;
				# 18.10.2009	
				
			}
			if($func == 11){ # convert dari date(Database) ke date				
				list($year, $month, $day) = preg_split('[/.-]', $thedate);
				$date = abs($day)." ".$arrMonth_long_ind[abs($month)]." ".substr($year, 2, 2);
				# 18 Oktober 09
				
			}
			if($func == 12){
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$date = abs($day)." ".$arrMonth_short_ind[abs($month)]." ".$year;
				# 20 june 2007
			}	
			
			if($func == 14){ # convert dari date(Database) ke date				
				list($year, $month, $day) = preg_split('[/.-]', $thedate);
				$date = abs($day)." ".$arrMonth_long_ind[abs($month)]." ".$year;
				# 18 Oktober 2009
				
			}
			
			if($func == "indo_to_mysql"){
				list($day, $month, $year) = preg_split('[/]', $thedate);	
				$date = $year ."-". $month ."-". $day;					
				# 2007-06-16				
			}
			
			if ($func == "mysql_to_indo"){ //insert conversion		
				list($year, $month, $day) = preg_split('[-]', $thedate);
				//$date = "$year-$month-$day"; 
				$date = "$day/$month/$year";
				# 06/16/2007		
			}	
			
			if($func == 13){
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[/.-]', $myDate);
				$date = $arrMonth_long_ind[abs($month)]." ".$year;
				# 2017-06-10 10:59:59 => june 2007
			}			
			if ($func == 14){ //insert conversion		
				list($myDate, $time) = preg_split('[ ]', $thedate);
				list($year, $month, $day) = preg_split('[-]', $myDate);
				$date = "$day/$month/$year";
				# 06/16/2007				}
			}
		}else{
			#$date = " - ";
			$date=null;
		}
		return $date;
	}
	
}
?>
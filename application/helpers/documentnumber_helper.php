<?php
function documentnumber($document_name, $app_id, $format){
	$CI =& get_instance();	
	$sql = "select * from ".TBL_DOCUMENTNUMBER." 
			where 
				keydocument = '".$document_name."' 
			and app_id = ".$app_id."
			
			order by keyorder ASC
			
			";
	$q = $CI->db->query($sql);
	$q = $q->result();
	if(!empty($q)){
		$formatnumber = "";
		$documentnumber = "";
		$resetnumber = ""; # jika ada reset, maka akan bernilai true. dia akan mencari keyname 'increment';		
		
		foreach($q as $thedata){	
			switch($thedata->keyname){
				case 'prefix'		:
									$documentnumber .= strtoupper($thedata->keyvalue);									
									break;	
									
									
				case 'delimiter'	:
									$documentnumber .= strtoupper($thedata->keyvalue);									
									break;	

				case 'year'			:
					
									if($thedata->keyreset == 1 and empty($resetnumber)){
										$resetnumber = true;
									}
									
									if($thedata->keylength == 2){
										$tahun_banding = date("y");
									}else{
										$tahun_banding = date("Y");
									}
									
									
									if($thedata->keyvalue < $tahun_banding){										
										if($thedata->keylength == 2){
											$newyear = date("y");
										}else{
											$newyear = date("Y");	
										}
										
									}else{
										$newyear = $thedata->keyvalue;
										$resetnumber = false;
									}
									
									$documentnumber .= $newyear;
									
									break;
									
				case 'month'			:
					
									if($thedata->keyreset == 1 and empty($resetnumber)){
										$resetnumber = 1;
									}
									
									/*if($thedata->keyvalue < date("m")){
										$newmonth = date("m");
										if($newmonth < 10){
											$newmonth = "0".$newmonth;
										}
									}else{
										$newmonth = $thedata->keyvalue;
										if($newmonth < 10){
											$newmonth = "0".$newmonth;
										}
									}*/
									
									$newmonth = date("m");
									
									if($thedata->keyvalue == $newmonth){
										$newmonth = $thedata->keyvalue;										
									}
									
									if($newmonth < 10){
										$newmonth = "0".$newmonth;
									}
									
									$documentnumber .= $newmonth;
									
									break;
				
				case 'month_rome'	:
					
									
									
									/*if($thedata->keyvalue < date("m")){
										$newmonth = date("m");
										if($newmonth < 10){
											$newmonth = "0".$newmonth;
										}
									}else{
										$newmonth = $thedata->keyvalue;
										if($newmonth < 10){
											$newmonth = "0".$newmonth;
										}
									}*/
									
									$newmonth = date("m");
									
									if($thedata->keyvalue == $newmonth){
										$newmonth = $thedata->keyvalue;										
									}else{
										$newmonth = (int)$newmonth;
										if($thedata->keyreset == 1 and empty($resetnumber)){
											$resetnumber = 1;
										}
									}
									
									$arr_month = array("", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X", "XI", "XII");
									
									$documentnumber .= $arr_month[$newmonth];
									
									break;
				
				case 'day'			:
									
									if($thedata->keyreset == 1 and empty($resetnumber)){									
										$resetnumber = true;
									}
									
									/*$formatnumber = "";
									if($thedata->keyvalue < date("d")){
										$newday = date("d");
									}else{
										$newday = $thedata->keyvalue;
										for($i=strlen($newday); $i<(int)$thedata->keylength; $i++){
											$formatnumber .= "0";
										}										
										$resetnumber = false;
									}*/
									
									if(date("d") < 10){
										$newday = date("d");
										for($i=strlen($newday); $i<(int)$thedata->keylength; $i++){
											$formatnumber .= "0";
										}																				
										$resetnumber = false;
									}else{
										$newday = date("d");
									}
									
									
									
									if($thedata->keyvalue != date("d")){
										$resetnumber = true;
									}else{
										$resetnumber = false;
									}
									
									$documentnumber .= $formatnumber.$newday;
									
									break;
									
				case 'increment'	:
									# cek apakah sudah terjadi reset ?
									
									if($resetnumber and !empty($resetnumber)){
										$newnumber = 1;										
									}else{
										$newnumber = $thedata->keyvalue + 1;
									}
									$formatnumber = "";
									
									for($i=strlen($newnumber); $i<(int)$thedata->keylength; $i++){
										$formatnumber .= "0";
									}
									
									$documentnumber.=$formatnumber.$newnumber;
									
									break;				
				default				:
									break;
			}								
		}# end for		
		
		if($format == 2){
			#update all field to database;
			if(!empty($newyear)){
				$sql = " update ".TBL_DOCUMENTNUMBER." set keyvalue = $newyear 
						where 
						keydocument = '".$document_name."' 
						and app_id = ".$app_id."
						and keyname = 'year'				
				";
				$CI->db->query($sql);
			} 
			
			if(!empty($newmonth)){			
				$sql = " update ".TBL_DOCUMENTNUMBER." set keyvalue = $newmonth
						where 
						keydocument = '".$document_name."' 
						and app_id = ".$app_id."
						and keyname = 'month'				
				"; 
				$CI->db->query($sql);
				
				$sql = " update ".TBL_DOCUMENTNUMBER." set keyvalue = $newmonth
						where 
						keydocument = '".$document_name."' 
						and app_id = ".$app_id."
						and keyname = 'month_rome'
				"; 
				$CI->db->query($sql);
			}
			
			/*$sql = " update ".TBL_DOCUMENTNUMBER." set keyvalue = $newday
					where 
					keydocument = '".$document_name."' 
					and app_id = ".$app_id."
					and keyname = 'day'				
			"; 
			
			$CI->db->query($sql);
			*/
			if(!empty($newnumber)){
				$sql = " update ".TBL_DOCUMENTNUMBER." set keyvalue = $newnumber 
						where 
						keydocument = '".$document_name."' 
						and app_id = ".$app_id."
						and keyname = 'increment'
				"; 
				
				$CI->db->query($sql);
			}
		}
		return $documentnumber;
	}else{
		return "Document Number not exists !";
	}
}

function documentnumber_marketing($marketing_id){
	if(!empty($marketing_id)){
		$CI =& get_instance();	
		$sql = "select * from ".TBL_MARKETING_CODE." 
				where  marketing_id = ".$marketing_id."
				";
		$q = $CI->db->query($sql);
		$q = $q->result();
		if(!empty($q)){	
			if($q[0]->format_year != date("Y")){
				$year	= date("Y");
				$num	= 1;
			}else{
				$year 	= $q[0]->format_year;
				$num 	=  $q[0]->format_number + 1;
			}
			
			$data = array("format_year" => $year, "format_number" => $num);
			$CI->db->where("marketing_id", $marketing_id);
			$CI->db->update(TBL_MARKETING_CODE, $data); 
			
			$CI =& get_instance();	
			$sql = "select * from ".TBL_MARKETING_CODE." 
					where  marketing_id = ".$marketing_id."			
					";
			$r = $CI->db->query($sql);
			$r = $r->result();
			return array( 'number' => $r[0]->format_number , 'code' => $r[0]->marketing_code ) ;
		}
	}else{
		return 0;
	}	
}
?>
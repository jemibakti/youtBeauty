<?php
class Model_index_core extends CI_Model{
	 function __construct()
        {
            // Call the Model constructor
            parent::__construct();
        }

	
	#function generate_sql($array_data, $withlimit = 0){
	function generate_sql($array_data, $withlimit = 0, $default = '' ){
		$var_page = $this->uri->segment(3);
		// echo $var_page;exit;
		if(!empty($var_page)){
			$var_page = base64_decode($var_page);
		}
		#$splitter = split('[|]', $var_page);
		$splitter = preg_split('[|]', $var_page);
		// debug($splitter);
		$sql 				= $array_data['sql'];
		if(isset($array_data['sql_total'])){ $sql_total		= $array_data['sql_total']; }
		if(isset($array_data['sql_decode'])){ $sql_decode	= $array_data['sql_decode']; }
		$maxdata 			= $array_data["maxdata"];
		$date_condition 	= $array_data['date_condition'];
		$company_condition 	= "";
		
		/*
		if(!empty($array_data["all_session"])){
			$company_condition	= " and a.company_id in (".$array_data["all_session"]["company_id"].") ";
		}
		*/
		
		if(!empty($splitter[2])){
			$sortby		= $splitter[2];
		}else{
			$sortby		= $this->input->post("sortby");
		}
		
		if(!empty($splitter[3])){			
			$sortvar	= $splitter[3];
		}else{
			$sortvar	= $this->input->post("sortvar");
		}
		
		
		if(!empty($sortby) and !empty($sortvar)){
	    	if($sortby=='asc'){
	    		$order = 'ASC';
	    	}else {
	    		$order = 'DESC';
	    	}		
	    	
	    	$order_by   = $sortvar." ".$order;
	    }else{		
			$order_by	= $array_data['order_by'];
	    }
		
		$searching = "";
		# WHERE CONDITION -----------------------------------------------------------------------------------------------------------------------------
		
		if(!empty($splitter[0]) and !empty($splitter[1])){			
			$thevalue	= trim($splitter[0]);
			$thekey		= $splitter[1];
		}else{
			$thevalue	= trim($this->input->post("search_txt"));
			$thekey		= $this->input->post("search_list");
		}
		if(!empty($thevalue) and !empty($thekey)){
			$searching_total 	= " WHERE upper($thekey) like upper('%$thevalue%') ";
			$searching 			= " WHERE upper($thekey) like upper('%$thevalue%') ";
		}			 	
		
		# DATE CONDITION ---------------------------------------------------------------------------------------------------------------------------------
		$sql_date = "";
		if(isset($_POST["datefrom_txt"])){
			$datefrom_var = $_POST["datefrom_txt"];
		}
		#$datefrom_var = $this->input->post("datefrom_txt");
		if(isset($datefrom_var)){
			if(!empty($datefrom_var)){
				$datefrom_var	= $this->input->post("datefrom_txt");
				$sql_date	.= " AND $date_condition >= '".$this->soniclib->convert_date($datefrom_var, 2)." 00:00:00' ";				
			}else{
				$datefrom_var	= "";
				$sql_date	.= "";
			}
		}else if($date_condition!= ""){
			#$datefrom_var	= date("m/d/Y");
			#$sql_date	.= " AND $date_condition >= '".$this->soniclib->convert_date($datefrom_var, 2)." 00:00:00' ";	
		}else{
			$sql_date = "";
		}
		
		if(isset($_POST["dateto_txt"])){
			$dateto_var = $_POST["dateto_txt"];
		}
		
		#$dateto_var = $this->input->post("dateto_txt");
		if(isset($dateto_var)){
			if(!empty($dateto_var)){
				$dateto_var	= $this->input->post("dateto_txt");
				$sql_date	.= " AND $date_condition <= '".$this->soniclib->convert_date($dateto_var, 2)." 23:59:59' ";				
			}else{
				$dateto_var	= "";
				$sql_date	.= "";
			}
		}else if($date_condition!=""){
			#$dateto_var	= date("m/d/Y");
			#$sql_date	.= " AND $date_condition <= '".$this->soniclib->convert_date($dateto_var, 2)." 23:59:59' ";	
		
		}else{
			$sql_date	= "";
		}
		
		if (empty($dateto_var) && empty ($datefrom_var) && $default == 'date'){			
			$sql_date = "AND $date_condition <= NOW() AND $date_condition >= date_sub(now(), interval 30 day ) "; 
		}
			
		# ORDER BY  CONDITION -----------------------------------------------------------------------------------------------------------------------------
		if(empty($order_by)){
			$order_by = "";
		}else{
			$order_by = " order by ".$order_by;
		}
		
		# LIMIT CONDITION -----------------------------------------------------------------------------------------------------------------------------
		if($withlimit == 1){
			// echo $this->uri->segment(3); exit;
			if($this->uri->segment(3) > 0){			
				$pagelist	= $this->uri->segment(3);
			}else{
				$pagelist	= $this->input->post("page_list");
			}
			// echo $pagelist;exit;
			
			if(!empty($pagelist)){
				$awalData	= ( $pagelist * (int)$maxdata) - (int)$maxdata;				
				//$awalData = $pagelist;
			}else{
				$awalData	= 0;				
			}

			if($awalData <= 0){
				$awalData = 0;
			}
			
			
			$thelimit = " limit $awalData, $maxdata ";
			// echo $thelimit; exit;
			# ADD BY RF, UPDATE THE LIMIT INSIDE THE SQL TOO			
			# THE SQL ------------------------------------------------------------------------------------------------------------------------------------
			$find	= strpos($sql, "\$limit_include");												
			if($find > 0 ){
			
				$check_extra = strpos($sql, "\$where_extra");
				
				if($check_extra === false){
					$sql	=	str_replace("\$limit_include", $thelimit, $sql);
					$THESQL = $sql ." ".  $searching ." ". $sql_date ." ". $company_condition ." ". $order_by ." ". $thelimit ." ";					
				}else{
					$sql	=	str_replace("\$where_extra", $sql_date ." ". $searching ." ". $company_condition, $sql);
					$sql	=	str_replace("\$limit_include", $thelimit, $sql);
					$THESQL = $sql ." ". $order_by ." ";				
				}																		
			}else{
			
				$check_extra = strpos($sql, "\$where_extra");
			
				if($check_extra === false){
					$THESQL = $sql ." ".  $searching ." ". $sql_date ." ". $company_condition ." ". $order_by ." ". $thelimit ." ";
				}else{
					$sql	=	str_replace("\$where_extra", $searching, $sql);					
					$THESQL = $sql ." ". $sql_date ." ". $company_condition ." ". $order_by ." ". $thelimit;				
				}		
			// echo $THESQL; exit;														
			}
			$THEQUERY = $this->db->query($THESQL);	

			return $THEQUERY;
		}else{				
			$thelimit = "";
			
			$sql	=	str_replace("\$limit_include", "", $sql);
			
			# THE SQL ------------------------------------------------------------------------------------------------------------------------------------
			if(!empty($sql_total)){
				# JIKA QUERY SQL_TOTAL TIDAK KOSONG, MAKA JALANKAN QUERY INI. UNTUK MENGHEMAT TIMING DAN MEMORY
				$THESQL = $sql_total ." ".  $searching_total ." ". $sql_date." ". $company_condition;							
				$THEQUERY = $this->db->query($THESQL);	
				$THEQUERY	= $THEQUERY->result();
				return $THEQUERY[0]->total;			
			}else{				
				$check_extra = strpos($sql, "\$where_extra");
				
				if($check_extra === false){
					$THESQL = $sql ." ".  $searching ." ". $sql_date ." ". $company_condition ." ". $order_by ." ". $thelimit ." ";						
				}else{
					$sql	=	str_replace("\$where_extra", $searching ." ".$company_condition, $sql);
					$THESQL = $sql ." ".  $sql_date ." ". $order_by ." ". $thelimit ." ";							
				}						
				$THEQUERY = $this->db->query($THESQL);	
				return	$THEQUERY->num_rows();
			}						
		}										
	}
}
?>
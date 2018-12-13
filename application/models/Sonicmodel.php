<?php
class sonicmodel extends CI_Model{
	function __contstruct(){
		parent::__contstruct();
	}
	
	function readglobal($tablename, $field1 = "", $where1 = "", $cond1 = "string", $field2 = "", $where2 = "", $cond2 = "", $field3 = "", $where3 = "", $cond3 = "", $extra_condition = ""){
		
		$where = "";
		if(!empty($field1)){
			if($cond1 == "string"){
				$where .= " where $field1 = '".$where1."' ";
			}else{
				$where .= " where $field1 = $where1 ";
			}
		}
		
		if(!empty($field2)){
			if($cond2 == "string"){
				$where .= " and $field2 = '".$where2."' ";
			}else{
				$where .= " and $field2 = $where2 ";
			}
		}
		
		if(!empty($field3)){
			if($cond3 == "string"){
				$where .= " and $field3 = '".$where3."' ";
			}else{
				$where .= " and $field3 = $where3 ";
			}
		}
		
		$sql = " select * from $tablename $where $extra_condition";
		
		$q = $this->db->query($sql);
		
		return $q->result();
	}		
	
	function getmasterdata($keyname, $valuename = ""){
		$this->db->select("*");
		$this->db->from(TBL_MASTERDATA);
		$this->db->where('master_key', $keyname);
		
		if(!empty($valuename)){
			$this->db->where('master_value', $valuename);
		}
		
		$this->db->order_by('master_value', 'asc');
		$q = $this->db->get();
		return $q->result();
	}
	
	function thesql($thesql){
		$q	= $this->db->query($thesql);
		return $q->result();
	}
	
	function update_data($table_name, $arr_data, $thepk="", $thevalue=""){
		if(!empty($thepk)){
			$this->db->where($thepk, $thevalue);
		}
		
		return $this->db->update($table_name, $arr_data);
		
	}
	
	function insert_data($table_name, $arr_data){
		return $this->db->insert($table_name, $arr_data);
	}
	
	function delete_data($table_name, $thepk="", $thevalue=""){
		if(!empty($thepk)){
			$this->db->where($thepk, $thevalue);
		}
		
		return $this->db->delete($table_name);
	}

	function count_total($table_name, $thefield, $extra = ''){
		$sql	=	"
					select count(".$thefield.") total
					from ".$table_name."					
					";
		
		if(!empty($extra)){
			$sql .= $extra;
		}
		
		$q	= $this->db->query($sql);
		$q 	= $q->result();
		return $q[0]->total;
	}
	
	
	# CREATED DATE 01112011
	# delete data = Update status = 99
	function delete_data_log($table_name, $field_id, $theid, $field_status){
		$data	=	array(
			$field_status	=>	99,
			"user_deleted"	=>	$this->session->userdata("SONIC_ADMIN_USERNAME"),
			"date_deleted"	=>	date("Y-m-d H:i:s")
		);
		
		$this->db->where($field_id, $theid);
		$this->db->update($table_name, $data);
	}		
	
	function update_counter_printed($table_name, $field, $key){
		$sql	=	"update $table_name set counter_printed = counter_printed + 1, 
						user_printed = '".$this->session->userdata("SONIC_ADMIN_USERNAME")."',
						date_printed = '".date("Y-m-d H:i:s")."'
						where $field = $key
						";
		$this->db->query($sql);				
		$this->db->close();
	}
	
	# ADD BY RF, 26 DEC 2012
	# FOR LOGS SYSTEM
	function read_last_log($memberid, $row = 10){
		if(empty($memberid)){
			$memberid = $this->session->userdata('SONIC_USERID');
		}
		$sql	=	"
						select log_type, log_note, log_date 
						from ".TBL_LOGS."
						where member_id = ".$memberid."
						order by log_date desc
						limit 0, ".$row."
						";	
		$q		= $this->db->query($sql);
		return $q->result();	
	}
	
	# ADD BY RF, 26 DEC 2012
	# FOR LOGS SYSTEM
	function save_logs($type, $note, $memberid = "" ){
	
		if(empty($memberid)){
			$memberid = $this->session->userdata('SONIC_ADMIN_USERNAME');
		}
	
		$data	=	array(
			"member_id"		=>	$memberid,
			"log_date"		=>	date("Y-m-d H:i:s"),
			"log_note"		=>	$note,
			"log_type"		=>	$type,
			"ipaddress"		=>	$_SERVER["REMOTE_ADDR"]
		);
		$this->db->insert(TBL_LOGS, $data);

	}
}
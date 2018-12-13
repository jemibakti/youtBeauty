<?php

class Model_dop extends CI_Model{
	
	
    function __construct(){
        parent::__construct();
    }
	
    function update_table($table,$update,$where,$value){
            // debug($this->input->post());
        $this->db->where($where,$value);
        $update = $this->db->update($table,$update);
        return $update;
    }
	
	function get_table($nama_table){
	// mendapatkan data dari suatu table
        $query = $this->db->get($nama_table);
        return $query->result();
	}
	
	function get_table_order($nama_table,$order,$short){
   // mendapatkan data dari suatu table
		$this->db->order_by($order,$short);
        $query = $this->db->get($nama_table);
        return $query->result();
	}
   
   function get_table_wheres($nama_table,$where){
   // mendapatkan data tabel dengan suatu kondisi
		foreach($where as $row=>$q ){
			 $this->db->where($row,$q);
		}
        $query = $this->db->get($nama_table);
        return $query->result();
	}
	
    function get_table_where($nama_table,$where,$nilai,$order=null,$short=null){
            // mendapatkan data tabel dengan suatu kondisi
            $this->db->where($where,$nilai);
            $this->db->order_by($order,$short);
            $query = $this->db->get($nama_table);
            return $query->result();
    }
	
	function cekUserLogin($array=array()){
	// mendapatkan data dari suatu table
		// echo md5(md5($array['password']."yb"));exit;
        $query = $this->db->get_where('m_user', 
			array(
				'username' => $array['npp'],
				'password' => md5(md5($array['password']."yb")),
				'status' => 1
			)
		);
        return $query->result();
	}
	
	function cekLoginApplicant(){
	// mendapatkan data dari suatu table
        $query = $this->db->get_where(TBL_USER, 
			array(
				'username' => $this->input->post('username'),
				'password' => hash("sha256",md5(md5($this->input->post('password')))),
				'status' => 1,
				'admin' => 0
			)
		);
        return $query->result();
	}
	
	function insert_table($table,$data){
        $query = $this->db->insert($table,$data);
        return $query;
    }
	
	
    function update_last_login2($username){
    	$sql	=	"update m_user set last_login = '".date("Y-m-d H:i:s")."' where username = '".$username."' ";
    	$this->db->query($sql);
    	$this->db->close();
    }
	
	function getMenuPriv($group_id){
	//mendapatkan increment no pp
        return $this->db->query("
			SELECT 
				distinct
				  a.menu_id,
				  rel_id,
				  a.`order_no`,
				  a.level,
				  a.nama_menu,
				  a.menu_name,
				  a.menu_path,
				  c.`menu_name` as parent_name,
				  c.`nama_menu`as menu_parent,
				  IF(b.`view` = 1,'success','danger') AS views,
				  IF(b.`add` = 1,'success','danger') AS adds,
				  IF(b.`update` = 1,'success','danger') AS updates,
				  IF(b.`delete` = 1,'success','danger') AS deletes
				FROM
				  ".TBL_MENU." a 
				  LEFT JOIN 
					(SELECT 
					  * 
					FROM
					  ".TBL_GROUPMENU." 
					WHERE group_id = '".$group_id."' 
					  AND STATUS = 1) b 
					ON a.`menu_id` = b.`menu_id` 
				  LEFT JOIN rec_menu c 
					ON a.`parent_id` = c.`menu_id` 
				WHERE a.status = 1 
				ORDER BY c.menu_name,
				  a.`order_no` 
				"
		)->result();
    }
	function getInfo(){
		$query =  "		
			SELECT * FROM t_contact_us limit 0,3
		";
		return $this->db->query($query)->result();
	}
}
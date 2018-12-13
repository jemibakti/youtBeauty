<?php
class menu_model extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
    function load_mainmenu(){
        $user = $this->session->userdata["SONIC_ADMIN_USERNAME"];
		$sql = " 
			SELECT distinct
				c.*
			from
				".TBL_USER_GROUP." a
			join ".TBL_GROUPMENU." b on a.group_id = b.group_id
			join ".TBL_MENU." c on c.menu_id = b.menu_id
			where a.username = '".$user."' and c.`level` = 0 and a.status = 1
			ORDER BY order_no
			";
		$q      	= $this->db->query($sql);
		$result     = $q->result();
		$this->db->close();
		$q->free_result();
		
		return $result;
	
    }

    function load_submenu($parent_menu){
        $user = $this->session->userdata["SONIC_ADMIN_USERNAME"];
		$sql = "    
			SELECT distinct
				c.*
			from
				".TBL_USER_GROUP." a
			join ".TBL_GROUPMENU." b on a.group_id = b.group_id
			join ".TBL_MENU." c on c.menu_id = b.menu_id
			where a.username = '".$user."' and a.status = 1 and c.parent_id = ".$parent_menu." and c.status = 1
			ORDER BY order_no
		";
		$q      = $this->db->query($sql);
		$result      = $q->result();
		$q->free_result();
		$this->db->close();
		return $result;
    }

}
<?php
class Authlogin{
	
	var $CI;
	function authlogin(){
		$this->CI =& get_instance();
	}	
	
	function check_session(){		
		
		$username 	= $this->CI->session->userdata("HCDOC_USERNAME");	
		if(empty($username)){
			redirect("Auth");			
		}		
		
		// $data['username'] 	= $username;		
		// $data['name']		= $this->CI->session->userdata("SONIC_ADMIN_NAME");
        // $data['group_id']	= $this->CI->session->userdata("SONIC_ADMIN_GROUP");
		// $data['is_admin']	= $this->CI->session->userdata("SONIC_IS_ADMIN");
		
		// return $data;
	}
}
?>
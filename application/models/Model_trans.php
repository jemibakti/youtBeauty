<?php

class Model_trans extends CI_Model{
	
	
    function __construct(){
        parent::__construct();
    }
	function saveUser(){
		// debug($this->input->post());
		// echo md5(md5('password',1)); 
		$data   =   array(
			"username"			=>  $this->input->post("username"),            
			"password"			=>  md5(md5($this->input->post("password"),1)), 
			"name"				=>  $this->input->post("name"),           
			"email"				=>  $this->input->post("email"),
			"status"      		=>  $this->input->post("status"),
			"user_created"      =>  $this->session->userdata("SONIC_ADMIN_USERNAME")
		);
		$this->db->insert(TBL_USER, $data);
	}
	
}
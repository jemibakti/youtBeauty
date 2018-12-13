<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            date_default_timezone_set('Asia/Bangkok');
    }
    public function index()
    {
            $this->load->view('login');
    }
    
    public function logout($jenis=null)
    {
        $this->Model_dop->update_last_login2($this->session->userdata["HCDOC_PERSON_ID"]);
        $this->session->sess_destroy();
        if($jenis){
                redirect('Auth');
        }else{
                redirect('Auth');
        }
    }
    public function login()
    {
        $data = $this->Model_dop->cekUserLogin($this->input->post());
        // debug($this->input->post());exit; 
        if(count($data) > 0){			
            $this->session->set_userdata("HCDOC_USERNAME", $this->input->post("npp"));
            $this->session->set_userdata("HCDOC_ADMIN_NAME", $data[0]->username);
            $this->session->set_userdata("HCDOC_PERSON_ID", $data[0]->id);
            $this->session->set_userdata("HCDOC_LAST_LOGIN", date('Y-m-d h:i:s'));
			$this->session->set_userdata("HCDOC_ADMIN_FOTO", $data[0]->foto);
            $this->Model_dop->update_last_login2($data[0]->username);
            redirect("adminWeb/dash");
        }else{
            $this->session->set_flashdata("error_text", MSG_LOGIN_USERNAMENOTVALID);
            redirect("Auth");
        }
    }
    
    function getTable($table){
        header('Content-type: application/json');
        $data = $this->Model_dop->get_table_where($table,'id',$this->input->post('id'));
        if($data){
                echo json_encode($data);
        }else{
                $data = 'kosong';
                echo json_encode($data);
        }
    }
	
    function deleteStatus($table){
        header('Content-type: application/json');

        $data['deleted_status'] = '1';
        $data['user_updated'] = $this->session->userdata["HCDOC_ADMIN_NAME"];
        $data['date_updated'] = date('Y-m-d H:i:s');
        $this->Model_dop->update_table($table,$data,'id',$this->input->post('id'));

        if($data){
                echo json_encode($data);
        }else{
                $data = 'kosong';
                echo json_encode($data);
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    #end here ======================================================================================================
    public function forgotPass(){
        $user = $this->Model_dop->get_table_where(TBL_APLICANT,'username',$this->input->post('username'));
        if($user){
            $this->load->library('email');

            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['charset'] = 'iso-8859-1';
            $config['mailtype']	= "html";
            $config['wordwrap'] = TRUE;

            $this->email->initialize($config);

            $this->email->from('admin@rookie46.com', 'Rookie 46');
            $this->email->to($user[0]->email);
            // $this->email->cc('jhee.ananda@gmail.com');
            #$this->email->bcc('them@their-example.com');
            $s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 6)), 0, 6);
            $updates['password'] = hash("sha256",md5(md5($s)));
            $updates['date_updated'] = date('Y-m-d H:i:s');
            $updates['user_updated'] = 'Reset_pass';
            $update = $this->Model_dop->update_table(TBL_USER,$updates,'username',$this->input->post('username'));

            $this->email->subject('Change Password');
            $this->email->message('
                    You just asked for your password to be sent to you.
                    <br/> Here is your password '.$s.'
            ');
            $this->session->set_flashdata("info", "Please cek Your Email.");
            $this->email->send();
            redirect('webPage/login');
        }else{
                $this->session->set_flashdata("info", "Username Tidak Terdaftar.");
                redirect('webPage/forgotPass');
        }
    }
    public function login_aplicant(){
        $data = $this->Model_dop->cekLoginApplicant();
        // debug($data);exit;
        if(count($data) > 0){			
            $this->session->set_userdata("username", $data[0]->username);
            $this->session->set_userdata("foto", $data[0]->foto);
            $this->session->set_userdata("nama", $data[0]->name);
            // debug($this->session->userdata());
            $this->Model_dop->update_last_login2($username);
            if(isset($this->session->userdata["backLink"])){
                    redirect($this->session->userdata["backLink"]);
            }else{
                    redirect("webPage");
            }
        }else{
            $this->session->set_flashdata("info", 'Please Enter a Valid usename and password');
            redirect("webPage/login");
        }
    }
}

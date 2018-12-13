<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AdminWeb extends CI_Controller {

    var $control = 'adminWeb';

    public function __construct() {
        parent::__construct();
        // $this->load->model('User_model','customers');
        $this->load->library("Authlogin");
        $this->sess_data = $this->authlogin->check_session();
        date_default_timezone_set('Asia/Bangkok');
    }

    function simpanKontak() {
        // debug($this->input->post());
        $data = $this->input->post();
        $this->Model_dop->insert_table("t_contact_us", $data);
        redirect(base_url());
    }

    public function dash() {
        $data['title'] = 'Pesan';
		$data['actMenu'] = "dash";
        $wheres['status'] = 1;
        $wheres['delete_status'] = 0;
        $data['info'] = $this->Model_dop->getInfo();
        $this->load->view('admin/welcome', $data);
    }
    public function contact_us() {
        $data['title'] = 'Pesan';
		$data['actMenu'] = "contact_us";
        $wheres['status'] = 1;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('t_contact_us', $wheres);
        $this->load->view('admin/dataKomen', $data);
    }
    public function user() {
        $data['title'] = 'Data User';
		$data['actMenu'] = "user";
        $wheres['status'] = 1;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_user', $wheres);
        $this->load->view('admin/dataUser', $data);
    }

    function deleteStatus($code) {
        $encode = base64_decode($code);
        $data = explode("|", $encode);
        // debug($data);exit;
        @$data_log['update_user'] = $this->session->userdata["HCDOC_ADMIN_NAME"];
        $data_log['update_date'] = date('Y-m-d H:i:s');
        $data_log['delete_status'] = 1;
        $data_log['delete_date'] = date('Y-m-d H:i:s');
        $this->Model_dop->update_table($data[0], $data_log, 'id', $data[1]);
        $this->direct_act($data[3], $data[4]);
    }

    function deleteStatusRed($code) {
        $encode = base64_decode($code);
        $data = explode("|", $encode);
        // debug($data);exit;
        @$data_log['update_user'] = $this->session->userdata["HCDOC_ADMIN_NAME"];
        $data_log['update_date'] = date('Y-m-d H:i:s');
        $data_log['delete_status'] = 1;
        $data_log['delete_date'] = date('Y-m-d H:i:s');
        $this->Model_dop->update_table($data[0], $data_log, 'id', $data[1]);
        redirect($data[2]);
    }

    function updateRecord($group_id, $flag) {

        $file = upload('file', './upload/img', false);

        if ($file) {
            $data['file_name'] = $file['file_name'];
        }

        $data['update_user'] = $this->session->userdata["HCDOC_ADMIN_NAME"];
        $data['update_date'] = date('Y-m-d H:i:s');
        $data['title'] = $this->input->post('title');
        $data['desc'] = $this->input->post('deskripsi');
        $data['status'] = $this->input->post('status');
        // debug($data);exit; 

        IF ($flag == 1) {
            $update = $this->Model_dop->update_table("m_pictrue", $data, 'id', $this->input->post('id'));
        } else {
            $update = $this->Model_dop->update_table("m_treat", $data, 'id', $this->input->post('id'));
        }
        $this->direct_act($group_id, $flag);
    }
	
    function simpan() {
        $file = upload('file', './upload/img', false);

        $data['group_id'] = $this->input->post('group_id');
        $data['title'] = $this->input->post('title');
        $data['nama'] = $this->input->post('title');
        $data['desc'] = $this->input->post('deskripsi');
        $data['file_name'] = $file['file_name'];
        $data['create_user'] = $this->session->userdata["SONIC_ADMIN_USERNAME"];
        // debug($data);exit;

        $jenis = $this->input->post('group_id');
        if ($this->input->post('jenis') == 1) {
            $this->Model_dop->insert_table("m_pictrue", $data);

            $this->direct_act($jenis,1);
			
            redirect('AdminWeb/' . $direct);
        } else {
            $this->Model_dop->insert_table("m_treat", $data);
            redirect('AdminWeb/treatmentDetail/' . base64_encode($jenis));
        }
    }
	
    function direct_act($jenis, $flag) {
        if ($flag == 1) {
            if ($jenis == 1) {
                $direct = "slider";
            } else if ($jenis == 2) {
                $direct = "profile";
            } else if ($jenis == 3) {
                $direct = "treatment";
            } else if ($jenis == 4) {
                $direct = "slider";
            } else if ($jenis == 5) {
                $direct = "testy";
            } else if ($jenis == 6) {
                $direct = "gallery";
            } else if ($jenis == 7) {
                $direct = "dokter";
            } else if ($jenis == 9) {
                $direct = "promotion";
            } else if ($jenis == 8) {
                $direct = "other";
            } else if($jenis == 10){
				$direct = "sponsor";
			}
            redirect('AdminWeb/' . $direct);
        } else {
            redirect('AdminWeb/treatmentDetail/' . base64_encode($jenis));
        }
    }
    
    
    public function simpanFile($group_id, $jenis) {

        $data["jenis"] = $jenis;
        $data["group_id"] = $group_id;
        $this->load->view('head', $data);
        $this->load->view('other-editors');
    }

    function simpanLink() {
        $data = $this->input->post();
        $this->Model_dop->insert_table("m_link", $data);
        $diretc = ($this->input->post('group_id') == 1 ? "youtube" : "link" );
        redirect('AdminWeb/'.$diretc);
    }

    public function simpanFileVideo($code) {
        
        $data["group_id"] = base64_decode($code);
        $this->load->view('head', $data);
        $this->load->view('admin/inputLink');
    }

    public function updateFile($code) {
        $enc = base64_decode($code);
        $pars = explode("|", $enc);
        // debug($pars);exit;
        $data['group_id'] = $pars[1];
        $data['jenis'] = $pars[2];
        if ($pars[2] == 1) {
            $data['record'] = $this->Model_dop->get_table_where('m_pictrue', 'id', $pars[0]);
        } else {
            $data['record'] = $this->Model_dop->get_table_where('m_treat', 'id', $pars[0]);
        }
        // debug($data);exit;
        $this->load->view('head', $data);
        $this->load->view('update_pic');
    }


    public function slider() {
        $data['title'] = 'Data Slider';
		$data['actMenu'] = "slider";
        $data["jenis"] = 1;
        $wheres['group_id'] = 1;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 1;
        $this->load->view('admin/dataIndex', $data);
    }

    public function promotion() {
        $data['title'] = 'Data Promotion';
		$data['actMenu'] = "promotion";

        $data["jenis"] = 1;
        $wheres['group_id'] = 9;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 9;
        $this->load->view('admin/dataIndex', $data);
    }

    public function profile() {
		$data['actMenu'] = "profile";
        $data['title'] = 'Data Profile';
        $data["jenis"] = 1;
        $wheres['group_id'] = 2;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 2;
        $this->load->view('admin/dataIndex', $data);
    }

    public function treatment() {
        $data['title'] = 'Data Treatment';
		$data['actMenu'] = "treatment";
        $data["jenis"] = 1;
        $wheres['group_id'] = 3;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 3;
        $this->load->view('admin/dataIndex', $data);
    }

    public function treatmentDetail($idEnc) {
        $id = base64_decode($idEnc);
        $wheres['group_id'] = $id;
        $wheres['delete_status'] = 0;
        $data['title'] = 'Data Treatment ';
        $data["jenis"] = 2;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_treat', $wheres);
        $data['group_id'] = $id;
        $this->load->view('admin/dataIndexTreat', $data);
    }

    public function gallery() {
        $data['title'] = 'Data Gallery Ruangan';
		$data['actMenu'] = "gallery";
        $data["jenis"] = 1;
        $wheres['group_id'] = 6;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 6;
        $this->load->view('admin/dataIndex', $data);
    }

    public function dokter() {
        $data['title'] = 'Data Gallery Dokter';
		$data['actMenu'] = "dokter";
        $data["jenis"] = 1;
        $wheres['group_id'] = 7;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 7;
        $this->load->view('admin/dataIndex', $data);
    }

    public function other() {
        $data['title'] = 'Data Gallery Lain-lain';
		$data['actMenu'] = "other";
        $data["jenis"] = 1;
        $wheres['group_id'] = 8;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 8;
        $this->load->view('admin/dataIndex', $data);
    }

    public function testy() {
        $data['title'] = 'Data Testimony';
		$data['actMenu'] = "testy";
        $data["jenis"] = 1;
        $wheres['group_id'] = 5;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 5;
        $this->load->view('admin/dataIndex', $data);
    }

    public function after() {
        $data['title'] = 'Data After Before';
		$data['actMenu'] = "after";
        $data["jenis"] = 1;
        $wheres['group_id'] = 4;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 4;
        $this->load->view('admin/dataIndex', $data);
    }

    public function youtube() {
        $data['title'] = 'Data Youtube';
		$data['actMenu'] = "youtube";
        $wheres['group_id'] = 1;
        $wheres['delete_status'] = 0;
        $data['group_id'] = 1;
        $data['direct'] = "youtube";
        $data['grid'] = $this->Model_dop->get_table_wheres('m_link', $wheres);
        $this->load->view('admin/dataIndexMedia', $data);
    }

    public function link() {
        $data['title'] = 'Data Link';
		$data['actMenu'] = "link";
        $wheres['group_id'] = 2;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_link', $wheres);
        $data['group_id'] = 2;
        $data['direct'] = "link";
        $this->load->view('admin/dataIndexMedia', $data);
    }
    public function sponsor() {
        $data['title'] = 'Data Sponsor';
		$data['actMenu'] = "sponsor";
        $data["jenis"] = 1;
        $wheres['group_id'] = 10;
        $wheres['delete_status'] = 0;
        $data['grid'] = $this->Model_dop->get_table_wheres('m_pictrue', $wheres);
        $data['group_id'] = 10;
        $this->load->view('admin/dataIndex', $data);
    }

    public function welcomeAdmin() {
        $data['pesan'] = $this->Model_dop->getInfoBeli(1);
        $data['verifikasi'] = $this->Model_dop->getInfoBeli(2);
        $data['kirim'] = $this->Model_dop->getInfoBeli(3);
        // debug($data);exit;
        $this->load->view('admin/welcome', $data);
        // $this->load->view('pages/update_password');
        // $this->load->view('element/v_footer_style');
    }

}

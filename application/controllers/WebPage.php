<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class WebPage extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Bangkok');
	}
	public function index(){
		$wheres['group_id'] = 1;
		$wheres['status'] = 1;
		$wheres['delete_status'] = 0;
		$data['slider'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$data['youtube'] = $this->Model_dop->get_table_wheres('m_link',$wheres);
		$wheres['group_id'] = 2;
		$data['link'] = $this->Model_dop->get_table_wheres('m_link',$wheres);
		$data['profile'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 3;
		$data['treat'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 4;
		$data['after'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 5;
		$data['testi'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 6;
		$data['room'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 7;
		$data['dokter'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 8;
		$data['other'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 9;
		$data['promo'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		$wheres['group_id'] = 10;
		$data['sponsor'] = $this->Model_dop->get_table_wheres('m_pictrue',$wheres);
		// debug($data);exit;
		$this->load->view('webpage/index',$data);
		// $this->load->view('pages/update_password');
		// $this->load->view('element/v_footer_style');
	}
	function simpanPemesanan(){
		debug($this->input->post());
		$cek = $this->Model_dop->get_table_where(M_CUST,'no_hp',$this->input->post('no_hp'));
		if(!$cek){
			$insert['nama'] 	= strtoupper($this->input->post('name'));
			$insert['email'] 	= $this->input->post('email');
			$insert['no_hp'] 	= $this->input->post('no_hp');
			debug($insert);
			$simpanCust = $this->Model_dop->insert_table(M_CUST,$insert);
		}
		$cek = $this->Model_dop->get_table_where(TRX_ALAMAT,'alamat',$this->input->post('alamat'));
		if(!$cek){
			$insertAl['provinsi'] 	= strtoupper($this->input->post('provinsi'));
			$insertAl['kota'] 		= strtoupper($this->input->post('kota'));
			$insertAl['kecamatan'] 	= strtoupper($this->input->post('kecamatan'));
			$insertAl['alamat'] 	= strtoupper($this->input->post('alamat'));
			$insertAl['no_hp']	 	= strtoupper($this->input->post('no_hp'));
			debug($insertAl);
			$simpanAlamat = $this->Model_dop->insert_table(TRX_ALAMAT,$insertAl);
		}
		$insertBl['jumlah_beli'] 	= $this->input->post('jumlah_beli');
		$insertBl['product_id'] = $this->input->post('product_id');
		$insertBl['no_hp']	 	= $this->input->post('no_hp');
		debug($insertBl);
		$simpanAlamat = $this->Model_dop->insert_table(TRX_BELI,$insertBl);
		
		if($simpanCust){
			$this->session->set_flashdata('info',"Pemesanan Tersimpan, Terima kasih Telah Memesan di ".TOKO);
		}else{
			$this->session->set_flashdata('info',"Proses Input Gagal, Silahkan Dicoba kembali");
		}
		exit;
		redirect('webPage');
	}
	
	function getDataTreath(){
		$data 	= $this->Model_dop->get_table_where('m_treat','id',$this->input->post('id'));
		header('Content-Type: application/json');
		if($data){
			echo json_encode($data);
		}else{
			$data = 'kosong';
			echo json_encode($data);
		}
	}
}
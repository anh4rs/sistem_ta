<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Databimbingans extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$this->judul->setPembimbing($id_user);
		$result = $this->judul->get_mahasiswa_bimbingan_dosen();

		$data['result'] = $result;

		$this->load->view('layout/header', $data);
		$this->load->view('list', $data);
		$this->load->view('layout/footer');
	}
}
?>
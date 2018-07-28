<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datadosens extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('judul');
		$this->load->model('mahasiswa');
		$this->load->model('dosen');
	}

	function index(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$result = $this->dosen->list_dosen();
		$data['result'] = $result;

		$this->load->view('layout/header', $data);
		$this->load->view('list_all', $data);
		$this->load->view('layout/footer');
	}

	function judul_by(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');

		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_mahasiswa = $this->uri->segment(3);

		$this->judul->setIDMahasiswa($id_mahasiswa);
		$result = $this->judul->list_data_by_akademik();
		$data['result'] = $result;

		$data['acc'] = $this->judul->cek_acc_judul();

		$this->mahasiswa->setID($id_mahasiswa);
		$mhs = $this->mahasiswa->get_mahasiswa();
		foreach ($mhs as $key => $val) {
			$data['nim_mhs'] = $val['nim'];
			$data['nama_mhs'] = $val['nama_mhs'];
		}

		$this->load->view('layout/header', $data);
		$this->load->view('list_judul', $data);
		$this->load->view('layout/footer');
	}

	function detail_data(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_judul = $this->uri->segment(3);
		$this->judul->setID($id_judul);
		$data['result_detail'] = $this->judul->get_data();

		$this->load->view('layout/header', $data);
		$this->load->view('detail', $data);
		$this->load->view('layout/footer');
	}

	function respon_judul(){
		$id_judul = $this->uri->segment(3);
		$status = $this->uri->segment(4);
		$id_mhs = $this->uri->segment(5);

		$this->judul->setID($id_judul);
		$this->judul->setStatus($status);

		$respon = $this->judul->respon_akademik();
		if($respon){
			$this->session->set_flashdata('success', 'Judul berhasil ditanggapi');
		}else {
			$this->session->set_flashdata('warning', 'terjadi kesalahans');
		}

		redirect('judulmahasiswas/judul_by/'.$id_mhs,'refresh');
	}

	function tambah_data(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$this->load->view('layout/header', $data);
		$this->load->view('tambah_dosen', $data);
		$this->load->view('layout/footer');	
	}

	function simpan_data(){
		$this->form_validation->set_rules('txt_nip', 'NIP', 'trim|required', array('required'=>'NIP harus diisi'));
		$this->form_validation->set_rules('txt_nama_dosen', 'Nama Dosen', 'trim|required', array('required'=>'Nama Dosen harus diisi'));
		$this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email', array('required'=>'Email tidak valid'));
		$this->form_validation->set_rules('txt_nohp', 'Nomor HP', 'trim|required', array('required'=>'No HP harus diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$this->load->view('layout/header', $data);
			$this->load->view('tambah_dosen', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->dosen->setNIP($this->input->post('txt_nip'));
			$this->dosen->setNamaDosen($this->input->post('txt_nama_dosen'));
			$this->dosen->setEmail($this->input->post('txt_email'));
			$this->dosen->setNoHP($this->input->post('txt_nohp'));
			$save = $this->dosen->add_dosen();
			$save_user = $this->dosen->add_user_dosen();

			if($save && $save_user){
				$this->session->set_flashdata('success', 'Data Dosen berhasil disimpan');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('datadosens','refresh');
		}
	}

	function edit_form(){
		$id_user = $this->session->userdata('id_user');
		$jenis_user = $this->session->userdata('jenis_user');
		$data['id_user'] = $id_user;
		$data['jenis_user'] = $jenis_user;

		$id_dosen = $this->uri->segment(3);
		$this->dosen->setID($id_dosen);
		$data['result_detail'] = $this->dosen->get_data();

		$this->load->view('layout/header', $data);
		$this->load->view('edit_dosen', $data);
		$this->load->view('layout/footer');
	}

	function ubah_data(){
		$this->form_validation->set_rules('txt_nama_dosen', 'Nama Dosen', 'trim|required', array('required'=>'Nama Dosen harus diisi'));
		$this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email', array('required'=>'Email tidak valid'));
		$this->form_validation->set_rules('txt_nohp', 'Nomor HP', 'trim|required', array('required'=>'No HP harus diisi'));
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');

		if($this->form_validation->run() == FALSE) {
			$id_user = $this->session->userdata('id_user');
			$jenis_user = $this->session->userdata('jenis_user');
			$data['id_user'] = $id_user;
			$data['jenis_user'] = $jenis_user;

			$id_dosen = $this->uri->segment(3);
			$this->dosen->setID($id_dosen);
			$data['result_detail'] = $this->dosen->get_data();

			$this->load->view('layout/header', $data);
			$this->load->view('edit_dosen', $data);
			$this->load->view('layout/footer');
		}else{

			$this->db->trans_start();

			$this->dosen->setID($this->input->post('txt_id'));
			$this->dosen->setNIP($this->input->post('txt_nip'));
			$this->dosen->setNamaDosen($this->input->post('txt_nama_dosen'));
			$this->dosen->setEmail($this->input->post('txt_email'));
			$this->dosen->setNoHP($this->input->post('txt_nohp'));
			$update = $this->dosen->edit_data();

			if($update){
				$this->session->set_flashdata('success', 'Data Dosen berhasil diedit');
			}else {
				$this->session->set_flashdata('warning', 'terjadi kesalahan');
			}

			$this->db->trans_complete();

			redirect('datadosens','refresh');
		}
	}

	function hapus_data(){
		$id_dosen = $this->uri->segment(3);

		$this->dosen->setID($id_dosen);
		$delete = $this->dosen->delete_data();

		if($delete){
			$this->session->set_flashdata('success', 'Dosen berhasil dihapus');
		}else {
			$this->session->set_flashdata('warning', 'terjadi kesalahan');
		}
		redirect('datadosens','refresh');
	}

}